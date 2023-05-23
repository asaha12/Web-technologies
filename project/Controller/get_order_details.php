<?php
include('../Model/dbconnection.php');

// Check if the order ID is set in the request
if (!isset($_GET['order_id'])) {
    header('HTTP/1.0 400 Bad Request');
    echo 'Order ID is missing.';
    exit();
}

// Get the order ID from the request
$order_id = $_GET['order_id'];

// Fetch the order details from the database
$stmt = $conn->prepare("SELECT name, price, quantity FROM order_items WHERE order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order_items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Return the order details as JSON
header('Content-Type: application/json');
echo json_encode($order_items);
exit();
?>