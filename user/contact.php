
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - Farmers Market</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    .hero-bg {
      background: linear-gradient(135deg, #10B981 0%, #059669 50%, #047857 100%);
    }
    
    .contact-card {
      background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.2) 100%);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,0.18);
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
    
    .floating-icons {
      animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }
    
    .contact-info-item {
      transition: all 0.3s ease;
    }
    
    .contact-info-item:hover {
      transform: translateX(10px);
      background: linear-gradient(135deg, rgba(16,185,129,0.1) 0%, rgba(5,150,105,0.1) 100%);
      border-radius: 12px;
      padding: 16px;
    }
    
    .form-input {
      transition: all 0.3s ease;
      border: 2px solid #e5e7eb;
    }
    
    .form-input:focus {
      border-color: #10B981;
      box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
      transform: translateY(-2px);
    }
    
    .gradient-text {
      background: linear-gradient(135deg, #10B981, #059669);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    details[open] summary {
      color: #10B981;
    }
    
    .map-container {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    .quick-contact-floating {
      position: fixed;
      bottom: 30px;
      right: 30px;
      z-index: 1000;
    }
    
    @media (max-width: 768px) {
      .quick-contact-floating {
        bottom: 20px;
        right: 20px;
      }
    }
  </style>
</head>
<body class="bg-gradient-to-br from-green-50 via-white to-emerald-50 font-sans">
<!-- Navbar -->
<?php include '../includes/user_header.php' ?>
<!-- Hero Section -->
<section class="hero-bg text-white py-20 relative overflow-hidden">
  <div class="absolute inset-0">
    <div class="absolute top-10 left-10 w-20 h-20 bg-white bg-opacity-10 rounded-full floating-icons"></div>
    <div class="absolute top-32 right-20 w-16 h-16 bg-white bg-opacity-10 rounded-full floating-icons" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-20 left-1/4 w-12 h-12 bg-white bg-opacity-10 rounded-full floating-icons" style="animation-delay: 2s;"></div>
  </div>
  
  <div class="max-w-7xl mx-auto px-4 text-center relative z-10">
    <i class="fas fa-comments text-6xl mb-6 fade-in opacity-80"></i>
    <h1 class="text-5xl font-bold mb-6 fade-in fade-in-delay-1">Get in Touch With Us</h1>
    <p class="text-xl mb-8 max-w-3xl mx-auto opacity-90 fade-in fade-in-delay-2">
      Have questions about our services, products, or orders? We'd love to hear from you. 
      Our team is here to provide the information and support you need.
    </p>
    <div class="flex justify-center space-x-8 fade-in fade-in-delay-3">
      <div class="text-center">
        <div class="text-3xl font-bold">24/7</div>
        <div class="text-sm opacity-75">Support Available</div>
      </div>
      <div class="text-center">
        <div class="text-3xl font-bold">&lt;2h</div>
        <div class="text-sm opacity-75">Response Time</div>
      </div>
      <div class="text-center">
        <div class="text-3xl font-bold">500+</div>
        <div class="text-sm opacity-75">Happy Customers</div>
      </div>
    </div>
  </div>
</section>

<!-- Contact Section -->
<div class="max-w-7xl mx-auto px-4 py-16 -mt-12">
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

    <!-- Contact Info -->
    <div class="space-y-8">
      <div class="bg-white rounded-2xl shadow-2xl p-8">
        <h2 class="text-3xl font-bold mb-6 gradient-text">Contact Information</h2>
        <p class="text-gray-600 mb-8 leading-relaxed">
          You can reach us anytime via email, phone, or by visiting our office. We also welcome farmer partnerships and are excited to hear from potential collaborators!
        </p>

        <div class="space-y-6">
          <div class="contact-info-item flex items-start gap-4 p-4 -m-4">
            <div class="bg-green-100 p-3 rounded-full flex-shrink-0">
              <i class="fas fa-map-marker-alt text-green-600 text-xl"></i>
            </div>
            <div>
              <h4 class="font-bold text-gray-800 text-lg mb-1">Our Address</h4>
              <p class="text-gray-600">123 Farmers Lane, Kolkata, West Bengal, India</p>
              <p class="text-sm text-gray-500 mt-1">Ground Floor, Green Valley Complex</p>
            </div>
          </div>

          <div class="contact-info-item flex items-start gap-4 p-4 -m-4">
            <div class="bg-blue-100 p-3 rounded-full flex-shrink-0">
              <i class="fas fa-phone text-blue-600 text-xl"></i>
            </div>
            <div>
              <h4 class="font-bold text-gray-800 text-lg mb-1">Phone Number</h4>
              <p class="text-gray-600">+91 98765 43210</p>
              <p class="text-sm text-gray-500 mt-1">WhatsApp available</p>
            </div>
          </div>

          <div class="contact-info-item flex items-start gap-4 p-4 -m-4">
            <div class="bg-purple-100 p-3 rounded-full flex-shrink-0">
              <i class="fas fa-envelope text-purple-600 text-xl"></i>
            </div>
            <div>
              <h4 class="font-bold text-gray-800 text-lg mb-1">Email Address</h4>
              <p class="text-gray-600">support@farmersmarket.com</p>
              <p class="text-sm text-gray-500 mt-1">We respond within 2 hours</p>
            </div>
          </div>

          <div class="contact-info-item flex items-start gap-4 p-4 -m-4">
            <div class="bg-orange-100 p-3 rounded-full flex-shrink-0">
              <i class="fas fa-clock text-orange-600 text-xl"></i>
            </div>
            <div>
              <h4 class="font-bold text-gray-800 text-lg mb-1">Working Hours</h4>
              <p class="text-gray-600">Monday - Saturday: 9 AM - 7 PM</p>
              <p class="text-sm text-gray-500 mt-1">Sunday: Emergency support only</p>
            </div>
          </div>
        </div>

        <!-- Social Media Links -->
        <div class="mt-8 pt-8 border-t border-gray-200">
          <h4 class="font-bold text-gray-800 mb-4">Follow Us</h4>
          <div class="flex space-x-4">
            <a href="#" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition-colors">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="bg-pink-600 text-white p-3 rounded-full hover:bg-pink-700 transition-colors">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="bg-blue-400 text-white p-3 rounded-full hover:bg-blue-500 transition-colors">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="bg-green-600 text-white p-3 rounded-full hover:bg-green-700 transition-colors">
              <i class="fab fa-whatsapp"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact Form -->
    <div class="bg-white rounded-2xl shadow-2xl p-8">
      <h2 class="text-3xl font-bold mb-6 gradient-text">Send Us a Message</h2>
      <form method="POST" action="send_message.php" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block font-semibold text-gray-700 mb-2">Your Name</label>
            <input type="text" name="name" required 
                   class="form-input w-full rounded-xl px-4 py-3 focus:outline-none"
                   placeholder="Enter your full name">
          </div>
          <div>
            <label class="block font-semibold text-gray-700 mb-2">Your Email</label>
            <input type="email" name="email" required 
                   class="form-input w-full rounded-xl px-4 py-3 focus:outline-none"
                   placeholder="your.email@example.com">
          </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block font-semibold text-gray-700 mb-2">Phone Number</label>
            <input type="tel" name="phone" 
                   class="form-input w-full rounded-xl px-4 py-3 focus:outline-none"
                   placeholder="+91 98765 43210">
          </div>
          <div>
            <label class="block font-semibold text-gray-700 mb-2">Subject</label>
            <select name="subject" required class="form-input w-full rounded-xl px-4 py-3 focus:outline-none">
              <option value="">Select a subject</option>
              <option value="general">General Inquiry</option>
              <option value="order">Order Support</option>
              <option value="partnership">Farmer Partnership</option>
              <option value="complaint">Complaint</option>
              <option value="feedback">Feedback</option>
            </select>
          </div>
        </div>
        
        <div>
          <label class="block font-semibold text-gray-700 mb-2">Message</label>
          <textarea name="message" rows="5" required 
                    class="form-input w-full rounded-xl px-4 py-3 focus:outline-none resize-none"
                    placeholder="Please describe your inquiry in detail..."></textarea>
        </div>
        
        <div class="flex items-center gap-3">
          <input type="checkbox" id="newsletter" name="newsletter" class="w-4 h-4 text-green-600">
          <label for="newsletter" class="text-sm text-gray-600">
            Subscribe to our newsletter for updates and offers
          </label>
        </div>
        
        <button type="submit" 
                class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white py-4 rounded-xl font-semibold hover:from-green-700 hover:to-green-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
          <i class="fas fa-paper-plane mr-2"></i>
          Send Message
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Map Section -->
<section class="max-w-7xl mx-auto px-4 py-16">
  <div class="text-center mb-12">
    <h2 class="text-4xl font-bold mb-4 gradient-text">Find Us On Map</h2>
    <p class="text-gray-600 text-lg">Visit our physical location or get directions</p>
  </div>
  
  <div class="map-container">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.4330285725793!2d88.36389591427685!3d22.572646885177904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0277a2d3b61c3f%3A0x6fdfc3f7c4f4d29f!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1614066809820!5m2!1sen!2sin" 
      width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
    </iframe>
  </div>
</section>

<!-- FAQ Section -->
<section class="bg-gradient-to-r from-gray-100 to-green-50 py-16">
  <div class="max-w-7xl mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-4xl font-bold mb-4 gradient-text">Frequently Asked Questions</h2>
      <p class="text-gray-600 text-lg">Quick answers to common questions</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <details class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
        <summary class="font-bold text-lg cursor-pointer text-gray-800 hover:text-green-600 transition-colors">
          <i class="fas fa-shopping-cart mr-2"></i>How do I place an order?
        </summary>
        <p class="text-gray-600 mt-4 leading-relaxed">Simply visit our Shop page, browse through our fresh produce, select the products you like, add them to your cart, and proceed to our secure checkout process.</p>
      </details>
      
      <details class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
        <summary class="font-bold text-lg cursor-pointer text-gray-800 hover:text-green-600 transition-colors">
          <i class="fas fa-truck mr-2"></i>Do you deliver to all areas?
        </summary>
        <p class="text-gray-600 mt-4 leading-relaxed">We deliver across most major cities in India. You can check delivery availability and estimated delivery times during the checkout process by entering your pincode.</p>
      </details>
      
      <details class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
        <summary class="font-bold text-lg cursor-pointer text-gray-800 hover:text-green-600 transition-colors">
          <i class="fas fa-handshake mr-2"></i>Can farmers join your platform?
        </summary>
        <p class="text-gray-600 mt-4 leading-relaxed">Absolutely! We welcome farmers to partner with us. Contact our support team with your farming details, and we'll guide you through the registration process to become a verified vendor.</p>
      </details>
      
      <details class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
        <summary class="font-bold text-lg cursor-pointer text-gray-800 hover:text-green-600 transition-colors">
          <i class="fas fa-credit-card mr-2"></i>What payment methods are supported?
        </summary>
        <p class="text-gray-600 mt-4 leading-relaxed">We support multiple secure payment options including UPI, debit/credit cards, net banking, digital wallets, and cash on delivery for your convenience.</p>
      </details>
      
      <details class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
        <summary class="font-bold text-lg cursor-pointer text-gray-800 hover:text-green-600 transition-colors">
          <i class="fas fa-undo mr-2"></i>What is your return policy?
        </summary>
        <p class="text-gray-600 mt-4 leading-relaxed">We offer a 100% satisfaction guarantee. If you're not satisfied with the quality of our products, contact us within 24 hours of delivery for a full refund or replacement.</p>
      </details>
      
      <details class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
        <summary class="font-bold text-lg cursor-pointer text-gray-800 hover:text-green-600 transition-colors">
          <i class="fas fa-leaf mr-2"></i>Are your products organic?
        </summary>
        <p class="text-gray-600 mt-4 leading-relaxed">We offer both organic and conventional products. All organic items are clearly marked and certified by recognized organic certification bodies to ensure authenticity.</p>
      </details>
    </div>
  </div>
</section>

<!-- Quick Contact Floating Button -->
<div class="quick-contact-floating">
  <div class="flex flex-col space-y-3">
    <a href="tel:+919876543210" 
       class="bg-green-600 text-white p-4 rounded-full shadow-lg hover:bg-green-700 transition-all hover:scale-110">
      <i class="fas fa-phone text-xl"></i>
    </a>
    <a href="https://wa.me/919876543210" 
       class="bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition-all hover:scale-110">
      <i class="fab fa-whatsapp text-xl"></i>
    </a>
    <a href="mailto:support@farmersmarket.com" 
       class="bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition-all hover:scale-110">
      <i class="fas fa-envelope text-xl"></i>
    </a>
  </div>
</div>
<!-- Footer -->
<?php include '../includes/footer.php' ?>
</body>
</html>