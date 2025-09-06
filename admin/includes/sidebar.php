<div class="admin-sidebar w-64 text-white p-6 overflow-y-auto">
        <div class="flex items-center mb-8">
            <i class="fas fa-seedling text-3xl text-green-400 mr-3"></i>
            <div>
                <h2 class="text-xl font-bold">Fresh Harvest</h2>
                <p class="text-sm text-gray-300">Admin Panel</p>
            </div>
        </div>
        
        <nav class="space-y-2">
            <a href="?tab=dashboard" class="flex items-center py-3 px-4 rounded-lg transition-colors <?php echo $tab === 'dashboard' ? 'bg-gray-600 text-white' : 'hover:bg-gray-600 text-gray-300'; ?>">
                <i class="fas fa-tachometer-alt mr-3 w-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="?tab=farmers" class="flex items-center py-3 px-4 rounded-lg transition-colors <?php echo $tab === 'farmers' ? 'bg-gray-600 text-white' : 'hover:bg-gray-600 text-gray-300'; ?>">
                <i class="fas fa-users mr-3 w-5"></i>
                <span>Farmers</span>
                <span class="ml-auto bg-green-500 text-white text-xs px-2 py-1 rounded-full"><?php echo count($farmers); ?></span>
            </a>
            <a href="?tab=products" class="flex items-center py-3 px-4 rounded-lg transition-colors <?php echo $tab === 'products' ? 'bg-gray-600 text-white' : 'hover:bg-gray-600 text-gray-300'; ?>">
                <i class="fas fa-apple-alt mr-3 w-5"></i>
                <span>Products</span>
                <span class="ml-auto bg-blue-500 text-white text-xs px-2 py-1 rounded-full"><?php echo count($products); ?></span>
            </a>
            <a href="?tab=orders" class="flex items-center py-3 px-4 rounded-lg transition-colors <?php echo $tab === 'orders' ? 'bg-gray-600 text-white' : 'hover:bg-gray-600 text-gray-300'; ?>">
                <i class="fas fa-shopping-bag mr-3 w-5"></i>
                <span>Orders</span>
                <span class="ml-auto bg-purple-500 text-white text-xs px-2 py-1 rounded-full"><?php echo count($orders); ?></span>
            </a>
            <a href="?tab=customers" class="flex items-center py-3 px-4 rounded-lg transition-colors <?php echo $tab === 'customers' ? 'bg-gray-600 text-white' : 'hover:bg-gray-600 text-gray-300'; ?>">
                <i class="fas fa-user-friends mr-3 w-5"></i>
                <span>Customers</span>
                <span class="ml-auto bg-indigo-500 text-white text-xs px-2 py-1 rounded-full"><?php echo count($customers); ?></span>
            </a>
            <a href="?tab=analytics" class="flex items-center py-3 px-4 rounded-lg transition-colors <?php echo $tab === 'analytics' ? 'bg-gray-600 text-white' : 'hover:bg-gray-600 text-gray-300'; ?>">
                <i class="fas fa-chart-bar mr-3 w-5"></i>
                <span>Analytics</span>
            </a>
          
        </nav>
        
    
    </div>