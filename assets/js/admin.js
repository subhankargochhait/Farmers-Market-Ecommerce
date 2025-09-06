
        // Sample data based on your database
        let vendors = [
            {id: 1, name: 'Green Valley Farms', owner: 'Ramesh Kumar', email: 'greenvalley@example.com', phone: '9876543210', location: 'Kolkata, West Bengal', status: 'active', description: 'Organic vegetables and fruits supplier.'},
            {id: 2, name: 'Fresh Dairy Co.', owner: 'Priya Sharma', email: 'freshdairy@example.com', phone: '9123456780', location: 'Siliguri, West Bengal', status: 'active', description: 'Local dairy products from village farms.'},
            {id: 3, name: 'Herbal Life Farm', owner: 'Ankit Das', email: 'herballife@example.com', phone: '9801234567', location: 'Durgapur, West Bengal', status: 'active', description: 'Fresh herbs and spices.'},
            {id: 4, name: 'Sunny Orchard', owner: 'Sunita Sen', email: 'sunnyorchard@example.com', phone: '9834567890', location: 'Howrah, West Bengal', status: 'active', description: 'Seasonal fruits grown organically.'}
        ];

        let products = [
            {id: 1, name: 'Tomatoes', category: 'vegetables', price: 40.00, stock: 100, season: 'summer', vendor_id: 1, description: 'Fresh organic tomatoes.'},
            {id: 2, name: 'Potatoes', category: 'vegetables', price: 30.00, stock: 200, season: 'winter', vendor_id: 1, description: 'Locally grown potatoes.'},
            {id: 3, name: 'Spinach', category: 'vegetables', price: 25.00, stock: 150, season: 'spring', vendor_id: 1, description: 'Green leafy spinach rich in iron.'},
            {id: 4, name: 'Milk (1L)', category: 'dairy', price: 50.00, stock: 80, season: '', vendor_id: 2, description: 'Pure cow milk, farm fresh.'},
            {id: 5, name: 'Curd (500g)', category: 'dairy', price: 60.00, stock: 50, season: '', vendor_id: 2, description: 'Homemade curd, thick and creamy.'},
            {id: 6, name: 'Coriander Leaves', category: 'herbs', price: 15.00, stock: 200, season: '', vendor_id: 3, description: 'Fresh coriander leaves for cooking.'},
            {id: 7, name: 'Mint Leaves', category: 'herbs', price: 20.00, stock: 180, season: '', vendor_id: 3, description: 'Cooling mint leaves for chutneys and drinks.'},
            {id: 8, name: 'Mangoes (1kg)', category: 'fruits', price: 120.00, stock: 90, season: 'summer', vendor_id: 4, description: 'Juicy Alphonso mangoes.'},
            {id: 9, name: 'Apples (1kg)', category: 'fruits', price: 180.00, stock: 100, season: 'winter', vendor_id: 4, description: 'Fresh apples from orchards.'},
            {id: 10, name: 'Bananas (1 dozen)', category: 'fruits', price: 60.00, stock: 120, season: '', vendor_id: 4, description: 'Sweet ripe bananas.'}
        ];

        let orders = [
            {id: 1, customer_name: 'Subhankar Guchhait', customer_email: 'subhankar@example.com', customer_phone: '9001234567', items: 'Tomatoes x2, Milk x1', total_amount: 130.00, status: 'confirmed', order_date: '2025-08-31'},
            {id: 2, customer_name: 'Priya Das', customer_email: 'priyadas@example.com', customer_phone: '9809876543', items: 'Mangoes x1, Curd x1', total_amount: 180.00, status: 'pending', order_date: '2025-08-31'}
        ];

        let customers = [
            {id: 1, username: 'Subhankar Guchhait', email: 'subhankargochhait0@gmail.com', created_at: '2025-08-31', orders: 1, total_spent: 130.00},
            {id: 2, username: 'Suman Ghosh', email: 's@gmail.com', created_at: '2025-09-01', orders: 0, total_spent: 0.00}
        ];

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function showPage(pageName) {
            // Update page title
            const titles = {
                dashboard: 'Dashboard Overview',
                vendors: 'Vendor Management', 
                products: 'Product Management',
                orders: 'Order Management',
                customers: 'Customer Management',
                analytics: 'Analytics & Reports'
            };
            
            document.getElementById('pageTitle').textContent = titles[pageName] || 'Dashboard';
            
            // Hide all sections
            document.querySelectorAll('.page-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Remove active class from all nav items
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            
            // Show selected section
            document.getElementById(pageName).classList.add('active');
            event.target.classList.add('active');
            
            // Load data for the active section
            if (pageName === 'vendors') {
                loadVendors();
                populateVendorDropdown();
            } else if (pageName === 'products') {
                loadProducts();
                populateVendorDropdown();
            } else if (pageName === 'orders') {
                loadOrders();
            } else if (pageName === 'customers') {
                loadCustomers();
            }
            
            // Close sidebar on mobile after selection
            if (window.innerWidth <= 1024) {
                toggleSidebar();
            }
        }

        function showAlert(message, type = 'success') {
            const existingAlert = document.querySelector('.alert');
            if (existingAlert) {
                existingAlert.remove();
            }

            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            `;
            
            const activeSection = document.querySelector('.page-section.active');
            activeSection.insertBefore(alert, activeSection.firstChild);
            
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }

        function loadVendors() {
            const tbody = document.getElementById('vendorsTableBody');
            tbody.innerHTML = '';
            
            vendors.forEach(vendor => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><span style="font-weight: 600;">#${vendor.id}</span></td>
                    <td>
                        <div>
                            <div style="font-weight: 600;">${vendor.name}</div>
                            <div style="font-size: 0.75rem; color: var(--gray-500);">${vendor.description}</div>
                        </div>
                    </td>
                    <td>${vendor.owner}</td>
                    <td>
                        <div>${vendor.email}</div>
                        <div style="font-size: 0.75rem; color: var(--gray-500);">${vendor.phone}</div>
                    </td>
                    <td>
                        <i class="fas fa-map-marker-alt" style="color: var(--gray-400); margin-right: 0.5rem;"></i>
                        ${vendor.location}
                    </td>
                    <td><span class="status-badge status-${vendor.status}">${vendor.status.toUpperCase()}</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-sm btn-success" onclick="updateVendorStatus(${vendor.id}, 'active')" title="Activate">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="updateVendorStatus(${vendor.id}, 'suspended')" title="Suspend">
                                <i class="fas fa-ban"></i>
                            </button>
                            <button class="btn btn-sm btn-info" onclick="editVendor(${vendor.id})" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function loadProducts() {
            const tbody = document.getElementById('productsTableBody');
            tbody.innerHTML = '';
            
            products.forEach(product => {
                const vendor = vendors.find(v => v.id === product.vendor_id);
                const categoryIcons = {
                    vegetables: '🥕',
                    fruits: '🍎', 
                    herbs: '🌿',
                    dairy: '🥛'
                };
                
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><span style="font-weight: 600;">#${product.id}</span></td>
                    <td>
                        <div>
                            <div style="font-weight: 600;">${product.name}</div>
                            <div style="font-size: 0.75rem; color: var(--gray-500);">${product.description}</div>
                        </div>
                    </td>
                    <td>
                        <span class="status-badge status-active">
                            ${categoryIcons[product.category]} ${product.category.toUpperCase()}
                        </span>
                    </td>
                    <td style="font-weight: 600; color: var(--primary);">₹${product.price}</td>
                    <td>
                        <span style="font-weight: 600; ${product.stock < 50 ? 'color: var(--danger)' : 'color: var(--success)'}">${product.stock}</span>
                        <div style="font-size: 0.75rem; color: var(--gray-500);">${product.stock < 50 ? 'Low Stock' : 'In Stock'}</div>
                    </td>
                    <td>${product.season ? `${getSeasonIcon(product.season)} ${product.season}` : 'All Seasons'}</td>
                    <td>${vendor ? vendor.name : 'N/A'}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-sm btn-primary" onclick="editProduct(${product.id})" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="updateStock(${product.id})" title="Update Stock">
                                <i class="fas fa-boxes"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteProduct(${product.id})" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function loadOrders() {
            const tbody = document.getElementById('ordersTableBody');
            tbody.innerHTML = '';
            
            orders.forEach(order => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><span style="font-weight: 600; color: var(--primary);">#${order.id}</span></td>
                    <td>
                        <div>
                            <div style="font-weight: 600;">${order.customer_name}</div>
                            <div style="font-size: 0.75rem; color: var(--gray-500);">Customer</div>
                        </div>
                    </td>
                    <td>
                        <div>${order.customer_email}</div>
                        <div style="font-size: 0.75rem; color: var(--gray-500);">${order.customer_phone}</div>
                    </td>
                    <td>
                        <div style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="${order.items}">
                            ${order.items}
                        </div>
                    </td>
                    <td style="font-weight: 600; color: var(--primary); font-size: 1.1em;">₹${order.total_amount}</td>
                    <td><span class="status-badge status-${order.status === 'confirmed' ? 'confirmed' : 'pending'}">${order.status.toUpperCase()}</span></td>
                    <td>
                        <i class="fas fa-calendar" style="color: var(--gray-400); margin-right: 0.5rem;"></i>
                        ${order.order_date}
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-sm btn-success" onclick="updateOrderStatus(${order.id}, 'confirmed')" title="Confirm">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn btn-sm btn-info" onclick="updateOrderStatus(${order.id}, 'shipped')" title="Ship">
                                <i class="fas fa-shipping-fast"></i>
                            </button>
                            <button class="btn btn-sm btn-warning" onclick="viewOrderDetails(${order.id})" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function loadCustomers() {
            const tbody = document.getElementById('customersTableBody');
            tbody.innerHTML = '';
            
            customers.forEach(customer => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><span style="font-weight: 600;">#${customer.id}</span></td>
                    <td>
                        <div>
                            <div style="font-weight: 600;">${customer.username}</div>
                            <div style="font-size: 0.75rem; color: var(--gray-500);">Customer</div>
                        </div>
                    </td>
                    <td>${customer.email}</td>
                    <td>
                        <i class="fas fa-calendar" style="color: var(--gray-400); margin-right: 0.5rem;"></i>
                        ${customer.created_at}
                    </td>
                    <td>
                        <span style="font-weight: 600; color: var(--primary);">${customer.orders}</span>
                        <div style="font-size: 0.75rem; color: var(--gray-500);">Orders</div>
                    </td>
                    <td style="font-weight: 600; color: var(--success); font-size: 1.1em;">₹${customer.total_spent}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-sm btn-info" onclick="viewCustomerDetails(${customer.id})" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-primary" onclick="contactCustomer(${customer.id})" title="Contact">
                                <i class="fas fa-envelope"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function getSeasonIcon(season) {
            const icons = {
                spring: '🌱',
                summer: '☀️',
                fall: '🍂', 
                winter: '❄️'
            };
            return icons[season] || '';
        }

        function populateVendorDropdown() {
            const select = document.getElementById('productVendor');
            select.innerHTML = '<option value="">Select Vendor</option>';
            
            vendors.filter(v => v.status === 'active').forEach(vendor => {
                const option = document.createElement('option');
                option.value = vendor.id;
                option.textContent = vendor.name;
                select.appendChild(option);
            });
        }

        function updateVendorStatus(vendorId, newStatus) {
            const vendor = vendors.find(v => v.id === vendorId);
            if (vendor) {
                vendor.status = newStatus;
                loadVendors();
                showAlert(`Vendor status updated to ${newStatus.toUpperCase()}`, 'success');
            }
        }

        function updateOrderStatus(orderId, newStatus) {
            const order = orders.find(o => o.id === orderId);
            if (order) {
                order.status = newStatus;
                loadOrders();
                showAlert(`Order #${orderId} status updated to ${newStatus.toUpperCase()}`, 'success');
            }
        }

        // Placeholder functions for additional features
        function editVendor(vendorId) {
            showAlert(`Edit vendor #${vendorId} feature coming soon!`, 'success');
        }

        function editProduct(productId) {
            showAlert(`Edit product #${productId} feature coming soon!`, 'success');
        }

        function deleteProduct(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                const index = products.findIndex(p => p.id === productId);
                if (index > -1) {
                    products.splice(index, 1);
                    loadProducts();
                    updateStats();
                    showAlert('Product deleted successfully!', 'success');
                }
            }
        }

        function updateStock(productId) {
            const newStock = prompt('Enter new stock quantity:');
            if (newStock !== null && !isNaN(newStock)) {
                const product = products.find(p => p.id === productId);
                if (product) {
                    product.stock = parseInt(newStock);
                    loadProducts();
                    showAlert('Stock updated successfully!', 'success');
                }
            }
        }

        function viewOrderDetails(orderId) {
            showAlert(`View order #${orderId} details feature coming soon!`, 'success');
        }

        function viewCustomerDetails(customerId) {
            showAlert(`View customer #${customerId} details feature coming soon!`, 'success');
        }

        function contactCustomer(customerId) {
            showAlert(`Contact customer #${customerId} feature coming soon!`, 'success');
        }

        function updateStats() {
            document.getElementById('totalVendors').textContent = vendors.length;
            document.getElementById('totalProducts').textContent = products.length;
            document.getElementById('totalOrders').textContent = orders.length;
            
            const totalRevenue = orders.reduce((sum, order) => sum + order.total_amount, 0);
            document.getElementById('totalRevenue').textContent = `₹${totalRevenue}`;
        }

        // Form submissions
        document.getElementById('vendorForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newVendor = {
                id: Math.max(...vendors.map(v => v.id)) + 1,
                name: document.getElementById('vendorName').value,
                owner: document.getElementById('vendorOwner').value,
                email: document.getElementById('vendorEmail').value,
                phone: document.getElementById('vendorPhone').value,
                location: document.getElementById('vendorLocation').value,
                status: document.getElementById('vendorStatus').value,
                description: document.getElementById('vendorDescription').value
            };
            
            vendors.push(newVendor);
            loadVendors();
            populateVendorDropdown();
            updateStats();
            this.reset();
            
            showAlert('✨ New vendor added successfully!', 'success');
        });

        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newProduct = {
                id: Math.max(...products.map(p => p.id)) + 1,
                name: document.getElementById('productName').value,
                category: document.getElementById('productCategory').value,
                price: parseFloat(document.getElementById('productPrice').value),
                stock: parseInt(document.getElementById('productStock').value),
                season: document.getElementById('productSeason').value,
                vendor_id: parseInt(document.getElementById('productVendor').value),
                description: document.getElementById('productDescription').value
            };
            
            products.push(newProduct);
            loadProducts();
            updateStats();
            this.reset();
            
            showAlert('✨ New product added successfully!', 'success');
        });

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            loadVendors();
            populateVendorDropdown();
            updateStats();
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1024) {
                document.getElementById('sidebar').classList.remove('open');
                document.querySelector('.sidebar-overlay').classList.remove('active');
            }
        });