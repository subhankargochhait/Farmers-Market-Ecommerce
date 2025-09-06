 <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl card-shadow p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <button onclick="document.getElementById('add-farmer-modal').classList.remove('hidden')" class="w-full flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                                    <i class="fas fa-user-plus text-green-600 mr-3"></i>
                                    <span class="text-green-700 font-medium">Add New Farmer</span>
                                </button>
                                <button onclick="document.getElementById('add-product-modal').classList.remove('hidden')" class="w-full flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                    <i class="fas fa-plus-circle text-blue-600 mr-3"></i>
                                    <span class="text-blue-700 font-medium">Add New Product</span>
                                </button>
                                <button onclick="document.getElementById('add-customer-modal').classList.remove('hidden')" class="w-full flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors">
                                    <i class="fas fa-user-friends text-purple-600 mr-3"></i>
                                    <span class="text-purple-700 font-medium">Add New Customer</span>
                                </button>
                                <button onclick="alert('Export functionality would generate CSV/PDF reports')" class="w-full flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                    <i class="fas fa-download text-gray-600 mr-3"></i>
                                    <span class="text-gray-700 font-medium">Export Reports</span>
                                </button>
                            </div>
                        </div>
                    </div>