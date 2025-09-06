<div id="edit-farmer-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center modal-backdrop">
    <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4 max-h-screen overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Farmer</h2>
            <button onclick="document.getElementById('edit-farmer-modal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="action" value="edit_farmer">
            <input type="hidden" name="id" id="edit-farmer-id">

            <div>
                <label class="block text-sm font-medium">Full Name *</label>
                <input type="text" name="name" id="edit-farmer-name" required class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Email *</label>
                <input type="email" name="email" id="edit-farmer-email" required class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Phone</label>
                <input type="tel" name="phone" id="edit-farmer-phone" class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Farm Name *</label>
                <input type="text" name="farm_name" id="edit-farmer-farm-name" required class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Location *</label>
                <input type="text" name="location" id="edit-farmer-location" required class="w-full border rounded-lg px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Bio</label>
                <textarea name="bio" id="edit-farmer-bio" rows="3" class="w-full border rounded-lg px-3 py-2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium">Farmer Picture</label>
                <input type="file" name="farmer_pic" accept="image/*" class="w-full border rounded-lg px-3 py-2">
                <img id="edit-farmer-pic-preview" src="" alt="Farmer Image" class="mt-2 w-20 h-20 object-cover rounded">
            </div>

            <div class="flex space-x-4 pt-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white py-2 rounded-lg">Update Farmer</button>
                <button type="button" onclick="document.getElementById('edit-farmer-modal').classList.add('hidden')" class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg">Cancel</button>
            </div>
        </form>
    </div>
</div>