<div id="edit-product-modal" 
     class="fixed inset-0 hidden z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto animate-fadeIn">

        <!-- Header -->
        <div class="flex justify-between items-center border-b border-gray-200 pb-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                <i class="fas fa-pen-to-square text-blue-600"></i> Edit Product
            </h2>
            <button type="button" 
                    onclick="document.getElementById('edit-product-modal').classList.add('hidden')" 
                    class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Form -->
        <form method="POST" enctype="multipart/form-data" class="space-y-5">
            <input type="hidden" name="action" value="edit_product">
            <input type="hidden" name="id" id="edit-product-id">

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Product Name -->
                <div class="sm:col-span-2">
                    <label for="edit-product-name" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                    <input type="text" name="name" id="edit-product-name" required 
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                </div>

                <!-- Category -->
                <div>
                    <label for="edit-product-category" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                    <select name="category" id="edit-product-category" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                        <option value="">Select Category</option>
                        <option value="vegetables">Vegetables</option>
                        <option value="fruits">Fruits</option>
                        <option value="herbs">Herbs</option>
                        <option value="grains">Grains</option>
                    </select>
                </div>

                <!-- Farmer -->
                <div>
                    <label for="edit-product-farmer" class="block text-sm font-medium text-gray-700 mb-1">Farmer *</label>
                    <select name="farmer_id" id="edit-product-farmer" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                        <option value="">Select Farmer</option>
                        <?php foreach ($farmers as $farmer): ?>
                            <option value="<?php echo $farmer['id']; ?>">
                                <?php echo htmlspecialchars($farmer['name'] . ' - ' . $farmer['farm_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Price -->
                <div>
                    <label for="edit-product-price" class="block text-sm font-medium text-gray-700 mb-1">Price (₹) *</label>
                    <input type="number" name="price" id="edit-product-price" step="0.01" min="0" required
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                </div>

                <!-- Stock -->
                <div>
                    <label for="edit-product-stock" class="block text-sm font-medium text-gray-700 mb-1">Stock *</label>
                    <input type="number" name="stock" id="edit-product-stock" min="0" required
                           class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                </div>

                <!-- Season -->
                <div>
                    <label for="edit-product-season" class="block text-sm font-medium text-gray-700 mb-1">Season *</label>
                    <select name="season" id="edit-product-season" required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                        <option value="">Select Season</option>
                        <option value="spring">Spring</option>
                        <option value="summer">Summer</option>
                        <option value="fall">Fall</option>
                        <option value="winter">Winter</option>
                    </select>
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="edit-product-description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="edit-product-description" rows="3"
                          class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm"></textarea>
            </div>

            <!-- Product Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                <div class="flex items-center gap-5">
                    <img src="" id="edit-product-image" alt="Product Preview" 
                         class="w-24 h-24 object-cover rounded-xl border border-gray-200 shadow-sm">
                    <input type="file" name="image" accept="image/*"
                           class="text-sm text-gray-600 file:mr-3 file:py-2 file:px-4 
                                  file:rounded-lg file:border-0 file:text-sm 
                                  file:font-semibold file:bg-blue-50 file:text-blue-700 
                                  hover:file:bg-blue-100 transition">
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <button type="submit" 
                        class="flex-1 bg-blue-600 text-white py-3 rounded-xl shadow-md hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 text-lg font-medium">
                    <i class="fas fa-save"></i> Update
                </button>
                <button type="button" 
                        onclick="document.getElementById('edit-product-modal').classList.add('hidden')" 
                        class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-xl shadow-md hover:bg-gray-300 transition-colors flex items-center justify-center gap-2 text-lg font-medium">
                    <i class="fas fa-times-circle"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>