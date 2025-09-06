<?php
session_start();
include("../config/db.php");

// ========================
// SEARCH & FILTER
// ========================
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$query = "
    SELECT p.*, f.name AS farmer, f.farm_name, f.location
    FROM products p
    LEFT JOIN farmers f ON p.farmer_id = f.id
    WHERE 1
";

$params = [];
if (!empty($search)) {
    $query .= " AND (p.name LIKE ? OR p.description LIKE ? OR f.name LIKE ?)";
    $searchTerm = "%" . $search . "%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
}
if (!empty($category)) {
    $query .= " AND p.category = ?";
    $params[] = $category;
}

$stmt = $con->prepare($query);
if (!empty($params)) {
    $types = str_repeat("s", count($params));
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);

// Get distinct categories for filter buttons
$catResult = $con->query("SELECT DISTINCT category FROM products");
$categories = $catResult->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fresh Market Shop</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

<!-- Navbar -->
<?php include '../includes/header.php' ?>

<!-- Hero Section -->
<section class="py-10 bg-green-100">
  <div class="max-w-7xl mx-auto px-4 text-center">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4 text-green-800">Fresh Produce, Straight from Farmers 🌾</h1>
    <p class="text-lg mb-6 text-gray-700">Support local farmers while enjoying organic, healthy food.</p>
    <form method="get" action="" class="flex justify-center max-w-lg mx-auto">
      <input type="text" name="search" value="<?= htmlspecialchars($search); ?>" 
             placeholder="Search for fruits, vegetables, grains..." 
             class="flex-1 p-3 rounded-l-lg text-gray-800 focus:outline-none border">
      <button type="submit" class="bg-green-600 text-white px-5 rounded-r-lg hover:bg-green-700 transition">
        <i class="fas fa-search"></i>
      </button>
    </form>
  </div>
</section>

<!-- Filters -->
<div class="max-w-7xl mx-auto px-4 mt-8 flex items-center justify-between flex-wrap">
  <div class="flex flex-wrap gap-3">
    <a href="shop.php" 
       class="px-4 py-2 rounded-full border text-sm <?= empty($category) ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-green-100'; ?>">
       All
    </a>
    <?php foreach ($categories as $cat): ?>
      <a href="?category=<?= urlencode($cat['category']); ?>" 
         class="px-4 py-2 rounded-full border text-sm 
         <?= ($category === $cat['category']) ? 'bg-green-600 text-white' : 'bg-white text-gray-700 hover:bg-green-100'; ?>">
        <?= ucfirst($cat['category']); ?>
      </a>
    <?php endforeach; ?>
  </div>
</div>

<!-- Product Grid -->
<div class="max-w-7xl mx-auto px-4 py-12">
  <?php if (empty($products)): ?>
    <p class="text-center text-gray-500 text-lg">No products found. Try a different search or category.</p>
  <?php else: ?>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
      <?php foreach ($products as $product): ?>
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl hover:scale-105 transform transition">
          
          <!-- Product Image -->
          <div class="relative h-52">
            <?php if (!empty($product['image_url'])): ?>
              <img src="../admin/uploads/products/<?= htmlspecialchars($product['image_url']); ?>" 
                   alt="<?= htmlspecialchars($product['name']); ?>" 
                   class="h-full w-full object-cover">
            <?php else: ?>
              <div class="flex h-full items-center justify-center bg-green-100">
                <i class="fas fa-leaf text-5xl text-green-500"></i>
              </div>
            <?php endif; ?>
            <span class="absolute top-2 left-2 bg-green-600 text-white text-xs px-2 py-1 rounded-full">
              <?= ucfirst($product['category']); ?>
            </span>
          </div>

          <!-- Product Details -->
          <div class="p-5">
            <h3 class="text-lg font-bold text-gray-900 mb-1"><?= htmlspecialchars($product['name']); ?></h3>
            <p class="text-sm text-gray-600 mb-2">
              <i class="fas fa-user text-green-500"></i>
              <?= htmlspecialchars($product['farmer'] ?? 'Unknown Farmer'); ?> 
              <?= !empty($product['farm_name']) ? "(" . htmlspecialchars($product['farm_name']) . ")" : ''; ?>
            </p>
            <p class="text-green-600 font-bold text-xl mb-3">₹<?= number_format($product['price'], 2); ?></p>
            
            <div class="flex items-center justify-between mb-4">
              <span class="text-sm font-medium <?= $product['stock'] > 10 ? 'text-green-600' : ($product['stock'] > 0 ? 'text-orange-500' : 'text-red-500') ?>">
                <?= $product['stock'] > 0 ? $product['stock']." in stock" : "Out of stock"; ?>
              </span>
              <span class="text-xs text-gray-500"><?= ucfirst($product['season']); ?> season</span>
            </div>

            <p class="text-sm text-gray-500 mb-3 line-clamp-2"><?= htmlspecialchars($product['description']); ?></p>

            <!-- Add to Cart -->
            <form method="post" action="cart.php" class="flex items-center space-x-2">
              <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
              <input type="hidden" name="add_to_cart" value="1">
              <input type="number" name="quantity" value="1" min="1" 
                     class="w-16 border rounded p-1 text-center">
              <button type="submit" 
                      class="flex-1 bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition disabled:opacity-50"
                      <?= $product['stock'] <= 0 ? 'disabled' : '' ?>>
                <i class="fas fa-cart-plus mr-1"></i> Add to Cart
              </button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<!-- Footer -->
<?php include '../includes/footer.php' ?>

</body>
</html>
