<?php
session_start();

// Check if the user is logged in as a customer
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    header("Location: ../View/login.php");
    exit();
}
include 'customer_header.php';
// Include the database connection file
include '../Model/dbconnection.php';

function getPriceForProduct($product_name) {
    global $conn;
    $sql = "SELECT price FROM products WHERE name = '$product_name'";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);
    return $product['price'];
}

// Get the user's info
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
} else {
    die("Session variable not set");
}

// Get customer name
$customer_name = $user['name'];

// Fetch orders for the customer
include('../Model/dbconnection.php');
$stmt = $conn->prepare("SELECT order_id, customer_name, customer_address, customer_phone, product_names, total_price FROM orders WHERE customer_name = ? ");

$stmt->bind_param("s", $customer_name);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html>
<style>
    table {
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 5px;
    }
</style>
<head>
    <title>Order History</title>
</head>
<body>
        <style>

body {
  font-family: Arial, sans-serif;
}

h1 {
  font-size: 28px;
  margin-bottom: 20px;
}

table {
  border-collapse: collapse;
  margin-top: 20px;
  width: 100%;
}

th, td {
  border: 1px solid #ccc;
  padding: 10px;
  text-align: center;
}

thead {
  background-color: #f5f5f5;
}

tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

a {
  color: #007bff;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

#order-details-modal {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 9999;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  display: none;
  justify-content: center;
  align-items: center;
}

#order-details-modal h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

#order-details-modal p {
  font-size: 18px;
  margin-bottom: 10px;
}

#order-details-modal table {
  margin-top: 20px;
}

#order-details-modal table th,
#order-details-modal table td {
  padding: 5px 10px;
}


        </style>

    <h1>Order History</h1>

    <table style="border: 1px solid black;">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Names</th>
                <th>Total Price</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order) { ?>
            <tr>
                <td><?php echo $order['order_id']; ?></td>
                <td><?php echo $order['product_names']; ?></td>
                <td><?php echo $order['total_price']; ?></td>
                <td><a href="#" onclick="showOrderDetails(<?php echo $order['order_id']; ?>)">Show Details</a></td>
            </tr>
            <div id="order-details-modal-<?php echo $order['order_id']; ?>" style="display: none;">
                <h2>Order Details - Order ID: <?php echo $order['order_id']; ?></h2>
                <p><strong>Customer Name:</strong> <?php echo $order['customer_name']; ?></p>
                <p><strong>Customer Address:</strong> <?php echo $order['customer_address']; ?></p>
                <p><strong>Customer Phone:</strong> <?php echo $order['customer_phone']; ?></p>
                <table>
                  
                    <tbody>
                <p><a href="#" onclick="hideOrderDetails(<?php echo $order['order_id']; ?>)">Close</a></p>
            </div>
        <?php } ?>
        </tbody>
    </table>
    <script>
    function showOrderDetails(orderId) {
        document.getElementById("order-details-modal-" + orderId).style.display = "block";
    }

    function hideOrderDetails(orderId) {
        document.getElementById("order-details-modal-" + orderId).style.display = "none";
    }
</script>
</body>
</html><br>
<?php include 'footer.php';?>