<?php
session_start();

// Check if the user is logged in as an customer
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'customer') {
    header("Location: ../View/login.php");
    exit();
}
?>

<style>
    h3 {
        color: blue;
        font-size: 24px;
    }
    
    a {
        color: red;
        font-weight: bold;
        text-decoration: none;
    }

    .my-4 {
        margin-top: 2rem !important;
        margin-bottom: 2rem !important;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }


</style>
<?php include 'customer_header.php';?>


<div class="container">
    <h3 class="my-4">View &amp; Order Products:</h3>
    <a href="../View/customer_viewsearchproduct.php" class="btn btn-primary mb-4">View &amp; Order Products</a>

    <h3 class="my-4">Order History:</h3>
    <a href="../View/customer_vieworder.php" class="btn btn-primary mb-4">Order History</a>

    <a href="../Controller/logout.php" class="btn btn-danger">Logout</a>
</div>

</fieldset><br>
<?php include 'footer.php';?>
</body>
</html>
