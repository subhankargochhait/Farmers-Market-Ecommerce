<?php
// Include CRUD backend
include 'includes/crud.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Harvest - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <style>
        .fade-in { animation: fadeIn 0.5s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .hover-scale { transition: transform 0.3s ease; }
        .hover-scale:hover { transform: scale(1.02); }
        .admin-sidebar { background: linear-gradient(135deg, #1f2937, #374151); }
        .card-shadow { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .card-shadow:hover { box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1),0 4px 6px -2px rgba(0,0,0,0.05); }
        .stat-card { background: linear-gradient(135deg,#ffffff,#f9fafb); }
        .modal-backdrop { backdrop-filter: blur(4px); }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 overflow-auto">
        <!-- Header -->
        <?php include 'includes/header.php'; ?>

        <main class="p-8">
            <?php if($tab === 'dashboard'): ?>
                <div class="fade-in">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="stat-card p-6 rounded-xl card-shadow hover-scale">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                                    <p class="text-3xl font-bold text-gray-900">₹<?php echo number_format($stats['total_revenue'],2); ?></p>
                                    <p class="text-sm text-green-600 mt-1"><i class="fas fa-arrow-up mr-1"></i>+12.5% from last month</p>
                                </div>
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-indian-rupee-sign text-green-600 text-xl"></i>

                                </div>
                            </div>
                        </div>

                        <div class="stat-card p-6 rounded-xl card-shadow hover-scale">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Total Orders</p>
                                    <p class="text-3xl font-bold text-gray-900"><?php echo $stats['total_orders']; ?></p>
                                    <p class="text-sm text-blue-600 mt-1"><i class="fas fa-arrow-up mr-1"></i><?php echo $stats['pending_orders']; ?> pending</p>
                                </div>
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-shopping-bag text-blue-600 text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card p-6 rounded-xl card-shadow hover-scale">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Active Farmers</p>
                                    <p class="text-3xl font-bold text-gray-900"><?php echo $stats['total_farmers']; ?></p>
                                    <p class="text-sm text-purple-600 mt-1"><i class="fas fa-users mr-1"></i><?php echo $stats['total_products']; ?> products</p>
                                </div>
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-users text-purple-600 text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card p-6 rounded-xl card-shadow hover-scale">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Low Stock Items</p>
                                    <p class="text-3xl font-bold text-gray-900"><?php echo $stats['low_stock']; ?></p>
                                    <p class="text-sm text-red-600 mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>Needs attention</p>
                                </div>
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="lg:grid lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-3 bg-white rounded-xl card-shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Orders</h3>
                            <?php foreach(array_slice($orders,0,5) as $order): ?>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg mb-2">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-shopping-bag text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-800">Order #<?php echo $order['id']; ?></p>
                                        <p class="text-sm text-gray-600"><?php echo htmlspecialchars($order['customer_name']); ?></p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-800">₹ <?php echo number_format($order['total_amount'],2); ?></p>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo getStatusColor($order['status']); ?>">
                                        <?php echo $order['status']; ?>
                                    </span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            <?php elseif($tab==='farmers'): ?>
                <?php include 'Farmers/farmers_management.php'; ?>
            <?php elseif($tab==='products'): ?>
                <?php include 'Products/products_management.php'; ?>
            <?php elseif($tab==='orders'): ?>
                <?php include 'Orders/orders_management.php'; ?>
            <?php elseif($tab==='customers'): ?>
                <?php include 'Customers/customers_management.php'; ?>
            <?php elseif($tab==='analytics'): ?>
                <?php include 'Analytics.php'; ?>
            <?php elseif($tab==='settings'): ?>
                <?php include 'settings.php'; ?>
            <?php endif; ?>
        </main>
    </div>
</div>

<!-- Modals -->
<?php include 'Farmers/add_Farmer.php'; ?>
<?php include 'Farmers/edit_farmer.php'; ?>
<?php include 'Products/add_product.php'; ?>
<?php include 'Products/edit_product.php'; ?>
<?php include 'Customers/add_customer.php'; ?>

<script src="assets/app.js"></script>
<script>
// Modal JS and edit functions
function closeModal(modalId){document.getElementById(modalId).classList.add('hidden');}
document.addEventListener('click',function(e){if(e.target.classList.contains('modal-backdrop')) e.target.classList.add('hidden');});

function editFarmer(farmer){
    document.getElementById('edit-farmer-id').value=farmer.id;
    document.getElementById('edit-farmer-name').value=farmer.name;
    document.getElementById('edit-farmer-email').value=farmer.email;
    document.getElementById('edit-farmer-phone').value=farmer.phone||'';
    document.getElementById('edit-farmer-farm-name').value=farmer.farm_name;
    document.getElementById('edit-farmer-location').value=farmer.location;
    document.getElementById('edit-farmer-bio').value=farmer.bio||'';
    document.getElementById('edit-farmer-pic-preview').src=farmer.farmer_pic?'uploads/profiles/'+farmer.farmer_pic:'https://via.placeholder.com/100';
    document.getElementById('edit-farmer-modal').classList.remove('hidden');
}

function editProduct(product){
    document.getElementById('edit-product-id').value=product.id;
    document.getElementById('edit-product-name').value=product.name;
    document.getElementById('edit-product-category').value=product.category;
    document.getElementById('edit-product-farmer').value=product.farmer_id;
    document.getElementById('edit-product-price').value=product.price;
    document.getElementById('edit-product-stock').value=product.stock;
    document.getElementById('edit-product-season').value=product.season;
    document.getElementById('edit-product-description').value=product.description||'';
    document.getElementById('edit-product-image').src='uploads/products/'+product.image_url;
    document.getElementById('edit-product-modal').classList.remove('hidden');
}
</script>
</body>
</html>
