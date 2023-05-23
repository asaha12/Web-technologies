<?php
session_start();

// Check if the user is logged in as a customer
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    header("Location: ../View/login.php");
    exit();
}
include 'customer_header.php';
// Initialize variables
$name = "";
$address = "";
$phone = "";
$product_names = "";
$order_id = mt_rand(100000, 999999);
$total_price = 0; // initialize total price to 0

// Get cart items
$cart_items = $_SESSION['cart'];

// Calculate total price and product names
if (count($cart_items) > 0) {
    $total_price = 0; // initialize total price to delivery charge
    foreach ($cart_items as $cart_item) {
        $total_price += ($cart_item['price'] * $cart_item['quantity']);
        $product_names .= $cart_item['name'] . ", ";
    }
    $product_names = rtrim($product_names, ", "); // remove the last comma
    $total_price += 100; // add delivery charge
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate form data
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $phone = trim($_POST['phone']);

    if (empty($name) || empty($address) || empty($phone)) {
        $_SESSION['error'] = "Please fill in all fields";
    } else {
        // Store order in database
        include('../Model/dbconnection.php');
        $stmt = $conn->prepare("INSERT INTO orders (order_id, customer_name, customer_address, customer_phone, product_names, total_price) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssd", $order_id, $name, $address, $phone, $product_names, $total_price);
        $stmt->execute();
        $stmt->close();

        // Clear cart and set success message
        $_SESSION['cart'] = array();
        $_SESSION['success'] = "Your order has been placed";
        
        // Use JavaScript and Ajax to show an alert box and redirect the user to the customer panel page
        echo "<script>alert('Order placed successfully');</script>";
        echo "<script>setTimeout(function(){window.location.href='customer_panel.php';}, 1000);</script>";
        exit();
    }
}

// Check if the cart is empty
if (count($_SESSION['cart']) === 0 && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = "Your cart is empty";
    header("Location: customer_cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>

<body>
<style>
        /* Style for the checkout page */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        h1 {
            margin-top: 0;
            padding: 20px;
            background-color: #333;
            color: #fff;
        }
        form {
            padding: 20px;
            background-color: #fff;
        }
        label {
            display: inline-block;
            width: 100px;
            margin-bottom: 10px;
        }
        input[type=text] {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #333;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        input[type=submit] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #666;
        }
        p.error {
            color: red;
        }
    </style>
    <h1>Checkout</h1>

    <?php if (isset($_SESSION['error'])) { ?>
        <p style="color: red;"><?php echo $_SESSION['error']; ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>

    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br><br>

        <label>Address:</label>
    <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>"><br><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br><br>

    <h2>Cart</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart_items as $cart_item) { ?>
                <tr>
                    <td><?php echo $cart_item['name']; ?></td>
                    <td><?php echo "$" . number_format($cart_item['price'], 2); ?></td>
                    <td><?php echo $cart_item['quantity']; ?></td>
                    <td><?php echo "$" . number_format(($cart_item['price'] * $cart_item['quantity']), 2); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3">Delivery charge:</td>
                <td><?php echo "$" . number_format(100, 2); ?></td>
            </tr>
            <tr>
                <td colspan="3">Total:</td>
                <td><?php echo "$" . number_format($total_price, 2); ?></td>
            </tr>
        </tbody>
    </table>

    <br>

    <input type="submit" value="Place Order">
</form>
</body>
</html>
<br>
<br>
<?php include 'footer.php';?>