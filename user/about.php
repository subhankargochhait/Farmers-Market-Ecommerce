

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meet Our Farmers - Fresh Valley Market</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            farmgreen: '#16a34a',
            earthy: '#92400e',
            harvest: '#f97316',
            skyblue: '#0ea5e9'
          },
          boxShadow: {
            soft: '0 10px 30px rgba(0,0,0,0.08)',
            glow: '0 0 20px rgba(16,185,129,0.5)'
          },
          animation: {
            fade: "fadeInUp 0.8s ease-out forwards"
          },
          keyframes: {
            fadeInUp: {
              '0%': { opacity: '0', transform: 'translateY(20px)' },
              '100%': { opacity: '1', transform: 'translateY(0)' }
            }
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-orange-50 text-gray-800">

<!-- Header -->
<?php include('../includes/user_header.php') ?>

<!-- Hero -->
<section class="relative h-[28rem] flex items-center justify-center text-white overflow-hidden">
  <img src="../assets/images/about-images2.jpg" alt="Farmer in field" class="absolute inset-0 w-full h-full object-cover">
  <div class="absolute inset-0 bg-black/50"></div>

  <div class="relative z-10 text-center max-w-3xl px-6 animate-fade">
    <h1 class="text-5xl font-extrabold mb-4">Meet Our Farmers</h1>
    <p class="text-lg text-gray-200 mb-6">
      Discover the passionate people behind your fresh produce. Verified, certified, and dedicated to sustainability.
    </p>
    <div class="inline-flex items-center bg-white/20 px-4 py-2 rounded-full text-sm">
      <svg class="w-5 h-5 text-green-300 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
      Background-checked & certified organic
    </div>
  </div>
</section>

<!-- Security Features -->
<section class="py-12 bg-gradient-to-r from-green-600 to-emerald-600 text-white">
  <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8 text-center px-6">
    <div class="p-6 bg-white/10 rounded-xl shadow-soft">
      <h4 class="font-bold mb-2">Verified Identity</h4>
      <p class="text-sm opacity-80">Every farmer passes identity & certification checks.</p>
    </div>
    <div class="p-6 bg-white/10 rounded-xl shadow-soft">
      <h4 class="font-bold mb-2">Secure Transactions</h4>
      <p class="text-sm opacity-80">Encrypted payments with fraud protection.</p>
    </div>
    <div class="p-6 bg-white/10 rounded-xl shadow-soft">
      <h4 class="font-bold mb-2">Quality Guaranteed</h4>
      <p class="text-sm opacity-80">Strict inspections & freshness assurance.</p>
    </div>
  </div>
</section>

<!-- Spotlight -->
<section class="py-16 px-6">
  <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
    <!-- Video -->
    <div class="overflow-hidden rounded-2xl shadow-glow">
      <iframe class="w-full h-80 rounded-2xl" src="https://www.youtube.com/embed/JW49jg7SUUE" allowfullscreen></iframe>
    </div>
    <!-- Details -->
    <div>
      <h3 class="text-3xl font-bold mb-4">Farmer Spotlight</h3>
      <p class="text-gray-600 mb-6">Get to know Sarah, one of our trusted organic farmers.</p>

      <h4 class="text-2xl font-bold">Sarah Martinez</h4>
      <p class="text-green-600 font-semibold mb-4">Organic Vegetable Farm</p>
      <p class="text-gray-600 mb-6 leading-relaxed">“I've been farming organically for 15+ years, building trust with families through fresh, healthy produce.”</p>

      <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-green-50 p-4 rounded-lg text-center">
          <div class="text-2xl font-bold text-green-600">15+</div>
          <p class="text-sm text-gray-600">Years Experience</p>
        </div>
        <div class="bg-orange-50 p-4 rounded-lg text-center">
          <div class="text-2xl font-bold text-orange-600">50+</div>
          <p class="text-sm text-gray-600">Crop Varieties</p>
        </div>
      </div>

      <button class="bg-green-600 hover:bg-green-500 text-white px-6 py-3 rounded-xl shadow-md transition flex items-center space-x-2">
        <span>Shop Sarah's Produce</span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </button>
    </div>
  </div>
</section>

<!-- Farmer Grid -->
<section class="py-16 bg-gray-50 px-6">
  <div class="max-w-6xl mx-auto text-center mb-12">
    <h3 class="text-3xl font-bold">Our Farmer Network</h3>
    <p class="text-gray-600">Meet the local heroes behind your food</p>
  </div>
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    <!-- Card Example -->
    <div class="bg-white rounded-2xl shadow-soft overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1">
      <div class="relative h-56">
        <img src="../assets/images/farmers4.jpg" class="w-full h-full object-cover">
        <span class="absolute top-4 right-4 bg-green-600 text-white text-xs px-3 py-1 rounded-full shadow">Verified</span>
      </div>
      <div class="p-6">
        <h4 class="text-xl font-bold">Mike Thompson</h4>
        <p class="text-green-600 font-semibold mb-3">Heritage Grain Farm</p>
        <p class="text-gray-600 text-sm mb-4">Specializing in heirloom grains & ancient wheat.</p>
        <button class="text-green-600 hover:underline text-sm font-semibold">View Profile →</button>
      </div>
    </div>

      <!-- Card Example -->
    <div class="bg-white rounded-2xl shadow-soft overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1">
      <div class="relative h-56">
        <img src="../assets/images/farmers5.jpg" class="w-full h-full object-cover">
        <span class="absolute top-4 right-4 bg-green-600 text-white text-xs px-3 py-1 rounded-full shadow">Verified</span>
      </div>
      <div class="p-6">
        <h4 class="text-xl font-bold">Mike Thompson</h4>
        <p class="text-green-600 font-semibold mb-3">Heritage Grain Farm</p>
        <p class="text-gray-600 text-sm mb-4">Specializing in heirloom grains & ancient wheat.</p>
        <button class="text-green-600 hover:underline text-sm font-semibold">View Profile →</button>
      </div>
    </div>
          <!-- Card Example -->
    <div class="bg-white rounded-2xl shadow-soft overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1">
      <div class="relative h-56">
        <img src="../assets/images/farmers6.jpg" class="w-full h-full object-cover">
        <span class="absolute top-4 right-4 bg-green-600 text-white text-xs px-3 py-1 rounded-full shadow">Verified</span>
      </div>
      <div class="p-6">
        <h4 class="text-xl font-bold">Mike Thompson</h4>
        <p class="text-green-600 font-semibold mb-3">Heritage Grain Farm</p>
        <p clas
        s="text-gray-600 text-sm mb-4">Specializing in heirloom grains & ancient wheat.</p>
        <button class="text-green-600 hover:underline text-sm font-semibold">View Profile →</button>
      </div>
    </div>


    <!-- Repeat cards for Lisa & David -->
  </div>
</section>

<!-- Trust -->
<section class="py-16 bg-gradient-to-r from-gray-800 to-gray-900 text-white px-6">
  <div class="max-w-6xl mx-auto text-center">
    <h3 class="text-3xl font-bold mb-10">Your Security, Our Priority</h3>
    <div class="grid md:grid-cols-4 gap-8">
      <div class="p-6 bg-white/10 rounded-xl shadow-soft">
        <h4 class="font-bold mb-2">Background Verified</h4>
        <p class="text-sm text-gray-300">Thorough checks & certifications.</p>
      </div>
      <div class="p-6 bg-white/10 rounded-xl shadow-soft">
        <h4 class="font-bold mb-2">Secure Payments</h4>
        <p class="text-sm text-gray-300">Encrypted transactions always safe.</p>
      </div>
      <div class="p-6 bg-white/10 rounded-xl shadow-soft">
        <h4 class="font-bold mb-2">Quality Assurance</h4>
        <p class="text-sm text-gray-300">Inspections & freshness standards.</p>
      </div>
      <div class="p-6 bg-white/10 rounded-xl shadow-soft">
        <h4 class="font-bold mb-2">24/7 Support</h4>
        <p class="text-sm text-gray-300">Always available to help you.</p>
      </div>
    </div>
  </div>
</section>

<?php include('../includes/footer.php') ?>

</body>
</html>
