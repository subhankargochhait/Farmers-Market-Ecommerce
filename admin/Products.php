<section id="products" class="page-section">
    <!-- Add Product -->
    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h2 class="card-title flex items-center gap-2">
                <i class="fas fa-plus-circle text-green-600"></i>
                Add New Product
            </h2>
        </div>
        <div class="card-body">
            <form id="productForm" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-input" id="productName" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select class="form-input" id="productCategory" required>
                            <option value="">Select Category</option>
                            <option value="vegetables">🥕 Vegetables</option>
                            <option value="fruits">🍎 Fruits</option>
                            <option value="herbs">🌿 Herbs</option>
                            <option value="dairy">🥛 Dairy</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Price (₹)</label>
                        <input type="number" class="form-input" id="productPrice" step="0.01" min="0" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" class="form-input" id="productStock" min="0" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Season</label>
                        <select class="form-input" id="productSeason">
                            <option value="">Any Season</option>
                            <option value="spring">🌱 Spring</option>
                            <option value="summer">☀️ Summer</option>
                            <option value="fall">🍂 Fall</option>
                            <option value="winter">❄️ Winter</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Vendor</label>
                        <select class="form-input" id="productVendor" required>
                            <option value="">Select Vendor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Product Image</label>
                        <input type="file" class="form-input" id="productImage" accept="image/*">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-input" id="productDescription" rows="3" placeholder="Product description..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Add Product
                </button>
            </form>
        </div>
    </div>

    <!-- Product Management -->
    <div class="card mt-6">
        <div class="card-header flex justify-between items-center">
            <h2 class="card-title flex items-center gap-2">
                <i class="fas fa-seedling text-green-600"></i>
                Products Management
            </h2>
            <button class="btn btn-primary flex items-center gap-2" onclick="loadProducts()">
                <i class="fas fa-sync-alt"></i>
                Refresh
            </button>
        </div>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Season</th>
                        <th>Vendor</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productsTableBody">
                    <!-- Products will load dynamically -->
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal for View/Edit Product -->
<div id="productModal" class="modal hidden">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <div id="modalBody"></div>
    </div>
</div>

<script>
    // Example functions (replace with backend integration)
    function loadProducts() {
        document.getElementById("productsTableBody").innerHTML = `
            <tr>
                <td>1</td>
                <td><img src="uploads/tomato.jpg" class="h-12 w-12 rounded"></td>
                <td>Tomato</td>
                <td>Vegetables</td>
                <td>₹50</td>
                <td>100</td>
                <td>Summer</td>
                <td>Farmer A</td>
                <td>
                    <button class="btn btn-sm btn-info" onclick="viewProduct(1)"><i class="fas fa-eye"></i></button>
                    <button class="btn btn-sm btn-warning" onclick="editProduct(1)"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger" onclick="deleteProduct(1)"><i class="fas fa-trash"></i></button>
                </td>
            </tr>`;
    }

    function viewProduct(id) {
        document.getElementById("modalBody").innerHTML = `<h3>Viewing Product ID: ${id}</h3>`;
        document.getElementById("productModal").classList.remove("hidden");
    }

    function editProduct(id) {
        document.getElementById("modalBody").innerHTML = `<h3>Editing Product ID: ${id}</h3>`;
        document.getElementById("productModal").classList.remove("hidden");
    }

    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete this product?")) {
            alert("Product " + id + " deleted!");
        }
    }

    function closeModal() {
        document.getElementById("productModal").classList.add("hidden");
    }

    document.getElementById("productForm").addEventListener("submit", function (e) {
        e.preventDefault();
        alert("Product added successfully!");
        loadProducts();
    });

    // Load initial products
    loadProducts();
</script>
