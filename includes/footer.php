<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Agrina Footer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="bg-gray-100">
    

    <!-- Simple Footer -->
    <footer class="bg-green-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Brand -->
                <div>
                    <div class="text-2xl font-bold mb-4">🌾 Agrina</div>
                    <p class="text-green-200 mb-6">Professional agriculture solutions to help your business grow.</p>
                    <div class="flex space-x-3">
                        <a href="#" class="bg-green-700 p-2 rounded hover:bg-green-600">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="bg-green-700 p-2 rounded hover:bg-green-600">
                            <i data-lucide="twitter" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="bg-green-700 p-2 rounded hover:bg-green-600">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </a>
                        <a href="#" class="bg-green-700 p-2 rounded hover:bg-green-600">
                            <i data-lucide="linkedin" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- Products -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Products</h4>
                    <ul class="space-y-2 text-green-200">
                        <li><a href="#" class="hover:text-white">Vegetables & Fruits</a></li>
                        <li><a href="#" class="hover:text-white">Grain & Oilseed</a></li>
                        <li><a href="#" class="hover:text-white">Livestock & Meat</a></li>
                        <li><a href="#" class="hover:text-white">Machinery & Tools</a></li>
                        <li><a href="#" class="hover:text-white">Fertilizers</a></li>
                    </ul>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-green-200">
                        <li><a href="#" class="hover:text-white">Home</a></li>
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">Services</a></li>
                        <li><a href="#" class="hover:text-white">Shop</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <div class="space-y-3 text-green-200">
                        <div class="flex items-start">
                            <i data-lucide="map-pin" class="w-4 h-4 mr-2 mt-1"></i>
                            <p>123 Farm Street, Agriculture City, AC 12345</p>
                        </div>
                        <div class="flex items-center">
                            <i data-lucide="phone" class="w-4 h-4 mr-2"></i>
                            <p>+1 (555) 123-4567</p>
                        </div>
                        <div class="flex items-center">
                            <i data-lucide="mail" class="w-4 h-4 mr-2"></i>
                            <p>info@agrina.com</p>
                        </div>
                        <div class="flex items-center">
                            <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                            <p>Mon - Fri: 8:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom -->
            <div class="border-t border-green-700 mt-8 pt-6 text-center">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-green-200">&copy; 2024 Agrina. All rights reserved.</p>
                    <div class="flex space-x-4 mt-2 md:mt-0">
                        <a href="#" class="text-green-200 hover:text-white text-sm">Privacy Policy</a>
                        <a href="#" class="text-green-200 hover:text-white text-sm">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>