<div class="fade-in">
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Analytics & Reports</h2>
                    <p class="text-gray-600">Insights and performance metrics</p>
                </div>
                
                <!-- Analytics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl card-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Monthly Revenue</p>
                                <p class="text-2xl font-bold text-green-600">₹<?php echo number_format($stats['monthly_revenue'], 2); ?></p>
                            </div>
                            <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl card-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Avg Order Value</p>
                                <p class="text-2xl font-bold text-blue-600">₹<?php echo $stats['total_orders'] > 0 ? number_format($stats['total_revenue'] / $stats['total_orders'], 2) : '0.00'; ?></p>
                            </div>
                            <i class="fas fa-calculator text-blue-600 text-2xl"></i>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl card-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Active Products</p>
                                <p class="text-2xl font-bold text-purple-600"><?php echo $stats['total_products']; ?></p>
                            </div>
                            <i class="fas fa-box text-purple-600 text-2xl"></i>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl card-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Customer Retention</p>
                                <p class="text-2xl font-bold text-indigo-600">78%</p>
                            </div>
                            <i class="fas fa-heart text-indigo-600 text-2xl"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Charts Placeholder -->
                <div class="grid lg:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-xl card-shadow">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Sales Trend</h3>
                        <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-chart-area text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500">Sales chart would be displayed here</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-xl card-shadow">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Product Categories</h3>
                        <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                            <div class="text-center">
                                <i class="fas fa-chart-pie text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500">Category distribution chart</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>