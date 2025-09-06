
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrina - Quality Trust Direct to the Farm</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/umd/lucide.js"></script>
    <style>
        .hero-bg {
            background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), 
                        url('../assets/images/background-image.jpg');
            background-size: cover;
            background-position: center;
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="font-sans">

<?php include('../includes/user_header.php') ?>

    <!-- Hero Section -->
    <section class="hero-bg min-h-screen flex items-center pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        Quality Trust:<br>
                        <span class="text-yellow-400">Direct to the Farm</span>
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 text-gray-200">
                        Connecting farmers with quality agricultural solutions for sustainable growth and prosperity.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg font-semibold transition duration-300 flex items-center justify-center">
                            <i data-lucide="leaf" class="w-5 h-5 mr-2"></i>
                            Explore Products
                        </button>
                        <button class="border-2 border-white text-white hover:bg-white hover:text-green-600 px-8 py-4 rounded-lg font-semibold transition duration-300 flex items-center justify-center">
                            <i data-lucide="play" class="w-5 h-5 mr-2"></i>
                            Watch Video
                        </button>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 animate-float">
                        <div class="text-center">
                            <div class="text-6xl mb-4">🌱</div>
                            <h3 class="text-2xl font-bold text-white mb-4">Farm Fresh Quality</h3>
                            <p class="text-gray-200">Premium agricultural products delivered directly from our trusted farms.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                       <img src="../assets/images/Background (1).png" alt="Natural Process">
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Natural Process</h3>
                    <p class="text-gray-600">100% natural and organic farming processes ensuring quality produce.</p>
                </div>
                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                       <img src="../assets/images/Background (2).png" alt="Fast Vegetable">
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fast Vegetable</h3>
                    <p class="text-gray-600">Quick delivery of fresh vegetables directly from farm to table.</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="../assets/images/Background (3).png" alt="Top Organic Products">
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Top Organic Products</h3>
                    <p class="text-gray-600">Premium quality organic products certified and tested.</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                       <img src="../assets/images/Background (4).png" alt="Natural Process">
                    </div>
                    <h3 class="text-xl font-semibold mb-2">100% Guaranteed</h3>
                    <p class="text-gray-600">Money-back guarantee on all our agricultural products.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="bg-green-50 rounded-2xl p-8 relative overflow-hidden">
                        <div class="absolute top-4 right-4 bg-yellow-400 text-black px-4 py-2 rounded-full font-bold text-lg">
                            435<sup class="text-sm">+</sup>
                        </div>
                      <img src="../assets/images/Background (5).png" alt="Natural Process">
                    
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">
                        Currently we are growing and selling organic food
                    </h2>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        We have been committed to sustainable agriculture for over 70 years. Our mission is to provide the highest quality organic produce while maintaining environmental responsibility and supporting local farming communities.
                    </p>
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div>
                            <h4 class="font-semibold text-green-600 mb-2">🌿 Organic Farming</h4>
                            <p class="text-sm text-gray-600">Certified organic practices ensuring pure, natural produce.</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-green-600 mb-2">🚚 Direct Delivery</h4>
                            <p class="text-sm text-gray-600">Farm-fresh products delivered directly to your doorstep.</p>
                        </div>
                    </div>
                    <button class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300">
                        Learn More About Us
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Trusted Brands Section -->
    <section class="py-12 bg-gray-50">
        <img src="../assets/images/Section (2).png" alt="">
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-green-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Best Agriculture Services</h2>
                <div class="flex justify-center">
                    <div class="bg-yellow-400 h-1 w-20 rounded-full"></div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-6 card-hover">
                    <img src="../assets/images/service-img-01.png" alt="">
                    <h3 class="text-xl font-semibold mb-3">Advanced Equipment</h3>
                    <p class="text-gray-600 mb-4">Modern farming equipment and machinery for efficient agricultural operations.</p>
                    <div class="flex items-center text-green-600 font-semibold">
                        <span class="mr-2">Learn More</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 card-hover">
                    <img src="../assets/images/service-img-02.jpg.png" alt="">
                    <h3 class="text-xl font-semibold mb-3">Farming Consult</h3>
                    <p class="text-gray-600 mb-4">Expert consultation services to optimize your farming practices and yield.</p>
                    <div class="flex items-center text-green-600 font-semibold">
                        <span class="mr-2">Learn More</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 card-hover">
                                     <img src="../assets/images/service-img-03.jpg.png" alt="">
                    <h3 class="text-xl font-semibold mb-3">Soil Analysis</h3>
                    <p class="text-gray-600 mb-4">Comprehensive soil testing and analysis for optimal crop planning.</p>
                    <div class="flex items-center text-green-600 font-semibold">
                        <span class="mr-2">Learn More</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

 <!-- Products Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-800">Choose What's Perfect For Your Field</h2>
            </div>
            
            <!-- Main Content Container -->
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                
                <!-- Left Side Products (2 cards) -->
                <div class="flex flex-col space-y-8 flex-1">
                    <!-- Agriculture Products -->
                    <div class="text-center">
                        <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 hover:bg-yellow-200 transition-colors duration-300">
                             <img data-lucide="star" class=" fill-current" src="../assets/images/Background (1).png" alt="">
                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">Agriculture Products</h3>
                        <p class="text-gray-600 text-sm">High-quality agricultural products for all farming needs.</p>
                    </div>
                    
                    <!-- Fresh Vegetables -->
                    <div class="text-center">
                        <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 hover:bg-green-200 transition-colors duration-300">
                        <img data-lucide="star" class=" fill-current" src="..\assets\images\Background (2).png" alt="">
                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">Fresh Vegetables</h3>
                        <p class="text-gray-600 text-sm">Farm-fresh vegetables harvested at peak ripeness.</p>
                    </div>
                </div>
                
                <!-- Center Image -->
                <div class="flex-shrink-0 mx-8">
                    <div class="float-animation">
                        <!-- Placeholder for corn image - replace src with your actual image path -->
                          <img data-lucide="star" class=" fill-current" src="..\assets\images\img-02.png.png" alt="">
                        <!-- Uncomment below and replace with your actual image -->
                        <!-- <img src="assets/images/img-02.png" alt="Corn" class="corn-image"> -->
                    </div>
                </div>
                
                <!-- Right Side Products (2 cards) -->
                <div class="flex flex-col space-y-8 flex-1">
                    <!-- Dairy Products -->
                    <div class="text-center">
                        <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 hover:bg-blue-200 transition-colors duration-300">
                   <img data-lucide="star" class=" fill-current" src="../assets/images/Background (3).png" alt="">

                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">Dairy Products</h3>
                        <p class="text-gray-600 text-sm">Pure and natural dairy products from grass-fed cattle.</p>
                    </div>
                    
                    <!-- Organic Harvest -->
                    <div class="text-center">
                        <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 hover:bg-orange-200 transition-colors duration-300">
                    <img data-lucide="star" class=" fill-current" src="../assets/images/Background (4).png" alt="">

                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">Organic Harvest</h3>
                        <p class="text-gray-600 text-sm">Certified organic harvest with sustainable farming practices.</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
            

    <!-- Testimonials -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">What our customers say</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <img data-lucide="star" class=" fill-current" src="../assets/images/9.png" alt="">
                          
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Excellent quality products and outstanding service. The organic vegetables are always fresh and delivered on time."</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">👨‍🌾</div>
                        <div>
                            <div class="font-semibold">John Smith</div>
                            <div class="text-sm text-gray-500">Local Farmer</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                             <img data-lucide="star" class=" fill-current" src="..\assets\images\Container1.png" alt="">
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"Their agricultural consulting services helped increase our crop yield by 40%. Highly recommended for all farmers."</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">👩‍🌾</div>
                        <div>
                            <div class="font-semibold">Sarah Johnson</div>
                            <div class="text-sm text-gray-500">Farm Owner</div>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                             <img data-lucide="star" class=" fill-current" src="..\assets\images\Container3.png" alt="">
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">"The best organic produce supplier in the region. Quality, reliability, and competitive prices make them our top choice."</p>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">🧑‍💼</div>
                        <div>
                            <div class="font-semibold">Mike Davis</div>
                            <div class="text-sm text-gray-500">Restaurant Owner</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="bg-yellow-400 rounded-2xl p-8 text-center">
                    <h3 class="text-2xl font-bold text-black mb-4">Healthy life with fresh products</h3>
                    <p class="text-black mb-6">Join thousands of satisfied customers who choose our organic products for a healthier lifestyle.</p>
                    <div class="flex justify-center space-x-8">
                        <button class="bg-white text-yellow-600 p-3 rounded-full hover:scale-110 transition-transform">
                            <i data-lucide="phone" class="w-6 h-6"></i>
                        </button>
                        <button class="bg-white text-yellow-600 p-3 rounded-full hover:scale-110 transition-transform">
                            <i data-lucide="mail" class="w-6 h-6"></i>
                        </button>
                    </div>
                </div>
                <div>
                   <img src="../assets/images/background6.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- Global Leader Section -->
<section class="relative bg-green-700 py-16 bg-cover bg-center" style="background-image: url('assets/images/Background(7).png');">
  <!-- Overlay -->
  <div class="absolute inset-0 bg-black/50"></div>

  <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
      <div class="bg-yellow-400 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
          <i data-lucide="globe" class="w-8 h-8 text-green-700"></i>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold mb-4">
          We're popular leader in agriculture market globally.
      </h2>
      <button class="bg-white text-green-700 hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold transition duration-300">
          Contact Us
      </button>
  </div>
</section>

    <!-- Blog Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Latest posts & articles</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <article class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
                    <div class=" justify-center "><img src="..\assets/images/blog-image-01.jpg.png" alt=""></div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">Water harvesting is used in practical of sustainable agriculture</h3>
                        <p class="text-gray-600 text-sm mb-4">Learn about innovative water conservation techniques that are revolutionizing modern farming practices.</p>
                        <div class="text-green-600 font-semibold text-sm">Read More →</div>
                    </div>
                </article>
                <article class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
                    <div class=" justify-center "><img src="../assets/images/blog-image-02.jpg.png" alt=""></div>>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">Principles of farming science and sustainable agriculture technology</h3>
                        <p class="text-gray-600 text-sm mb-4">Discover the latest scientific principles driving sustainable agriculture and modern farming technology.</p>
                        <div class="text-green-600 font-semibold text-sm">Read More →</div>
                    </div>
                </article>
                <article class="bg-white rounded-lg shadow-sm overflow-hidden card-hover">
                   <div class=" justify-center "><img src="../assets/images/blog-image-03.jpg.png" alt=""></div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">The future movement business that bring to grow in agriculture</h3>
                        <p class="text-gray-600 text-sm mb-4">Explore emerging business trends and opportunities in the rapidly evolving agricultural sector.</p>
                        <div class="text-green-600 font-semibold text-sm">Read More →</div>
                    </div>
                </article>
            </div>
        </div>
    </section>

<?php include('../includes/footer.php') ?>

    <source src="assets/js/app.js">
     <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>

</body>
</html>