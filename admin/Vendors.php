 <section id="vendors" class="page-section">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-plus-circle"></i>
                            Add New Vendor
                        </h2>
                    </div>
                    <div class="card-body">
                        <form id="vendorForm">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">Vendor Name</label>
                                    <input type="text" class="form-input" id="vendorName" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Owner Name</label>
                                    <input type="text" class="form-input" id="vendorOwner" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-input" id="vendorEmail" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-input" id="vendorPhone" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-input" id="vendorLocation" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-input" id="vendorStatus">
                                        <option value="active">Active</option>
                                        <option value="pending">Pending</option>
                                        <option value="suspended">Suspended</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea class="form-input" id="vendorDescription" rows="3" placeholder="Brief description about the vendor..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Add Vendor
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fas fa-store"></i>
                            Vendors Management
                        </h2>
                        <button class="btn btn-primary" onclick="loadVendors()">
                            <i class="fas fa-sync-alt"></i>
                            Refresh
                        </button>
                    </div>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vendor Name</th>
                                    <th>Owner</th>
                                    <th>Contact</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="vendorsTableBody">
                                <!-- Vendors will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>