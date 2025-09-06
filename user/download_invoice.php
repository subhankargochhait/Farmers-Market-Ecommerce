<?php
session_start();
include("../config/db.php");

// Include Composer autoload
require_once __DIR__ . '/../vendor/autoload.php'; // Make sure this path is correct

// No namespace needed, TCPDF is global
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Fresh Market');
$pdf->SetTitle('Invoice');

// Margins
$pdf->SetMargins(15, 25, 15);
$pdf->AddPage();

// Add Logo
$logo_file = __DIR__ . '/../assets/logo.png';
if(file_exists($logo_file)) {
    $pdf->Image($logo_file, 15, 10, 40);
}

// Header
$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetTextColor(40,167,69);
$pdf->Cell(0, 20, 'Fresh Market Invoice', 0, 1, 'R');
$pdf->Ln(5);

// Fetch order ID
if (!isset($_GET['order_id'])) {
    die("Order ID is required");
}
$order_id = intval($_GET['order_id']);

// Fetch order details
$orderStmt = $con->prepare("SELECT * FROM orders WHERE id = ?");
$orderStmt->bind_param("i", $order_id);
$orderStmt->execute();
$order = $orderStmt->get_result()->fetch_assoc();
if (!$order) die("Order not found!");

// Fetch order items
$itemStmt = $con->prepare("
    SELECT oi.*, p.name AS product_name, f.name AS farmer_name 
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    JOIN farmers f ON oi.vendor_id = f.id
    WHERE oi.order_id = ?
");
$itemStmt->bind_param("i", $order_id);
$itemStmt->execute();
$orderItems = $itemStmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Build HTML
$pdf->SetFont('helvetica', '', 12);
$html = '<h4>Order ID: '.$order['id'].'</h4>';
$html .= '<h4>Order Date: '.date("d M Y, h:i A", strtotime($order['created_at'])).'</h4>';

$html .= '<h3>Customer Details</h3>';
$html .= '<p>
<strong>Name:</strong> '.$order['customer_name'].'<br>
<strong>Email:</strong> '.$order['email'].'<br>
<strong>Phone:</strong> '.$order['phone'].'<br>
<strong>Address:</strong> '.$order['address'].'
</p>';

// Order items table
$html .= '<h3>Order Items</h3>';
$html .= '<table border="1" cellpadding="6">
<tr style="background-color:#28a745;color:#fff;">
<th>Product</th>
<th>Farmer</th>
<th>Qty</th>
<th>Price</th>
<th>Subtotal</th>
</tr>';

$grand_total = 0;
$row = 0;
foreach ($orderItems as $item) {
    $subtotal = $item['price_each'] * $item['quantity'];
    $grand_total += $subtotal;
    $bgcolor = ($row % 2 == 0) ? '#eafaf1' : '#ffffff';
    $html .= '<tr style="background-color:'.$bgcolor.';">
    <td>'.$item['product_name'].'</td>
    <td>'.$item['farmer_name'].'</td>
    <td align="center">'.$item['quantity'].'</td>
    <td align="right">inr.'.number_format($item['price_each'],2).'</td>
    <td align="right">inr.'.number_format($subtotal,2).'</td>
    </tr>';
    $row++;
}

// Grand total
$html .= '<tr style="background-color:#28a745;color:#fff;">
<td colspan="4" align="right"><strong>Grand Total</strong></td>
<td align="right"><strong>₹'.number_format($grand_total,2).'</strong></td>
</tr>';
$html .= '</table>';

$html .= '<p><strong>Payment Method:</strong> '.$order['payment_method'].'</p>';
$html .= '<p style="text-align:center;margin-top:20px;">Thank you for shopping with Fresh Market!</p>';

// Output HTML to PDF
$pdf->writeHTML($html, true, false, true, false, '');


// Download PDF
$pdf->Output('invoice_'.$order['id'].'.pdf', 'D');
