<?php
echo "Search query: " . $_POST['search'];
// Include the database connection file
include '../Model/dbconnection.php';

// Fetch all orders
$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the database connection
mysqli_close($conn);

// Check if search query was submitted
if (isset($_POST['search'])) {
    // Get search query
    $search = $_POST['search'];

    // Filter orders by search query
    $orders = array_filter($orders, function ($order) use ($search) {
        return stripos($order['customer_name'], $search) !== false || stripos($order['order_id'], $search) !== false;
    });
}

// Render orders table rows
$rows = '';
foreach ($orders as $order) {
    $rows .= '<tr>
                <td>' . $order['order_id'] . '</td>
                <td>' . $order['customer_name'] . '</td>
                <td>' . $order['customer_address'] . '</td>
                <td>' . $order['customer_phone'] . '</td>
                <td>' . $order['product_names'] . '</td>
                <td>' . $order['total_price'] . '</td>
             </tr>';
}

echo $rows;
?>
