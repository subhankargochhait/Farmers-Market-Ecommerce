
// Modal management
function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-backdrop')) {
        e.target.classList.add('hidden');
    }
});

// Open Edit Farmer Modal and fill fields
function editFarmer(farmer) {
    document.getElementById('edit-farmer-id').value = farmer.id;
    document.getElementById('edit-farmer-name').value = farmer.name;
    document.getElementById('edit-farmer-email').value = farmer.email;
    document.getElementById('edit-farmer-phone').value = farmer.phone || '';
    document.getElementById('edit-farmer-farm-name').value = farmer.farm_name;
    document.getElementById('edit-farmer-location').value = farmer.location;
    document.getElementById('edit-farmer-bio').value = farmer.bio || '';

    // Handle profile picture preview
    const imgPreview = document.getElementById('edit-farmer-pic-preview');
    imgPreview.src = farmer.farmer_pic 
        ? 'uploads/profiles/' + farmer.farmer_pic 
        : 'https://via.placeholder.com/100x100?text=No+Image';

    document.getElementById('edit-farmer-modal').classList.remove('hidden');
}



// Edit product function
function editProduct(product) {
    document.getElementById('edit-product-id').value = product.id;
    document.getElementById('edit-product-name').value = product.name;
    document.getElementById('edit-product-category').value = product.category;
    document.getElementById('edit-product-farmer').value = product.farmer_id;
    document.getElementById('edit-product-price').value = product.price;
    document.getElementById('edit-product-stock').value = product.stock;
    document.getElementById('edit-product-season').value = product.season;
    document.getElementById('edit-product-description').value = product.description || '';
    document.getElementById('edit-product-image').src = 'uploads/products/' + product.image_url;
    document.getElementById('edit-product-modal').classList.remove('hidden');
}

// View order details
function viewOrderDetails(orderId) {
    alert('Order Details for Order #' + orderId + '\n\nThis would show:\n- Order items\n- Customer details\n- Delivery information\n- Payment status\n- Order timeline');
}

// View customer details
function viewCustomerDetails(customer) {
    alert('Customer Details:\n\nName: ' + customer.name + '\nEmail: ' + customer.email + '\nPhone: ' + (customer.phone || 'N/A') + '\nTotal Orders: ' + customer.total_orders + '\nTotal Spent: $' + parseFloat(customer.total_spent).toFixed(2) + '\nJoined: ' + new Date(customer.created_at).toLocaleDateString());
}

// Auto-hide success messages
setTimeout(function() {
    const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100, .bg-blue-100');
    alerts.forEach(alert => {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    });
}, 4000);

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // ESC to close modals
    if (e.key === 'Escape') {
        const modals = document.querySelectorAll('.fixed.inset-0');
        modals.forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
            }
        });
    }
});

// Real-time search functionality (placeholder)
function setupSearch() {
    const searchInputs = document.querySelectorAll('input[type="search"]');
    searchInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Search functionality would be implemented here
            console.log('Searching for:', this.value);
        });
    });
}

// Initialize features
document.addEventListener('DOMContentLoaded', function() {
    setupSearch();
});




