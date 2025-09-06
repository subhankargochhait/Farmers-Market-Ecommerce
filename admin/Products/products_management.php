 <div class="fade-in">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Products Management</h2>
                        <p class="text-gray-600">Manage product inventory and details</p>
                    </div>
                    <button onclick="document.getElementById('add-product-modal').classList.remove('hidden')" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add Product
                    </button>
                </div>
                
                <!-- Success/Error Messages -->
                <?php if (isset($_GET['added'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    <i class="fas fa-check-circle mr-2"></i>Product added successfully!
                </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['updated'])): ?>
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg mb-6">
                    <i class="fas fa-info-circle mr-2"></i>Product updated successfully!
                </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['deleted'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                    <i class="fas fa-trash mr-2"></i>Product deleted successfully!
                </div>
                <?php endif; ?>
                
                <!-- Products Table -->
                <div class="bg-white rounded-xl card-shadow overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Farmer</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Season</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($products as $product): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center mr-4">
                                                <!-- <i class="fas fa-<?php echo getProductIcon($product['category']); ?> text-white text-lg"></i> -->
                                                 <img src="uploads/products/<?= $product['image_url'] ?>" class="w-12 h-12 object-cover rounded-lg">
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($product['name']); ?></div>
                                                <div class="text-sm text-gray-500"><?php echo htmlspecialchars(substr($product['description'], 0, 40)); ?>...</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900"><?php echo htmlspecialchars($product['farmer_name'] ?? 'Unknown'); ?></div>
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars($product['farm_name'] ?? ''); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full <?php echo getCategoryColor($product['category']); ?>">
                                            <?php echo ucfirst($product['category']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        ₹ <?php echo number_format($product['price'], 2); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-900 <?php echo $product['stock'] < 10 ? 'text-red-600 font-semibold' : ''; ?>">
                                            <?php echo $product['stock']; ?>
                                            <?php if ($product['stock'] < 10): ?>
                                            <i class="fas fa-exclamation-triangle text-red-500 ml-1"></i>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                            <?php echo ucfirst($product['season']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button onclick="editProduct(<?php echo htmlspecialchars(json_encode($product)); ?>)" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                            <input type="hidden" name="action" value="delete_product">
                                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <?php if (empty($products)): ?>
                <div class="text-center py-12">
                    <i class="fas fa-apple-alt text-6xl text-gray-400 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">No products found</h3>
                    <p class="text-gray-500 mb-6">Start by adding your first product to the inventory.</p>
                    <button onclick="document.getElementById('add-product-modal').classList.remove('hidden')" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add First Product
                    </button>
                </div>
                <?php endif; ?>
            </div>