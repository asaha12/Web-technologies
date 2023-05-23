<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}

// Include the database connection file
include '../Model/dbconnection.php';

// Get the order ID from the query string
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
} else {
    die("Order ID not specified");
}

// Fetch the order details
$stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();
$stmt->close();

// Fetch the product details for the order
$product_names = explode(',', $order['product_names']);
$products = array();
foreach ($product_names as $product_name) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE name = ?");
    $stmt->bind_param("s", $product_name);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    array_push($products, $product);
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details - Order ID: <?php echo $order_id; ?></title>
</head>
<body>
    <h1>Order Details - Order ID: <?php echo $order_id; ?></h1>

    <h2>Customer Details</h2>
    <p><strong>Name:</strong> <?php echo $order['customer_name']; ?></p>
    <p><strong>Address:</strong> <?php echo $order['customer_address']; ?></p>
    <p><strong>Phone:</strong> <?php echo $order['customer_phone']; ?></p>

    <h2>Product Details</h2>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product) { ?>
            <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <p><strong>Total Price:</strong> <?php echo $order['total_price']; ?></p>
</body>
</html>
