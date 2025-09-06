<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Add Farmer Card -->
    <div onclick="document.getElementById('add-farmer-modal').classList.remove('hidden')"
         class="bg-white rounded-xl border-2 border-dashed border-green-400 p-6 flex flex-col items-center justify-center text-center cursor-pointer hover:bg-green-50 hover:border-green-600 transition">
        <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-3xl mb-3">
            <i class="fas fa-plus"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-700">Add Farmer</h3>
        <p class="text-gray-500 text-sm mt-1">Click to create a new farmer profile</p>
    </div>

    <!-- Existing Farmers -->
    <?php foreach ($farmers as $farmer): ?>
    <div class="bg-white rounded-xl card-shadow p-6 hover-scale">
        <div class="flex items-center mb-4">
            <?php if (!empty($farmer['farmer_pic'])): ?>
                <!-- Show farmer profile photo -->
                <img src="uploads/profiles/<?php echo htmlspecialchars($farmer['farmer_pic']); ?>" 
                     alt="Farmer Photo" 
                     class="w-16 h-16 rounded-full object-cover mr-4 border-2 border-green-500">
            <?php else: ?>
                <!-- Fallback to initials -->
                <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                    <?php echo strtoupper(substr($farmer['name'], 0, 1)); ?>
                </div>
            <?php endif; ?>

            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-800">
                    <?php echo htmlspecialchars($farmer['name']); ?>
                </h3>
                <p class="text-green-600 font-medium">
                    <?php echo htmlspecialchars($farmer['farm_name']); ?>
                </p>
            </div>
        </div>
        
        <div class="space-y-2 text-sm text-gray-600 mb-4">
            <div class="flex items-center">
                <i class="fas fa-envelope text-green-600 mr-2 w-4"></i>
                <?php echo htmlspecialchars($farmer['email']); ?>
            </div>
            <div class="flex items-center">
                <i class="fas fa-phone text-green-600 mr-2 w-4"></i>
                <?php echo htmlspecialchars($farmer['phone'] ?? 'N/A'); ?>
            </div>
            <div class="flex items-center">
                <i class="fas fa-map-marker-alt text-green-600 mr-2 w-4"></i>
                <?php echo htmlspecialchars($farmer['location']); ?>
            </div>
            <div class="flex items-center">
                <i class="fas fa-apple-alt text-green-600 mr-2 w-4"></i>
                <?php echo $farmer['product_count']; ?> products
            </div>
        </div>
        
        <p class="text-gray-700 text-sm mb-4">
            <?php echo htmlspecialchars(substr($farmer['bio'], 0, 100)); ?>...
        </p>
        
        <div class="flex space-x-2">
            <button onclick="editFarmer(<?php echo htmlspecialchars(json_encode($farmer)); ?>)" 
                    class="flex-1 bg-blue-600 text-white py-2 px-3 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                <i class="fas fa-edit mr-1"></i>Edit
            </button>
            <form method="POST" class="flex-1" 
                  onsubmit="return confirm('Are you sure? This will delete all farmer products too.')">
                <input type="hidden" name="action" value="delete_farmer">
                <input type="hidden" name="id" value="<?php echo $farmer['id']; ?>">
                <button type="submit" 
                        class="w-full bg-red-600 text-white py-2 px-3 rounded-lg hover:bg-red-700 transition-colors text-sm">
                    <i class="fas fa-trash mr-1"></i>Delete
                </button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</div>