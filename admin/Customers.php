 <section id="customers" class="page-section">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-users"></i>
                            Customer Management
                        </h2>
                        <button class="btn btn-primary" onclick="loadCustomers()">
                            <i class="fas fa-sync-alt"></i>
                            Refresh
                        </button>
                    </div>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Registered</th>
                                    <th>Orders</th>
                                    <th>Total Spent</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="customersTableBody">
                                <!-- Customers will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>