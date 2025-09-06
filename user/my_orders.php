<?php
session_start();
include("../config/db.php");
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user info
$user_name = $_SESSION['name'] ?? $_SESSION['username'] ?? 'User';
$user_email = $_SESSION['email'] ?? '';

// Fetch all orders by user email
$stmt = $con->prepare("SELECT * FROM orders WHERE email = ? ORDER BY created_at DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Fresh Market</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body { font-family: 'Inter', sans-serif; }
        
        .order-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #cbd5e1;
        }
        
        .status-pending { 
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e; 
        }
        .status-processing { 
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af; 
        }
        .status-shipped { 
            background: linear-gradient(135deg, #e9d5ff, #d8b4fe);
            color: #7c2d12; 
        }
        .status-delivered { 
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46; 
        }
        .status-completed { 
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46; 
        }
        .status-cancelled { 
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b; 
        }
        
        .item-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.2s ease;
        }
        
        .item-card:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: scale(1.02);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #10b981, #059669);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .page-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        }
        
        .quick-action-card {
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .quick-action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-color: transparent;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">

<!-- Navbar -->
<?php include '../includes/header.php'; ?>

<!-- Page Header -->
<div class="page-header py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">My Orders</h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">Track your purchases and manage your order history with ease</p>
            <div class="mt-8 flex justify-center">
                <div class="bg-white/10 backdrop-blur-sm rounded-full px-6 py-2 border border-white/20">
                    <span class="text-white font-medium"><?= count($orders); ?> Total Orders</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 py-12 -mt-8 relative z-10">

    <?php if (empty($orders)): ?>
        <!-- Enhanced Empty State -->
        <div class="bg-white rounded-2xl shadow-xl border p-16 text-center">
            <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">No orders yet</h2>
            <p class="text-lg text-gray-500 mb-8 max-w-md mx-auto">You haven't placed any orders. Start exploring our fresh products and create your first order!</p>
            <a href="shop.php" class="inline-flex items-center bg-gradient-to-r from-green-600 to-emerald-600 text-white px-8 py-4 rounded-xl hover:from-green-700 hover:to-emerald-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 font-semibold">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                Start Shopping
            </a>
        </div>
    <?php else: ?>
        <!-- Enhanced Orders List -->
        <div class="space-y-8">
            <?php foreach ($orders as $index => $order): ?>
                <?php
                // Fetch order items
                $itemStmt = $con->prepare("
                    SELECT oi.*, p.name AS product_name, p.image_url 
                    FROM order_items oi
                    JOIN products p ON oi.product_id = p.id
                    WHERE oi.order_id = ?
                ");
                $itemStmt->bind_param("i", $order['id']);
                $itemStmt->execute();
                $items = $itemStmt->get_result()->fetch_all(MYSQLI_ASSOC);

                $grand_total = 0;
                foreach ($items as $item) {
                    $grand_total += $item['price_each'] * $item['quantity'];
                }
                
                // Status styling
                $status_class = 'status-' . strtolower($order['status']);
                ?>
                
                <div class="order-card rounded-2xl overflow-hidden shadow-lg" style="animation-delay: <?= $index * 0.1; ?>s">
                    
                    <!-- Order Header -->
                    <div class="bg-gradient-to-r from-slate-800 to-slate-700 p-6 text-white">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-2xl font-bold">Order #<?= $order['id']; ?></h2>
                                    <p class="text-slate-300 text-sm">
                                        <?= date("d M Y, h:i A", strtotime($order['created_at'])); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-6">
                                <span class="px-4 py-2 rounded-xl text-sm font-bold <?= $status_class ?>">
                                    <?= $order['status']; ?>
                                </span>
                                <div class="text-right">
                                    <p class="text-slate-300 text-sm">Total Amount</p>
                                    <p class="text-2xl font-bold gradient-text bg-gradient-to-r from-green-400 to-emerald-400 bg-clip-text text-transparent">₹<?= number_format($grand_total, 2); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Order Items</h3>
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-medium">
                                <?= count($items); ?> items
                            </span>
                        </div>
                        
                        <div class="grid gap-4">
                            <?php foreach ($items as $item): 
                                $subtotal = $item['price_each'] * $item['quantity'];
                            ?>
                                <div class="item-card rounded-xl p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <?php if (!empty($item['image_url'])): ?>
                                                <img src="../admin/uploads/products/<?= htmlspecialchars($item['image_url']); ?>" 
                                                     class="w-20 h-20 rounded-xl object-cover shadow-md">
                                            <?php else: ?>
                                                <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-md">
                                                    <span class="text-2xl">📦</span>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 text-lg"><?= htmlspecialchars($item['product_name']); ?></h4>
                                                <div class="flex items-center mt-2 space-x-4">
                                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                                        Qty: <?= $item['quantity']; ?>
                                                    </span>
                                                    <span class="text-gray-500">×</span>
                                                    <span class="font-medium text-gray-700">₹<?= number_format($item['price_each'], 2); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-2xl font-bold text-gray-900">₹<?= number_format($subtotal, 2); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Order Actions -->
                    <div class="bg-gray-50 p-6 border-t">
                        <div class="flex flex-col sm:flex-row gap-3 justify-end">
                            <a href="download_invoice.php?order_id=<?= $order['id']; ?>" 
                               class="bg-slate-800 hover:bg-slate-900 text-white px-6 py-3 rounded-xl text-center transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                               📄 Download Invoice
                            </a>
                            <?php if ($order['status'] === 'Delivered' || $order['status'] === 'Completed'): ?>
                                <a href="#" 
                                   class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-3 rounded-xl text-center transition-all duration-300 font-medium shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                   🔄 Reorder Items
                                </a>
                            <?php endif; ?>
                            <a href="order_success.php?order_id=<?= $order['id']; ?>" 
                               class="border-2 border-gray-300 hover:border-gray-400 text-gray-700 hover:bg-white px-6 py-3 rounded-xl text-center transition-all duration-300 font-medium">
                               👁️ View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Enhanced Quick Actions -->
    <div class="mt-16">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-gray-900 mb-4">Quick Actions</h3>
            <p class="text-gray-600 text-lg">Everything you need in one place</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <a href="shop.php" class="quick-action-card p-8 rounded-2xl group">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Continue Shopping</h4>
                <p class="text-gray-600">Discover fresh products and amazing deals</p>
            </a>
            
            <a href="profile.php" class="quick-action-card p-8 rounded-2xl group">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">My Profile</h4>
                <p class="text-gray-600">Update your account and preferences</p>
            </a>
            
            <a href="contact.php" class="quick-action-card p-8 rounded-2xl group">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-2">Need Help?</h4>
                <p class="text-gray-600">Get support from our customer service team</p>
            </a>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include '../includes/footer.php'; ?>

</body>
</html>