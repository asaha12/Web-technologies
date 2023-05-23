<?php
session_start();

// Check if the user is logged in as a customer
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    header("Location: ../View/login.php");
    exit();
}
include 'customer_header.php';
// Include database connection file
include('../Model/dbconnection.php');

// Fetch all products from the database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

// Initialize cart session variable if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle add to cart request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Get product ID and quantity
    $product_id = $_POST['product_id'];
    $quantity = intval($_POST['quantity']);

    // Validate quantity
    if ($quantity < 1) {
        $_SESSION['error'] = "Invalid quantity";
        header("Location: customer_viewsearchproduct.php");
        exit();
    }

    // Fetch product from database
    $sql = "SELECT * FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);

    // Check if product is already in cart
    if (array_key_exists($product_id, $_SESSION['cart'])) {
        // Update quantity in cart
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // Add product to cart
        $_SESSION['cart'][$product_id] = array(
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => $quantity,
            'available' => $product['quantity']
        );
    }

    // Redirect to cart page
    header("Location: customer_cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View & Order Products</title>
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

        // Update availability based on quantity input
        function updateAvailability(input) {
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

            var availability = document.getElementById("availability-" + product_id);
            if (availability) {
                if (quantity === 0) {
                    availability.innerHTML = "Enter Vaild Quantity";
                    availability.style.color = "red";
                } else if (quantity > 100) {
                    availability.innerHTML = "Low stock";
                    availability.style.color = "orange";
                } else {
                    availability.innerHTML = "In stock";
                    availability.style.color = "green";
                }
            }
        }
    </script>
</head>
<style>
    table {
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 5px;
    }
</style>
<body>
<style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        input[type="number"] {
            width: 50px;
        }

        button[name="add_to_cart"] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        button[name="checkout"] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            float: right;
        }

        .availability {
            font-weight: bold;
        }

        .out-of-stock {
            color: red;
        }

        .low-stock {
            color: orange;
        }

        .in-stock {
            color: green;
        }
    </style>
    <h1>View/Search Products</h1>

    <table style="border: 1px solid black;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
        <th>Price</th>
        <th>Add to Cart</th>
        <th>Availability</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($product = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $product['id']; ?></td>
            <td><img src="<?php echo $product['image']; ?>" width="100" height="100"></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <!-- Add a new form for add to cart and quantity input -->
            <td>
                <form method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['quantity']; ?>"
                           oninput="updateAvailability(this)" data-product-id="<?php echo $product['id']; ?>"
                           data-available="<?php echo $product['quantity']; ?>">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </td>
            <td>
                <span id="availability-<?php echo $product['id']; ?>">
                    <?php if ($product['quantity'] === 0) {
                        echo "Out of stock";
                        echo "<script>document.querySelector('#availability-" . $product['id'] . "').style.color = 'red';</script>";
                    } else if ($product['quantity'] < 5) {
                        echo "Low stock";
                        echo "<script>document.querySelector('#availability-" . $product['id'] . "').style.color = 'orange';</script>";
                    } else {
                        echo "In stock";
                        echo "<script>document.querySelector('#availability-" . $product['id'] . "').style.color = 'green';</script>";
                    } ?>
                </span>
            </td>
            
        </tr>
    <?php } ?>
    </tbody>
</table>

<button onclick="checkout()">Checkout</button>
</body>
</html><br><br>
<?php include 'footer.php';?>
