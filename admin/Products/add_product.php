<div id="add-product-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center modal-backdrop">
    <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4 max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Add New Product</h2>
            <button onclick="document.getElementById('add-product-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form method="POST" class="space-y-4" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add_product">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                <input type="text" name="name" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                <select name="category" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Select Category</option>
                    <option value="vegetables">Vegetables</option>
                    <option value="fruits">Fruits</option>
                    <option value="herbs">Herbs</option>
                    <option value="grains">Grains</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Farmer *</label>
                <select name="farmer_id" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Select Farmer</option>
                    <?php foreach ($farmers as $farmer): ?>
                    <option value="<?php echo $farmer['id']; ?>"><?php echo htmlspecialchars($farmer['name'] . ' - ' . $farmer['farm_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price ₹ *</label>
                    <input type="number" name="price" step="0.01" min="0" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock *</label>
                    <input type="number" name="stock" min="0" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Season *</label>
                <select name="season" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Select Season</option>
                    <option value="spring">Spring</option>
                    <option value="summer">Summer</option>
                    <option value="fall">Fall</option>
                    <option value="winter">Winter</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
            </div>
            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <input type="file" name="image" accept="image/*" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-transparent">


            </div>
            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Add Product
                </button>
                <button type="button" onclick="document.getElementById('add-product-modal').classList.add('hidden')" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400 transition-colors">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>