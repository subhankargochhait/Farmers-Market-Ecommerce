 <header class="bg-white shadow-sm border-b border-gray-200 px-8 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        <?php 
                        $titles = [
                            'dashboard' => 'Dashboard',
                            'farmers' => 'Farmers Management',
                            'products' => 'Products Management',
                            'orders' => 'Orders Management',
                            'customers' => 'Customers Management',
                            'analytics' => 'Analytics & Reports',
                            'settings' => 'Settings'
                        ];
                        echo $titles[$tab] ?? 'Dashboard';
                        ?>
                    </h1>
                    <p class="text-gray-600">Manage your farmers market efficiently</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <i class="fas fa-bell text-gray-400 text-xl cursor-pointer hover:text-gray-600"></i>
                        <?php if ($stats['pending_orders'] > 0): ?>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"><?php echo $stats['pending_orders']; ?></span>
                        <?php endif; ?>
                    </div>
                  
                </div>
            </div>
        </header>