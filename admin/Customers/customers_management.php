 <div class="fade-in">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Customers Management</h2>
                        <p class="text-gray-600">Manage customer profiles and order history</p>
                    </div>
                    <button onclick="document.getElementById('add-customer-modal').classList.remove('hidden')" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add Customer
                    </button>
                </div>
                
                <?php if (isset($_GET['added'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    <i class="fas fa-check-circle mr-2"></i>Customer added successfully!
                </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['deleted'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <i class="fas fa-trash mr-2"></i>Customer deleted successfully!
                </div>
                <?php endif; ?>
                
                <!-- Customers Table -->
               <?php include 'Customers/customers_table.php'; ?>

                <?php if (empty($customers)): ?>
                <div class="text-center py-12">
                    <i class="fas fa-user-friends text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No customers found</h3>
                    <p class="text-gray-500 mb-6">Customer profiles will appear here as they register and place orders.</p>
                    <button onclick="document.getElementById('add-customer-modal').classList.remove('hidden')" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add Customer
                    </button>
                </div>
                <?php endif; ?>
            </div>