<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}

include 'admin_header.php';

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

?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Orders</title>
    <script>
    function searchOrders() {
        var search = document.getElementById("search-input").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("orders-table-body").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "../Controller/admin_viewsearchorderC.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("search=" + search);
    }
</script>

</head>
<body>
    <h1>Search Orders</h1>

    <div>
        <label for="search-input">Search by name or order ID:</label>
        <input type="text" id="search-input" name="search">
        <button onclick="searchOrders()">Search</button>
    </div><br>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
        color: #333;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    h1 {
        font-size: 24px;
        font-weight: bold;
        margin: 20px 0;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"] {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 16px;
    }

    button {
        padding: 5px 10px;
        border: none;
        border-radius: 3px;
        background-color: #4CAF50;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #3e8e41;
    }

    table {
        border-collapse: collapse;
        margin: 20px 0;
    }

    th, td {
        border: 1px solid black;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #ddd;
        font-weight: bold;
    }
</style>

<table style="border: 1px solid black;">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Address</th>
                <th>Customer Phone</th>
                <th>Product Names</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody id="orders-table-body">
            <?php foreach ($orders as $order) { ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['customer_name']; ?></td>
                    <td><?php echo $order['customer_address']; ?></td>
                    <td><?php echo $order['customer_phone']; ?></td>
                    <td><?php echo $order['product_names']; ?></td>
                    <td><?php echo $order['total_price']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html><br>
<?php include 'footer.php'; ?>
