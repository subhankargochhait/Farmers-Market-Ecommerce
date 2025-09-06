<div id="add-farmer-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center modal-backdrop">
    <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4 max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Add New Farmer</h2>
            <button onclick="document.getElementById('add-farmer-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="action" value="add_farmer">

            <div>
                <label class="block text-sm font-medium">Full Name *</label>
                <input type="text" name="name" required class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Email *</label>
                <input type="email" name="email" required class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Phone</label>
                <input type="tel" name="phone" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Farm Name *</label>
                <input type="text" name="farm_name" required class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Location *</label>
                <input type="text" name="location" required class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Bio</label>
                <textarea name="bio" rows="3" class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Farmer Picture</label>
                <input type="file" name="farmer_pic" accept="image/*" class="w-full border rounded-lg px-3 py-2">
            </div>

            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 bg-green-600 text-white py-2 rounded-lg">Add Farmer</button>
                <button type="button" onclick="document.getElementById('add-farmer-modal').classList.add('hidden')" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg">Cancel</button>
            </div>
        </form>
    </div>
</div>