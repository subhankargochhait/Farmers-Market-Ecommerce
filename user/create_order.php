<?php
session_start();
require '../vendor/autoload.php';
use Razorpay\Api\Api;
include("../config/db.php");

// Razorpay keys
$RAZORPAY_KEY_ID = "rzp_test_R6gWimTKYuOdob";
$RAZORPAY_KEY_SECRET = "Y8JxgzTXxVlqs9dLvfdvGvNd";

$api = new Api($RAZORPAY_KEY_ID, $RAZORPAY_KEY_SECRET);

$amount = $_POST['amount'] ?? 0;
$amount = intval($amount) * 100; // in paise

$orderData = [
    'receipt'         => 'rcptid_' . time(),
    'amount'          => $amount,
    'currency'        => 'INR',
    'payment_capture' => 1
];

$razorpayOrder = $api->order->create($orderData);

// Save order temp in session
$_SESSION['razorpay_order_id'] = $razorpayOrder['id'];

echo json_encode([
    "id" => $razorpayOrder['id'],
    "amount" => $amount,
    "currency" => "INR",
    "key" => $RAZORPAY_KEY_ID
]);
