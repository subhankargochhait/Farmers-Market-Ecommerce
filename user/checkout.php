<?php
session_start();
include("../config/db.php");
require '../vendor/autoload.php';
use Razorpay\Api\Api;

// ✅ Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id    = $_SESSION['user_id'];
$user_name  = $_SESSION['username'] ?? $_SESSION['name'] ?? 'User';
$user_email = $_SESSION['email'] ?? '';
$user_phone = $_SESSION['phone'] ?? '';
$cart       = $_SESSION['cart'] ?? [];

// ✅ Calculate total
$total_amount = 0;
foreach ($cart as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

// ✅ Razorpay Keys
$RAZORPAY_KEY_ID     = "rzp_test_R6gWimTKYuOdob";
$RAZORPAY_KEY_SECRET = "Y8JxgzTXxVlqs9dLvfdvGvNd";

// ✅ Create Razorpay Order from backend
$api = new Api($RAZORPAY_KEY_ID, $RAZORPAY_KEY_SECRET);

// FIX: convert to integer (paise)
$orderData = [
    'receipt'         => 'order_rcptid_' . time(),
    'amount'          => (int) round($total_amount * 100), // ✅ MUST be int in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

// Save in session for verification later
$_SESSION['razorpay_order_id'] = $razorpayOrder['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Farmers Market</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body class="bg-gray-50 font-sans">

<?php include '../includes/header.php'; ?>

<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-green-700 mb-6">🛒 Checkout</h1>

    <div class="grid md:grid-cols-2 gap-8">
        <!-- Checkout Form -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Customer Information</h2>
            <form id="checkoutForm" method="post" action="place_order.php">
                <input type="hidden" name="payment_method" id="payment_method" value="COD">
                <input type="hidden" name="razorpay_order_id" value="<?= $razorpayOrder['id']; ?>">

                <div class="mb-4">
                    <label class="block text-gray-700">Full Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user_name) ?>" required class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user_email) ?>" required class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Phone</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($user_phone) ?>" required class="w-full p-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Address</label>
                    <textarea name="address" rows="3" required class="w-full p-2 border rounded"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Payment Method</label>
                    <select id="paymentSelect" class="w-full p-2 border rounded">
                        <option value="COD">Cash on Delivery</option>
                        <option value="Razorpay">Pay Online (Razorpay)</option>
                    </select>
                </div>

                <button type="submit" 
                        class="w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition">
                    <i class="fas fa-check-circle mr-2"></i> Place Order
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
            <?php if (!empty($cart)): ?>
                <ul class="divide-y divide-gray-200 mb-4">
                    <?php foreach ($cart as $item): 
                        $subtotal = $item['price'] * $item['quantity'];
                    ?>
                        <li class="flex justify-between py-3">
                            <div>
                                <p class="font-medium"><?= htmlspecialchars($item['name']); ?></p>
                                <p class="text-sm text-gray-500">Qty: <?= $item['quantity']; ?> × ₹<?= number_format($item['price'], 2); ?></p>
                            </div>
                            <p class="font-semibold">₹<?= number_format($subtotal, 2); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="flex justify-between text-lg font-bold">
                    <span>Total:</span>
                    <span class="text-green-600">₹<?= number_format($total_amount, 2); ?></span>
                </div>
            <?php else: ?>
                <p class="text-gray-500">Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.getElementById("checkoutForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const method = document.getElementById("paymentSelect").value;
    document.getElementById("payment_method").value = method;

    if (method === "Razorpay") {
        var options = {
            "key": "<?= $RAZORPAY_KEY_ID ?>", 
            "amount": <?= (int) round($total_amount * 100) ?>, // ✅ ensure integer
            "currency": "INR",
            "name": "Farmers Market",
            "description": "Order Payment",
            "order_id": "<?= $razorpayOrder['id']; ?>", // ✅ server-generated order_id
            "handler": function (response){
                var form = document.getElementById("checkoutForm");
                form.insertAdjacentHTML("beforeend", `
                    <input type="hidden" name="razorpay_payment_id" value="${response.razorpay_payment_id}">
                    <input type="hidden" name="razorpay_signature" value="${response.razorpay_signature}">
                `);
                form.submit();
            },
            "prefill": {
                "name": "<?= htmlspecialchars($user_name) ?>",
                "email": "<?= htmlspecialchars($user_email) ?>",
                "contact": "<?= htmlspecialchars($user_phone) ?>"
            },
            "theme": { "color": "#16a34a" }
        };
        var rzp = new Razorpay(options);
        rzp.open();
    } else {
        this.submit();
    }
});
</script>

<?php include '../includes/footer.php'; ?>
</body>
</html>
