<?php
session_start();
include("../config/db.php");

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// =============================
// ADD TO CART
// =============================
if (isset($_POST['add_to_cart'])) {
    $productId = (int)$_POST['product_id'];
    $quantity = max(1, (int)$_POST['quantity']);

    // Get product from DB
    $stmt = $con->prepare("SELECT id, name, price, image_url, farmer_id FROM products WHERE id=? LIMIT 1");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = [
                "id"        => $product['id'],
                "name"      => $product['name'],
                "price"     => $product['price'],
                "image_url" => $product['image_url'],
                "vendor_id" => $product['farmer_id'],
                "quantity"  => $quantity
            ];
        }
    }

    header("Location: cart.php");
    exit;
}

// =============================
// REMOVE ITEM
// =============================
if (isset($_GET['remove'])) {
    $removeId = (int)$_GET['remove'];
    unset($_SESSION['cart'][$removeId]);
    header("Location: cart.php");
    exit;
}

// =============================
// UPDATE CART
// =============================
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $id => $qty) {
        if ($qty > 0) {
            $_SESSION['cart'][$id]['quantity'] = (int)$qty;
        } else {
            unset($_SESSION['cart'][$id]);
        }
    }
    header("Location: cart.php");
    exit;
}

// =============================
// Calculate total
// =============================
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">

<?php include '../includes/header.php' ?>

<div class="max-w-6xl mx-auto px-4 py-10">
  <h1 class="text-3xl font-bold text-green-700 mb-6">🛒 Shopping Cart</h1>

  <?php if (empty($_SESSION['cart'])): ?>
    <div class="bg-white p-6 rounded-lg shadow text-center">
      <p class="text-gray-500 text-lg">Your cart is empty.</p>
      <a href="shop.php" class="mt-4 inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
        <i class="fas fa-shopping-basket"></i> Go to Shop
      </a>
    </div>
  <?php else: ?>
    <form method="post" action="cart.php">
      <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full text-left">
          <thead class="bg-green-100 text-green-800">
            <tr>
              <th class="p-3">Product</th>
              <th class="p-3">Price</th>
              <th class="p-3">Quantity</th>
              <th class="p-3">Total</th>
              <th class="p-3">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($_SESSION['cart'] as $item): ?>
              <tr class="border-b">
                <td class="p-3 flex items-center gap-3">
                  <?php if (!empty($item['image_url'])): ?>
                    <img src="../admin/uploads/products/<?= htmlspecialchars($item['image_url']); ?>" 
                         class="w-16 h-16 object-cover rounded">
                  <?php else: ?>
                    <div class="w-16 h-16 bg-green-100 flex items-center justify-center rounded">
                      <i class="fas fa-leaf text-green-600 text-2xl"></i>
                    </div>
                  <?php endif; ?>
                  <span class="font-semibold"><?= htmlspecialchars($item['name']); ?></span>
                </td>
                <td class="p-3">₹<?= number_format($item['price'], 2); ?></td>
                <td class="p-3">
                  <input type="number" name="quantities[<?= $item['id']; ?>]" value="<?= $item['quantity']; ?>" 
                         min="1" class="w-16 border rounded p-1 text-center">
                </td>
                <td class="p-3 font-semibold">₹<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
                <td class="p-3">
                  <a href="cart.php?remove=<?= $item['id']; ?>" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="flex justify-between items-center mt-6">
        <button type="submit" name="update_cart" 
                class="bg-yellow-400 text-white px-6 py-2 rounded-lg hover:bg-yellow-500">
          <i class="fas fa-sync"></i> Update Cart
        </button>
        <div class="text-right">
          <p class="text-xl font-bold text-green-700">Total: ₹<?= number_format($total, 2); ?></p>
          <a href="checkout.php" 
             class="mt-2 inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
            <i class="fas fa-credit-card"></i> Checkout
          </a>
        </div>
      </div>
    </form>
  <?php endif; ?>
</div>

<?php include '../includes/footer.php' ?>
</body>
</html>
