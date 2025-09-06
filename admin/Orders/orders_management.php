<div class="fade-in">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Orders Management</h2>
            <p class="text-gray-600">Track and manage customer orders</p>
        </div>
        <div class="flex space-x-2">
            <select class="border border-gray-300 rounded-lg px-4 py-2 text-sm">
                <option>All Orders</option>
                <option>Pending</option>
                <option>Processing</option>
                <option>Completed</option>
                <option>Cancelled</option>
            </select>
            <button onclick="alert('Export orders functionality')" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-download mr-2"></i>Export
            </button>
        </div>
    </div>

    <?php if (isset($_GET['updated'])): ?>
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg mb-6">
        <i class="fas fa-info-circle mr-2"></i>Order status updated successfully!
    </div>
    <?php endif; ?>

    <!-- Orders Table -->
    <div class="bg-white rounded-xl card-shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($orders as $order): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-shopping-bag text-blue-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">#<?php echo $order['id']; ?></div>
                                    <div class="text-sm text-gray-500"><?php echo date('g:i A', strtotime($order['created_at'])); ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?php echo htmlspecialchars($order['customer_name'] ?? 'Guest Customer'); ?></div>
                            <div class="text-sm text-gray-500"><?php echo htmlspecialchars($order['email'] ?? 'N/A'); ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php echo date('M j, Y', strtotime($order['created_at'])); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                            ₹ <?php echo number_format($order['total_amount'], 2); ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form method="POST" class="inline">
                                <input type="hidden" name="action" value="update_order_status">
                                <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                                <select name="status" onchange="this.form.submit()" class="px-3 py-1 text-xs font-medium rounded-full border-0 cursor-pointer <?php echo getStatusColor($order['status']); ?>">
                                    <option value="Pending" <?php echo $order['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Processing" <?php echo $order['status'] === 'Processing' ? 'selected' : ''; ?>>Processing</option>
                                    <option value="Completed" <?php echo $order['status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                    <option value="Cancelled" <?php echo $order['status'] === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <button onclick="viewOrderDetails(<?php echo $order['id']; ?>)" class="text-green-600 hover:text-green-900">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button onclick="alert('Print invoice for Order #<?php echo $order['id']; ?>')" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-print"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (empty($orders)): ?>
    <div class="text-center py-12">
        <i class="fas fa-shopping-bag text-6xl text-gray-400 mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">No orders found</h3>
        <p class="text-gray-500">Orders will appear here once customers start placing them.</p>
    </div>
    <?php endif; ?>
</div>
