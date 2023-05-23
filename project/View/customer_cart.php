<?php
session_start();

// Check if the user is logged in as a customer
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    header("Location: ../View/login.php");
    exit();
}
include 'customer_header.php';
// Initialize cart session variable if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle updating cart quantities
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        // Validate quantity
        $quantity = intval($quantity);
        if ($quantity < 0) {
            $_SESSION['error'] = "Invalid quantity";
            header("Location: customer_cart.php");
            exit();
        }

        // Update cart quantity
        if ($quantity === 0) {
            unset($_SESSION['cart'][$product_id]);
        } else {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }
    }

    // Redirect to cart page
    header("Location: customer_cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <script>
        // Handle clicking the checkout button
        function checkout() {
            // Check if cart is empty
            if (Object.keys(<?php echo json_encode($_SESSION['cart']); ?>).length === 0) {
                alert("Your cart is empty");
                return;
            }

            // Redirect to checkout page
            window.location.href = "customer_checkout.php";
        }

        // Update cart item quantity
        function updateQuantity(input) {
            var product_id = input.dataset.productId;
            var available = parseInt(input.dataset.available);
            var quantity = parseInt(input.value);

            if (isNaN(quantity) || quantity < 0) {
                quantity = 0;
            }

            if (quantity > available) {
                quantity = available;
            }

            input.value = quantity;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "customer_cart.php");
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("product_id=" + product_id + "&quantity=" + quantity + "&update_cart=1");
        }
    </script>
</head>
<body>
<style>
    /* Table style */
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #ddd;
    }

    /* Input style */
    input[type=number] {
        width: 60px;
        text-align: center;
    }

    /* Button style */
    button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin: 4px 2px;
        cursor: pointer;
    }

    /* Button hover effect */
    button:hover {
        opacity: 0.8;
    }

    /* Header style */
    h1 {
        font-size: 24px;
        margin-bottom: 16px;
    }

    /* Paragraph style */
    p {
        margin-top: 0;
        margin-bottom: 16px;
    }

    /* Image style */
    img {
        max-width: 100%;
        height: auto;
    }
</style>

    <h1>Cart</h1>

    <?php if (count($_SESSION['cart']) === 0) { ?>
        <p>Your cart is empty</p>
    <?php } else { ?>
        <form method="POST" action="customer_cart.php">
        <style>
    table {
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 5px;
    }
</style>

<table style="border: 1px solid black;">

                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../Model/dbconnection.php');

                    $total_price = 0;

        
                    foreach ($_SESSION['cart'] as $product_id => $cart_item) {
                        // Retrieve product information from database
                        $query = "SELECT * FROM products WHERE id = $product_id";
                        $result = mysqli_query($conn, $query);
                        $product = mysqli_fetch_assoc($result);

                        // Calculate total price for this cart item
                        $item_price = $product['price'] * $cart_item['quantity'];
                        $total_price += $item_price;
                    ?>
                        <tr>
                            <td><img src="<?php echo $product['image']; ?>" width="100" height="100"></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td><input type="number" name="quantity[<?php echo $product_id; ?>]" value="<?php echo $cart_item['quantity']; ?>" data-product-id="<?php echo $product_id; ?>" data-available="<?php echo $product['quantity']; ?>" onchange="updateQuantity(this)"></td>
                            <td><?php echo $item_price; ?></td>
                            
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <p>Total price: <?php echo $total_price; ?></p>
            <button type="button" onclick="checkout()">Checkout</button>
            <button type="submit" name="update_cart" value="1">Update cart</button>
        </form>
    <?php } ?>

</body>
</html><br><br>
<?php include 'footer.php';?>

