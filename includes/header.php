<?php
// FIX: start the session at the very top before using $_SESSION
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
$userName = $isLoggedIn ? ($_SESSION['username'] ?? $_SESSION['name'] ?? 'User') : 'Guest';
$userEmail = $isLoggedIn ? ($_SESSION['email'] ?? '') : '';
$userFirstName = $isLoggedIn ? explode(' ', $userName)[0] : 'Guest';

// Dynamic cart count
$cartCount = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Agrina Navbar</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                'farm-green': {
                    50: '#f0fdf4',
                    100: '#dcfce7',
                    500: '#22c55e',
                    600: '#16a34a',
                    700: '#15803d',
                    800: '#166534'
                }
            },
            animation: {
                'glow': 'glow 2s ease-in-out infinite alternate',
                'bounce-slow': 'bounce 3s infinite'
            }
        }
    }
}
</script>
<style>
@keyframes glow {
  from { box-shadow: 0 0 15px rgba(34,197,94,0.4); }
  to { box-shadow: 0 0 25px rgba(34,197,94,0.7); }
}
.navbar-glass { 
    backdrop-filter: blur(12px); 
    background: rgba(255,255,255,0.93);
    border-bottom: 1px solid rgba(34,197,94,0.1);
}
.nav-link {
    transition: all 0.3s ease;
    position: relative;
    border-radius: 8px;
}
.nav-link:hover {
    color: #15803d;
    background: rgba(34,197,94,0.08);
    transform: translateY(-1px);
}
.cart-button {
    background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(22,163,74,0.3);
}
.cart-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(22,163,74,0.4);
}
.hamburger { 
    width: 26px; 
    height: 20px; 
    position: relative; 
    cursor: pointer;
}
.hamburger span { 
    display: block; 
    position: absolute; 
    height: 3px; 
    width: 100%; 
    background: #374151; 
    border-radius: 2px; 
    transition: 0.3s ease-in-out;
}
.hamburger span:nth-child(1){top:0;} 
.hamburger span:nth-child(2){top:8px;} 
.hamburger span:nth-child(3){top:16px;}
.hamburger.open span:nth-child(1){top:8px;transform:rotate(135deg);}
.hamburger.open span:nth-child(2){opacity:0;left:-60px;}
.hamburger.open span:nth-child(3){top:8px;transform:rotate(-135deg);}
.mobile-menu-item{
    transform:translateX(-20px);
    opacity:0;
    transition:all 0.3s ease;
    border-radius: 6px;
}
.mobile-menu-item.show{
    transform:translateX(0);
    opacity:1;
}
.mobile-menu-item:hover {
    background: rgba(34,197,94,0.05);
    padding-left: 20px;
}
.username-section{
    background:linear-gradient(135deg,#16a34a 0%,#15803d 100%);
    color:white;
    padding:10px 0;
    font-size:14px;
    box-shadow: 0 2px 10px rgba(22,163,74,0.2);
}
.user-dropdown {
    background: white;
    border: 1px solid rgba(34,197,94,0.1);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border-radius: 12px;
}
.user-avatar {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    box-shadow: 0 2px 8px rgba(34,197,94,0.3);
    transition: all 0.3s ease;
}
.user-avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(34,197,94,0.4);
}
.logo-icon {
    background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    transition: all 0.3s ease;
}
.logo-icon:hover {
    transform: rotate(5deg) scale(1.05);
}
</style>
</head>
<body class="bg-gray-50">

<!-- Top Username Section -->
<div class="username-section fixed w-full top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
    <div class="flex items-center space-x-3">
      <div class="w-5 h-5 rounded-full bg-white/20 flex items-center justify-center">
        <i class="fas fa-user-circle text-sm"></i>
      </div>
      <span class="font-medium">Welcome, <?= htmlspecialchars($userName); ?></span>
      <?php if(!$isLoggedIn): ?>
      <span class="text-xs bg-yellow-300 text-yellow-800 px-3 py-1 rounded-full font-medium">Guest Mode</span>
      <?php endif; ?>
    </div>
    <div class="flex items-center space-x-4 text-sm">
      <div class="flex items-center space-x-1">
        <i class="fas fa-clock text-xs"></i>
        <span id="current-time" class="font-medium"></span>
      </div>
      <div class="hidden sm:flex items-center space-x-1">
        <i class="fas fa-calendar text-xs"></i>
        <span id="current-date" class="font-medium"></span>
      </div>
    </div>
  </div>
</div>

<!-- Navbar -->
<nav class="navbar-glass fixed w-full top-12 z-40 shadow-sm">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center h-20">
      
      <!-- Logo -->
      <div class="flex items-center space-x-3">
        <div class="logo-icon p-3 rounded-xl shadow-md animate-glow">
          <i class="fas fa-seedling text-white text-lg"></i>
        </div>
        <div>
          <div class="text-2xl font-bold text-farm-green-700">Agrina</div>
          <div class="text-xs text-gray-500 -mt-1 font-medium">Farm Fresh Products</div>
        </div>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden lg:flex items-center space-x-2">
        <a href="dashboard.php" class="nav-link px-5 py-2 font-medium text-gray-700">
          <i class="fas fa-home mr-2"></i>Home
        </a>
        <a href="about.php" class="nav-link px-5 py-2 font-medium text-gray-700">
          <i class="fas fa-info-circle mr-2"></i>About
        </a>
        <a href="services.php" class="nav-link px-5 py-2 font-medium text-gray-700">
          <i class="fas fa-tools mr-2"></i>Services
        </a>
        <a href="shop.php" class="nav-link px-5 py-2 font-medium text-gray-700">
          <i class="fas fa-store mr-2"></i>Shop
        </a>
        <a href="contact.php" class="nav-link px-5 py-2 font-medium text-gray-700">
          <i class="fas fa-phone mr-2"></i>Contact
        </a>
        
        <!-- Cart -->
        <a href="cart.php" class="cart-button relative text-white px-5 py-2 rounded-full font-medium ml-3">
          <i class="fas fa-shopping-cart mr-2"></i>Cart
          <?php if($cartCount > 0): ?>
          <span class="absolute -top-2 -right-2 bg-red-500 text-xs rounded-full px-2 py-1 animate-bounce-slow font-bold">
            <?= $cartCount; ?>
          </span>
          <?php endif; ?>
        </a>
        
        <a href="my_orders.php" class="nav-link px-5 py-2 font-medium text-gray-700">
          <i class="fas fa-receipt mr-2"></i>My Orders
        </a>
      </div>

      <!-- User / Login -->
      <div class="hidden lg:flex items-center space-x-4">
        <?php if($isLoggedIn): ?>
          <div class="relative group">
            <button class="flex items-center space-x-3 px-3 py-2 rounded-xl hover:bg-gray-50 transition-all duration-300">
              <div class="user-avatar w-9 h-9 rounded-full flex items-center justify-center text-white font-bold">
                <?= strtoupper(substr($userFirstName,0,1)); ?>
              </div>
              <div class="text-left">
                <div class="font-semibold text-gray-800"><?= htmlspecialchars($userFirstName); ?></div>
                <div class="text-xs text-gray-500">Member</div>
              </div>
              <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform group-hover:rotate-180"></i>
            </button>
            <div class="user-dropdown absolute right-0 mt-2 w-48 hidden group-hover:block">
              <a href="profile.php" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-farm-green-700 transition-colors">
                <i class="fas fa-user-edit mr-2"></i>Edit Profile
              </a>
              <a href="orders.php" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 hover:text-farm-green-700 transition-colors">
                <i class="fas fa-clipboard-list mr-2"></i>My Orders
              </a>
              <a href="logout.php" class="block px-4 py-3 text-red-600 hover:bg-red-50 transition-colors rounded-b-xl">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
              </a>
            </div>
          </div>
        <?php else: ?>
          <a href="login.php" class="px-5 py-2 border-2 border-farm-green-500 text-farm-green-600 rounded-lg font-medium hover:bg-farm-green-50 transition-all duration-300">
            Login
          </a>
          <a href="login.php" class="px-5 py-2 bg-yellow-400 text-yellow-900 rounded-lg font-medium hover:bg-yellow-500 transition-all duration-300 shadow-md">
            Register
          </a>
        <?php endif; ?>
      </div>

      <!-- Hamburger -->
      <div class="lg:hidden">
        <button onclick="toggleMobileMenu()" id="hamburger-btn" class="hamburger">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="lg:hidden overflow-hidden max-h-0 transition-all duration-500 bg-white border-t border-gray-100">
    <div class="px-4 pt-4 pb-6 space-y-2">
      
      <?php if($isLoggedIn): ?>
        <div class="flex items-center space-x-3 bg-farm-green-50 p-4 rounded-lg mobile-menu-item">
          <div class="user-avatar w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">
            <?= strtoupper(substr($userFirstName,0,1)); ?>
          </div>
          <div>
            <div class="font-semibold text-gray-800"><?= htmlspecialchars($userName); ?></div>
            <div class="text-sm text-gray-600"><?= htmlspecialchars($userEmail); ?></div>
          </div>
        </div>
      <?php else: ?>
        <div class="flex items-center space-x-3 bg-yellow-50 p-4 rounded-lg mobile-menu-item">
          <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center text-yellow-800">
            <i class="fas fa-user"></i>
          </div>
          <div>
            <div class="font-semibold text-gray-800">Guest User</div>
            <div class="text-sm text-gray-600">Please login to continue</div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Links -->
      <a href="dashboard.php" class="mobile-menu-item block px-4 py-3 text-gray-700 font-medium">
        <i class="fas fa-home mr-3 text-farm-green-500"></i>Home
      </a>
      <a href="about.php" class="mobile-menu-item block px-4 py-3 text-gray-700 font-medium">
        <i class="fas fa-info-circle mr-3 text-farm-green-500"></i>About
      </a>
      <a href="services.php" class="mobile-menu-item block px-4 py-3 text-gray-700 font-medium">
        <i class="fas fa-tools mr-3 text-farm-green-500"></i>Services
      </a>
      <a href="shop.php" class="mobile-menu-item block px-4 py-3 text-gray-700 font-medium">
        <i class="fas fa-store mr-3 text-farm-green-500"></i>Shop
      </a>
      <a href="cart.php" class="mobile-menu-item block px-4 py-3 text-gray-700 font-medium flex justify-between items-center">
        <span><i class="fas fa-shopping-cart mr-3 text-farm-green-500"></i>Cart</span>
        <?php if($cartCount > 0): ?>
        <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-bold"><?= $cartCount; ?></span>
        <?php endif; ?>
      </a>
      <a href="contact.php" class="mobile-menu-item block px-4 py-3 text-gray-700 font-medium">
        <i class="fas fa-phone mr-3 text-farm-green-500"></i>Contact
      </a>

      <div class="pt-4 border-t border-gray-200">
        <?php if($isLoggedIn): ?>
          <a href="profile.php" class="mobile-menu-item block px-4 py-3 text-gray-700 font-medium">
            <i class="fas fa-user-edit mr-3 text-farm-green-500"></i>Edit Profile
          </a>
          <a href="orders.php" class="mobile-menu-item block px-4 py-3 text-gray-700 font-medium">
            <i class="fas fa-clipboard-list mr-3 text-farm-green-500"></i>My Orders
          </a>
          <a href="logout.php" class="mobile-menu-item block px-4 py-3 text-red-600 font-medium">
            <i class="fas fa-sign-out-alt mr-3"></i>Logout
          </a>
        <?php else: ?>
          <a href="login.php" class="mobile-menu-item block px-4 py-3 border-2 border-farm-green-500 text-farm-green-600 rounded-lg font-medium text-center">
            Login
          </a>
          <a href="login.php" class="mobile-menu-item block px-4 py-3 bg-yellow-400 text-yellow-900 rounded-lg font-medium text-center mt-2">
            Register
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<div class="h-32"></div>

<script>
function toggleMobileMenu(){
  const menu=document.getElementById("mobile-menu");
  const hamburger=document.getElementById("hamburger-btn");
  const items=menu.querySelectorAll('.mobile-menu-item');
  if(menu.classList.contains("max-h-0")){
    menu.classList.remove("max-h-0");
    menu.classList.add("max-h-[800px]");
    hamburger.classList.add("open");
    items.forEach((item,i)=>{setTimeout(()=>item.classList.add("show"),i*50);});
  }else{
    menu.classList.add("max-h-0");
    menu.classList.remove("max-h-[800px]");
    hamburger.classList.remove("open");
    items.forEach(item=>item.classList.remove("show"));
  }
}

function updateDateTime(){
  const now=new Date();
  document.getElementById('current-time').textContent=now.toLocaleTimeString('en-US',{hour:'numeric',minute:'2-digit'});
  document.getElementById('current-date').textContent=now.toLocaleDateString('en-US',{weekday:'short',month:'short',day:'numeric'});
}
setInterval(updateDateTime,1000);
updateDateTime();
</script>
</body>
</html>