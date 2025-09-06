<?php
// Database Configuration
$host = 'localhost';
$dbname = 'farmers_market';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Get current tab
$tab = $_GET['tab'] ?? 'dashboard';

// ---------------------------
// Image Upload Helper
// ---------------------------
function uploadImage($file, $dir) {
    if (!$file || !$file['name']) return null;

    if (!is_dir($dir)) mkdir($dir, 0777, true);

    $fileName = time() . "_" . basename($file['name']);
    $targetPath = $dir . $fileName;
    $ext = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (in_array($ext, $allowed) && move_uploaded_file($file['tmp_name'], $targetPath)) {
        return $fileName;
    }
    return null;
}

// ---------------------------
// Handle Form Submissions
// ---------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {

        // ---------------------------
        // ADD FARMER
        // ---------------------------
        case 'add_farmer':
            $farmer_pic = uploadImage($_FILES['farmer_pic'] ?? null, "uploads/profiles/");
            $stmt = $pdo->prepare("INSERT INTO farmers (name, email, phone, farm_name, location, bio, farmer_pic) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['farm_name'], $_POST['location'], $_POST['bio'], $farmer_pic]);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=farmers&added=1'); exit;

        // ---------------------------
        // EDIT FARMER
        // ---------------------------
        case 'edit_farmer':
            $farmer_pic = uploadImage($_FILES['farmer_pic'] ?? null, "uploads/profiles/");
            if ($farmer_pic) {
                $stmt = $pdo->prepare("UPDATE farmers SET name=?, email=?, phone=?, farm_name=?, location=?, bio=?, farmer_pic=? WHERE id=?");
                $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['farm_name'], $_POST['location'], $_POST['bio'], $farmer_pic, $_POST['id']]);
            } else {
                $stmt = $pdo->prepare("UPDATE farmers SET name=?, email=?, phone=?, farm_name=?, location=?, bio=? WHERE id=?");
                $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['farm_name'], $_POST['location'], $_POST['bio'], $_POST['id']]);
            }
            header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=farmers&updated=1'); exit;

        // ---------------------------
        // DELETE FARMER
        // ---------------------------
        case 'delete_farmer':
            $stmt = $pdo->prepare("SELECT farmer_pic FROM farmers WHERE id=?");
            $stmt->execute([$_POST['id']]);
            if ($f = $stmt->fetch() and $f['farmer_pic']) @unlink("uploads/profiles/" . $f['farmer_pic']);
            $pdo->prepare("DELETE FROM farmers WHERE id=?")->execute([$_POST['id']]);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=farmers&deleted=1'); exit;

        // ---------------------------
        // ADD PRODUCT
        // ---------------------------
        case 'add_product':
            $image = uploadImage($_FILES['image'] ?? null, "uploads/products/");
            $stmt = $pdo->prepare("INSERT INTO products (name, category, farmer_id, price, stock, season, description, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$_POST['name'], $_POST['category'], $_POST['farmer_id'], $_POST['price'], $_POST['stock'], $_POST['season'], $_POST['description'], $image]);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=products&added=1'); exit;

        // ---------------------------
        // EDIT PRODUCT
        // ---------------------------
        case 'edit_product':
            $image = uploadImage($_FILES['image'] ?? null, "uploads/products/");
            if ($image) {
                $stmt = $pdo->prepare("UPDATE products SET name=?, category=?, farmer_id=?, price=?, stock=?, season=?, description=?, image_url=? WHERE id=?");
                $stmt->execute([$_POST['name'], $_POST['category'], $_POST['farmer_id'], $_POST['price'], $_POST['stock'], $_POST['season'], $_POST['description'], $image, $_POST['id']]);
            } else {
                $stmt = $pdo->prepare("UPDATE products SET name=?, category=?, farmer_id=?, price=?, stock=?, season=?, description=? WHERE id=?");
                $stmt->execute([$_POST['name'], $_POST['category'], $_POST['farmer_id'], $_POST['price'], $_POST['stock'], $_POST['season'], $_POST['description'], $_POST['id']]);
            }
            header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=products&updated=1'); exit;

        // ---------------------------
        // DELETE PRODUCT
        // ---------------------------
        case 'delete_product':
            $stmt = $pdo->prepare("SELECT image_url FROM products WHERE id=?");
            $stmt->execute([$_POST['id']]);
            if ($p = $stmt->fetch() and $p['image_url']) @unlink("uploads/products/" . $p['image_url']);
            $pdo->prepare("DELETE FROM products WHERE id=?")->execute([$_POST['id']]);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=products&deleted=1'); exit;

        // ---------------------------
        // ADD CUSTOMER
        // ---------------------------
        case 'add_customer':
            $stmt = $pdo->prepare("INSERT INTO customers (name, email, phone, address) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['address']]);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=customers&added=1'); exit;

        // ---------------------------
        // DELETE CUSTOMER
        // ---------------------------
        case 'delete_customer':
            $pdo->prepare("DELETE FROM customers WHERE id=?")->execute([$_POST['id']]);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=customers&deleted=1'); exit;

        // ---------------------------
        // UPDATE ORDER STATUS
        // ---------------------------
        case 'update_order_status':
            $stmt = $pdo->prepare("UPDATE orders SET status=? WHERE id=?");
            $stmt->execute([$_POST['status'], $_POST['id']]);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?tab=orders&updated=1'); exit;
    }
}

// ---------------------------
// Fetch Data Functions
// ---------------------------
function getFarmers($pdo){
    $stmt = $pdo->query("SELECT f.*, COUNT(p.id) as product_count FROM farmers f LEFT JOIN products p ON f.id = p.farmer_id GROUP BY f.id ORDER BY f.created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProducts($pdo){
    $stmt = $pdo->query("SELECT p.*, f.name as farmer_name, f.farm_name FROM products p LEFT JOIN farmers f ON p.farmer_id = f.id ORDER BY p.created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getOrders($pdo){
    $stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCustomers($pdo){
    $stmt = $pdo->query("SELECT c.*, COUNT(o.id) as total_orders, COALESCE(SUM(o.total_amount), 0) as total_spent FROM customers c LEFT JOIN orders o ON c.id = o.customer_id GROUP BY c.id ORDER BY c.created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getStats($pdo){
    $stats = [];
    $stats['total_farmers'] = $pdo->query("SELECT COUNT(*) FROM farmers")->fetchColumn();
    $stats['total_products'] = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
    $stats['total_orders'] = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
    $stats['total_customers'] = $pdo->query("SELECT COUNT(*) FROM customers")->fetchColumn();
    $stats['total_revenue'] = $pdo->query("SELECT COALESCE(SUM(total_amount), 0) FROM orders WHERE status != 'Cancelled'")->fetchColumn();
    $stats['pending_orders'] = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Pending'")->fetchColumn();
    $stats['low_stock'] = $pdo->query("SELECT COUNT(*) FROM products WHERE stock < 10")->fetchColumn();
    $stats['monthly_revenue'] = $pdo->query("SELECT COALESCE(SUM(total_amount),0) FROM orders WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())")->fetchColumn();
    return $stats;
}

// ---------------------------
// Helper Functions
// ---------------------------
if (!function_exists('getStatusColor')) {
    function getStatusColor($status){
        $colors = [
            'Pending' => 'bg-yellow-100 text-yellow-800',
            'Processing' => 'bg-blue-100 text-blue-800',
            'Completed' => 'bg-green-100 text-green-800',
            'Cancelled' => 'bg-red-100 text-red-800'
        ];
        return $colors[$status] ?? 'bg-gray-100 text-gray-800';
    }
}

function getProductIcon($category){
    $icons = [
        'vegetables'=>'carrot',
        'fruits'=>'apple-alt',
        'herbs'=>'leaf',
        'grains'=>'seedling'
    ];
    return $icons[$category] ?? 'apple-alt';
}

function getCategoryColor($category){
    $colors = [
        'vegetables'=>'bg-green-100 text-green-800',
        'fruits'=>'bg-red-100 text-red-800',
        'herbs'=>'bg-emerald-100 text-emerald-800',
        'grains'=>'bg-amber-100 text-amber-800'
    ];
    return $colors[$category] ?? 'bg-gray-100 text-gray-800';
}

// ---------------------------
// Fetch All Data
// ---------------------------
$farmers = getFarmers($pdo);
$products = getProducts($pdo);
$orders = getOrders($pdo);
$customers = getCustomers($pdo);
$stats = getStats($pdo);
?>
