<?php
include("../config/db.php");

// Get order ID from URL
if (!isset($_GET['order_id'])) {
    header("Location: shop.php");
    exit;
}
$order_id = intval($_GET['order_id']);

// Fetch order details
$stmt = $con->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$orderResult = $stmt->get_result();
$order = $orderResult->fetch_assoc();

if (!$order) {
    die("❌ Order not found!");
}

// Fetch order items
$itemStmt = $con->prepare("
    SELECT oi.*, p.name, p.image_url, f.name AS farmer_name 
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    JOIN farmers f ON oi.vendor_id = f.id
    WHERE oi.order_id = ?
");
$itemStmt->bind_param("i", $order_id);
$itemStmt->execute();
$orderItems = $itemStmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Success - Farm Fresh</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'bounce-slow': 'bounce 2s infinite',
            'fade-in': 'fadeIn 0.6s ease-in-out',
            'slide-up': 'slideUp 0.5s ease-out',
            'pulse-green': 'pulseGreen 2s infinite',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: '0', transform: 'translateY(20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            slideUp: {
              '0%': { opacity: '0', transform: 'translateY(30px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            },
            pulseGreen: {
              '0%, 100%': { boxShadow: '0 0 0 0 rgba(34, 197, 94, 0.4)' },
              '50%': { boxShadow: '0 0 0 10px rgba(34, 197, 94, 0)' }
            }
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-blue-50 min-h-screen">

<!-- Navbar -->
<?php include '../includes/user_header.php' ?>

<!-- Animated Background Pattern -->
<div class="fixed inset-0 pointer-events-none opacity-5">
  <div class="absolute top-0 left-0 w-full h-full" style="background-image: radial-gradient(circle at 1px 1px, rgba(34,197,94,0.3) 1px, transparent 0); background-size: 50px 50px;"></div>
</div>

<div class="max-w-6xl mx-auto py-8 px-4 relative z-10">
  
  <!-- Success Hero Section -->
  <div class="text-center mb-12 animate-fade-in">
    <div class="relative inline-block">
      <div class="w-24 h-24 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl animate-pulse-green">
        <svg class="w-12 h-12 text-white animate-bounce-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
        </svg>
      </div>
      <!-- Decorative rings -->
      <div class="absolute inset-0 w-24 h-24 border-4 border-green-200 rounded-full animate-ping mx-auto"></div>
      <div class="absolute inset-0 w-32 h-32 border-2 border-green-100 rounded-full animate-pulse mx-auto -m-4"></div>
    </div>
    
    <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent mb-4">
      Order Confirmed!
    </h1>
    <p class="text-xl text-gray-600 mb-2">Thank you for your purchase</p>
    <div class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm rounded-full px-6 py-3 shadow-lg border">
      <span class="text-gray-700">Order</span>
      <span class="font-mono font-bold text-green-600">#<?= $order['id']; ?></span>
      <span class="text-gray-400">•</span>
      <span class="text-gray-600"><?= date("d M Y", strtotime($order['created_at'])); ?></span>
    </div>
  </div>

  <!-- Order Timeline -->
  <div class="bg-white/60 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50 p-6 mb-8 animate-slide-up">
    <h3 class="text-lg font-semibold mb-4 text-gray-800">Order Timeline</h3>
    <div class="flex items-center justify-between relative">
      <!-- Progress Line -->
      <div class="absolute top-4 left-0 w-full h-0.5 bg-gray-200"></div>
      <div class="absolute top-4 left-0 h-0.5 bg-gradient-to-r from-green-500 to-green-600 transition-all duration-1000" style="width: 25%;"></div>
      
      <!-- Steps -->
      <div class="flex items-center justify-between w-full relative z-10">
        <div class="flex flex-col items-center">
          <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
            </svg>
          </div>
          <span class="text-xs mt-2 font-medium text-green-600">Ordered</span>
        </div>
        <div class="flex flex-col items-center">
          <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
            <span class="text-xs text-gray-600">2</span>
          </div>
          <span class="text-xs mt-2 text-gray-500">Processing</span>
        </div>
        <div class="flex flex-col items-center">
          <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
            <span class="text-xs text-gray-600">3</span>
          </div>
          <span class="text-xs mt-2 text-gray-500">Shipped</span>
        </div>
        <div class="flex flex-col items-center">
          <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
            <span class="text-xs text-gray-600">4</span>
          </div>
          <span class="text-xs mt-2 text-gray-500">Delivered</span>
        </div>
      </div>
    </div>
  </div>

  <div class="grid lg:grid-cols-3 gap-8 mb-8">
    
    <!-- Customer & Order Details -->
    <div class="lg:col-span-1 space-y-6">
      
      <!-- Customer Details Card -->
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50 overflow-hidden animate-slide-up">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-4">
          <h2 class="text-lg font-semibold text-white flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
            </svg>
            Customer Details
          </h2>
        </div>
        <div class="p-6 space-y-4">
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div>
              <p class="text-sm text-gray-500">Customer Name</p>
              <p class="font-semibold text-gray-800"><?= htmlspecialchars($order['customer_name']); ?></p>
            </div>
          </div>
          
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
              </svg>
            </div>
            <div>
              <p class="text-sm text-gray-500">Email</p>
              <p class="font-semibold text-gray-800 break-all"><?= htmlspecialchars($order['email']); ?></p>
            </div>
          </div>
          
          <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
              <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
              </svg>
            </div>
            <div>
              <p class="text-sm text-gray-500">Phone</p>
              <p class="font-semibold text-gray-800"><?= htmlspecialchars($order['phone']); ?></p>
            </div>
          </div>
          
          <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mt-1">
              <svg class="w-4 h-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div>
              <p class="text-sm text-gray-500">Delivery Address</p>
              <p class="font-semibold text-gray-800 leading-relaxed"><?= htmlspecialchars($order['address']); ?></p>
            </div>
          </div>
        </div>
      </div>

      <!-- Order Summary Card -->
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50 overflow-hidden animate-slide-up">
        <div class="bg-gradient-to-r from-green-500 to-teal-600 p-4">
          <h2 class="text-lg font-semibold text-white flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm6 7a1 1 0 011 1v3a1 1 0 11-2 0v-3a1 1 0 011-1zm-3 3a1 1 0 100 2h.01a1 1 0 100-2H10zm-4 1a1 1 0 011-1h.01a1 1 0 110 2H7a1 1 0 01-1-1zm1-4a1 1 0 100 2h.01a1 1 0 100-2H7zm2 1a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm4-4a1 1 0 100 2h.01a1 1 0 100-2H13z" clip-rule="evenodd"/>
            </svg>
            Order Summary
          </h2>
        </div>
        <div class="p-6 space-y-4">
          <div class="flex justify-between items-center">
            <span class="text-gray-600">Order ID</span>
            <span class="font-mono font-bold text-gray-800">#<?= $order['id']; ?></span>
          </div>
          
          <div class="flex justify-between items-center">
            <span class="text-gray-600">Date & Time</span>
            <span class="font-semibold text-gray-800"><?= date("d M Y, h:i A", strtotime($order['created_at'])); ?></span>
          </div>
          
          <div class="flex justify-between items-center">
            <span class="text-gray-600">Payment Method</span>
            <span class="font-semibold text-gray-800 capitalize"><?= htmlspecialchars($order['payment_method']); ?></span>
          </div>
          
          <div class="flex justify-between items-center">
            <span class="text-gray-600">Status</span>
            <?php 
              $status = $order['status'];
              $badgeClass = "bg-gray-100 text-gray-800"; // default
              $badgeIcon = "⏳";
              if ($status === "Pending") {
                $badgeClass = "bg-yellow-100 text-yellow-800 border-yellow-200";
                $badgeIcon = "⏳";
              } elseif ($status === "Completed" || $status === "Success") {
                $badgeClass = "bg-green-100 text-green-800 border-green-200";
                $badgeIcon = "✅";
              } elseif ($status === "Processing") {
                $badgeClass = "bg-blue-100 text-blue-800 border-blue-200";
                $badgeIcon = "🔄";
              } elseif ($status === "Cancelled") {
                $badgeClass = "bg-red-100 text-red-800 border-red-200";
                $badgeIcon = "❌";
              }
            ?>
            <span class="px-3 py-1.5 rounded-full text-sm font-semibold border <?= $badgeClass ?> flex items-center space-x-1">
              <span><?= $badgeIcon ?></span>
              <span><?= htmlspecialchars($status); ?></span>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Order Items -->
    <div class="lg:col-span-2">
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50 overflow-hidden animate-slide-up">
        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-6">
          <h2 class="text-xl font-semibold text-white flex items-center">
            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5zM8 15a1 1 0 001 1h2a1 1 0 001-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3z" clip-rule="evenodd"/>
            </svg>
            Your Order Items
            <span class="ml-3 bg-white/20 px-2 py-1 rounded-full text-sm"><?= count($orderItems); ?> items</span>
          </h2>
        </div>
        
        <div class="p-0">
          <?php $grand_total = 0; ?>
          <?php foreach ($orderItems as $index => $item): 
            $subtotal = $item['price_each'] * $item['quantity'];
            $grand_total += $subtotal;
          ?>
            <div class="p-6 border-b border-gray-100 hover:bg-gray-50/50 transition-all duration-200 <?= $index === 0 ? '' : 'border-t' ?>">
              <div class="flex items-center space-x-4">
                <div class="relative">
                  <?php if (!empty($item['image_url'])): ?>
                    <img src="../admin/uploads/products/<?= htmlspecialchars($item['image_url']); ?>" 
                         class="w-16 h-16 rounded-xl object-cover shadow-lg">
                    <div class="absolute -top-2 -right-2 bg-green-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center font-bold">
                      <?= $item['quantity']; ?>
                    </div>
                  <?php else: ?>
                    <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-lg">
                      <span class="text-2xl">📦</span>
                    </div>
                    <div class="absolute -top-2 -right-2 bg-green-500 text-white text-xs rounded-full w-6 h-6 flex items-center justify-center font-bold">
                      <?= $item['quantity']; ?>
                    </div>
                  <?php endif; ?>
                </div>
                
                <div class="flex-1">
                  <h3 class="font-bold text-gray-800 text-lg"><?= htmlspecialchars($item['name']); ?></h3>
                  <div class="flex items-center space-x-2 mt-1">
                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">
                      🌱 <?= htmlspecialchars($item['farmer_name']); ?>
                    </span>
                  </div>
                  <div class="flex items-center justify-between mt-3">
                    <div class="text-sm text-gray-600">
                      ₹<?= number_format($item['price_each'], 2); ?> × <?= $item['quantity']; ?>
                    </div>
                    <div class="text-xl font-bold text-green-600">
                      ₹<?= number_format($subtotal, 2); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        
        <!-- Grand Total -->
        <div class="bg-gradient-to-r from-green-600 to-teal-600 p-6">
          <div class="flex justify-between items-center">
            <span class="text-xl font-semibold text-white">Total Amount</span>
            <span class="text-3xl font-bold text-white">₹<?= number_format($grand_total, 2); ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="bg-white/60 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50 p-8 animate-slide-up">
    <div class="text-center mb-6">
      <h3 class="text-xl font-semibold text-gray-800 mb-2">What's Next?</h3>
      <p class="text-gray-600">Manage your order or continue shopping</p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-4 max-w-2xl mx-auto">
      <a href="download_invoice.php?order_id=<?= $order['id']; ?>" 
         class="group bg-gradient-to-r from-gray-800 to-gray-900 text-white px-6 py-4 rounded-xl text-center hover:from-gray-900 hover:to-black transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
        <div class="flex flex-col items-center space-y-2">
          <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
          </svg>
          <span class="font-semibold">Download Invoice</span>
        </div>
      </a>
      
      <a href="my_orders.php" 
         class="group bg-gradient-to-r from-green-500 to-teal-600 text-white px-6 py-4 rounded-xl text-center hover:from-green-600 hover:to-teal-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
        <div class="flex flex-col items-center space-y-2">
          <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span class="font-semibold">My Orders</span>
        </div>
      </a>
      
      <a href="shop.php" 
         class="group bg-white border-2 border-gray-200 text-gray-700 px-6 py-4 rounded-xl text-center hover:border-green-300 hover:bg-green-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
        <div class="flex flex-col items-center space-y-2">
          <svg class="w-6 h-6 group-hover:scale-110 transition-transform group-hover:text-green-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 2L3 7v11a2 2 0 002 2h10a2 2 0 002-2V7l-7-5z" clip-rule="evenodd"/>
          </svg>
          <span class="font-semibold group-hover:text-green-600">Continue Shopping</span>
        </div>
      </a>
    </div>
  </div>

  <!-- Thank You Message -->
  <div class="text-center mt-12 animate-fade-in">
    <div class="max-w-2xl mx-auto bg-white/40 backdrop-blur-sm rounded-2xl p-8 border border-white/50">
      <h3 class="text-2xl font-bold text-gray-800 mb-4">Thank You for Supporting Local Farmers! 🌾</h3>
      <p class="text-gray-600 leading-relaxed">
        Your purchase helps support sustainable farming practices and provides fresh, quality produce directly from our trusted farmers to your table. 
        We'll keep you updated on your order progress via email and SMS.
      </p>
      <div class="flex justify-center items-center space-x-6 mt-6">
        <div class="text-center">
          <div class="text-2xl mb-1">🚚</div>
          <div class="text-sm text-gray-600">Fast Delivery</div>
        </div>
        <div class="text-center">
          <div class="text-2xl mb-1">🌱</div>
          <div class="text-sm text-gray-600">Farm Fresh</div>
        </div>
        <div class="text-center">
          <div class="text-2xl mb-1">💚</div>
          <div class="text-sm text-gray-600">Eco-Friendly</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<?php include '../includes/footer.php' ?>

<script>
  // Add some interactive animations
  document.addEventListener('DOMContentLoaded', function() {
    // Animate elements on scroll
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.animation = entry.target.dataset.animation || 'fadeIn 0.6s ease-in-out forwards';
        }
      });
    }, observerOptions);
    
    // Observe all elements with animation classes
    document.querySelectorAll('.animate-slide-up, .animate-fade-in').forEach(el => {
      observer.observe(el);
    });
  });
</script>

</body>
</html>