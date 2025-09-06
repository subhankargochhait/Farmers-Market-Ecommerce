

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Services - Farmers Market</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .service-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.2) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.18);
        }
        
        .hero-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .fade-in {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .fade-in-delay-1 { animation-delay: 0.2s; }
        .fade-in-delay-2 { animation-delay: 0.4s; }
        .fade-in-delay-3 { animation-delay: 0.6s; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stat-number {
            background: linear-gradient(45deg, #4CAF50, #81C784);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-blue-50 font-sans">

<!-- Navbar -->
<?php include '../includes/user_header.php' ?>
<!-- Hero Section -->
<section class="hero-bg text-white py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4 fade-in">Our Premium Services</h1>
        <p class="text-xl opacity-90 mb-8 max-w-3xl mx-auto fade-in fade-in-delay-1">
            Connecting you with nature's finest produce through innovative solutions and exceptional service
        </p>
        <div class="flex justify-center items-center space-x-8 fade-in fade-in-delay-2">
            <div class="text-center">
                <div class="text-3xl font-bold stat-number">500+</div>
                <div class="text-sm opacity-75">Happy Customers</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold stat-number">50+</div>
                <div class="text-sm opacity-75">Partner Farms</div>
            </div>
            <div class="text-center">
                <div class="text-3xl font-bold stat-number">24/7</div>
                <div class="text-sm opacity-75">Support</div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="max-w-7xl mx-auto px-4 py-16 -mt-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Service Card 1 -->
        <div class="service-card bg-white shadow-lg rounded-2xl p-8 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-green-400 to-green-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-leaf text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Fresh Farm Produce</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Premium vegetables, fruits, and herbs sourced directly from certified organic farms, ensuring maximum freshness and nutrition.
                </p>
                <div class="flex items-center justify-center space-x-2 text-sm text-green-600 font-semibold">
                    <i class="fas fa-check-circle"></i>
                    <span>100% Farm Fresh</span>
                </div>
            </div>
        </div>

        <!-- Service Card 2 -->
        <div class="service-card bg-white shadow-lg rounded-2xl p-8 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-truck text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Express Delivery</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Lightning-fast delivery service with real-time tracking, temperature-controlled transport, and same-day delivery options.
                </p>
                <div class="flex items-center justify-center space-x-2 text-sm text-blue-600 font-semibold">
                    <i class="fas fa-clock"></i>
                    <span>2-Hour Delivery</span>
                </div>
            </div>
        </div>

        <!-- Service Card 3 -->
        <div class="service-card bg-white shadow-lg rounded-2xl p-8 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-yellow-400 to-yellow-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-handshake text-yellow-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Farmer Partnerships</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Direct partnerships with local farmers ensuring fair trade practices, sustainable farming, and community support.
                </p>
                <div class="flex items-center justify-center space-x-2 text-sm text-yellow-600 font-semibold">
                    <i class="fas fa-heart"></i>
                    <span>Fair Trade Certified</span>
                </div>
            </div>
        </div>

        <!-- Service Card 4 -->
        <div class="service-card bg-white shadow-lg rounded-2xl p-8 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-purple-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-seedling text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Certified Organic</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Exclusively organic products grown without harmful pesticides, GMOs, or synthetic fertilizers - naturally pure and healthy.
                </p>
                <div class="flex items-center justify-center space-x-2 text-sm text-purple-600 font-semibold">
                    <i class="fas fa-certificate"></i>
                    <span>USDA Organic</span>
                </div>
            </div>
        </div>

        <!-- Service Card 5 -->
        <div class="service-card bg-white shadow-lg rounded-2xl p-8 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-pink-400 to-pink-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="bg-pink-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shield-alt text-pink-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Secure Payments</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Multiple secure payment gateways with bank-level encryption, digital wallets, and flexible payment plans available.
                </p>
                <div class="flex items-center justify-center space-x-2 text-sm text-pink-600 font-semibold">
                    <i class="fas fa-lock"></i>
                    <span>256-bit SSL Encrypted</span>
                </div>
            </div>
        </div>

        <!-- Service Card 6 -->
        <div class="service-card bg-white shadow-lg rounded-2xl p-8 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-400 to-indigo-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            <div class="relative z-10">
                <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-headset text-indigo-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Premium Support</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Dedicated customer success team available 24/7 via chat, phone, and email with multilingual support options.
                </p>
                <div class="flex items-center justify-center space-x-2 text-sm text-indigo-600 font-semibold">
                    <i class="fas fa-phone"></i>
                    <span>24/7 Available</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Additional Features Section -->
<section class="bg-gradient-to-r from-green-600 to-blue-600 py-16 mt-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-white mb-4">Why Choose Us?</h2>
            <p class="text-xl text-green-100 max-w-3xl mx-auto">
                Experience the difference with our commitment to quality, sustainability, and customer satisfaction
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div class="text-white">
                <i class="fas fa-award text-4xl mb-4 text-yellow-300"></i>
                <h3 class="text-xl font-semibold mb-2">Quality Guarantee</h3>
                <p class="text-green-100">100% satisfaction or money back</p>
            </div>
            <div class="text-white">
                <i class="fas fa-recycle text-4xl mb-4 text-green-300"></i>
                <h3 class="text-xl font-semibold mb-2">Eco-Friendly</h3>
                <p class="text-green-100">Sustainable packaging & practices</p>
            </div>
            <div class="text-white">
                <i class="fas fa-mobile-alt text-4xl mb-4 text-blue-300"></i>
                <h3 class="text-xl font-semibold mb-2">Mobile App</h3>
                <p class="text-green-100">Shop on-the-go with our app</p>
            </div>
            <div class="text-white">
                <i class="fas fa-users text-4xl mb-4 text-purple-300"></i>
                <h3 class="text-xl font-semibold mb-2">Community</h3>
                <p class="text-green-100">Join our farming community</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-4xl font-bold text-gray-800 mb-6">Ready to Get Started?</h2>
        <p class="text-xl text-gray-600 mb-8">
            Join thousands of satisfied customers who trust us for their fresh produce needs
        </p>
        <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
            <button class="bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-full font-semibold hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <i class="fas fa-shopping-cart mr-2"></i>
                Start Shopping
            </button>
            <button class="border-2 border-green-600 text-green-600 px-8 py-4 rounded-full font-semibold hover:bg-green-600 hover:text-white transition-all duration-300">
                <i class="fas fa-phone mr-2"></i>
                Contact Us
            </button>
        </div>
    </div>
</section>
<!-- Footer -->
<?php include '../includes/footer.php' ?>
</body>
</html>