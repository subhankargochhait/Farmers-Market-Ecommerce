<?php
session_start();
include("../config/db.php");
require '../vendor/autoload.php';

use Razorpay\Api\Api;

// ✅ Check login
if (!isset($_SESSION['user_id'])) {
    die("❌ Not logged in.");
}

$user_id   = $_SESSION['user_id'];
$cart      = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    die("❌ Cart is empty.");
}

// ✅ Collect customer details
$name     = $_POST['name'] ?? '';
$email    = $_POST['email'] ?? '';
$phone    = $_POST['phone'] ?? '';
$address  = $_POST['address'] ?? '';
$payment_method = $_POST['payment_method'] ?? 'COD';

// ✅ Calculate total
$total_amount = 0;
foreach ($cart as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

// ✅ Razorpay keys
$RAZORPAY_KEY_ID = "rzp_test_R6gWimTKYuOdob";
$RAZORPAY_KEY_SECRET = "Y8JxgzTXxVlqs9dLvfdvGvNd";

// ✅ Start transaction
$con->begin_transaction();

try {
    // 1️⃣ Insert into orders
    $stmt = $con->prepare("INSERT INTO orders 
        (customer_id, customer_name, email, phone, address, payment_method, total_amount, status, created_at) 
        VALUES (?,?,?,?,?,?,?, 'Pending', NOW())");
    $stmt->bind_param("isssssd", $user_id, $name, $email, $phone, $address, $payment_method, $total_amount);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // 2️⃣ Razorpay Payment Handling
    if ($payment_method === "Razorpay") {
        $razorpay_payment_id = $_POST['razorpay_payment_id'] ?? '';
        $razorpay_order_id   = $_POST['razorpay_order_id'] ?? '';
        $razorpay_signature  = $_POST['razorpay_signature'] ?? '';

        if (!$razorpay_payment_id || !$razorpay_order_id || !$razorpay_signature) {
            throw new Exception("❌ Razorpay details missing.");
        }

        // ✅ Verify Signature
        $api = new Api($RAZORPAY_KEY_ID, $RAZORPAY_KEY_SECRET);
        $attributes = [
            'razorpay_order_id'   => $razorpay_order_id,
            'razorpay_payment_id' => $razorpay_payment_id,
            'razorpay_signature'  => $razorpay_signature
        ];
        $api->utility->verifyPaymentSignature($attributes);

        // ✅ Insert Payment
        $status = "Success"; // Razorpay success means payment is captured
        $paymentStmt = $con->prepare("INSERT INTO payments 
            (order_id, payment_id, razorpay_order_id, razorpay_signature, method, amount, status, created_at) 
            VALUES (?,?,?,?,?,?,?,NOW())");
        $paymentStmt->bind_param("issssds", 
            $order_id, 
            $razorpay_payment_id, 
            $razorpay_order_id, 
            $razorpay_signature, 
            $payment_method, 
            $total_amount, 
            $status
        );
        $paymentStmt->execute();
        $paymentStmt->close();

        // ✅ Update order status = Completed
        $updateOrder = $con->prepare("UPDATE orders SET status='Completed' WHERE id=?");
        $updateOrder->bind_param("i", $order_id);
        $updateOrder->execute();
        $updateOrder->close();
    }

    // 3️⃣ Insert order items + reduce stock
    $itemStmt = $con->prepare("INSERT INTO order_items (order_id, product_id, vendor_id, quantity, price_each) 
                               VALUES (?,?,?,?,?)");
    $stockStmt = $con->prepare("UPDATE products SET stock=stock-? WHERE id=? AND stock>=?");
    foreach ($cart as $pid => $item) {
        $itemStmt->bind_param("iiiid", $order_id, $pid, $item['vendor_id'], $item['quantity'], $item['price']);
        $itemStmt->execute();

        $stockStmt->bind_param("iii", $item['quantity'], $pid, $item['quantity']);
        $stockStmt->execute();
    }
    $itemStmt->close();
    $stockStmt->close();

    // ✅ Commit
    $con->commit();
    unset($_SESSION['cart']);

    header("Location: order_success.php?order_id=" . $order_id);
    exit;

} catch (Exception $e) {
    $con->rollback();
    die("❌ Order failed: " . $e->getMessage());
}
?>
