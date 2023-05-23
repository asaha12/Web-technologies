<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}
?>

<?php include 'admin_header.php';?>
<style>
    /* Styling for links in admin dashboard */
a {
    display: inline-block;
    padding: 10px 15px;
    margin: 10px;
    background-color: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    box-shadow: 0 3px 5px rgba(0,0,0,0.2);
    transition: background-color 0.2s ease-in-out;
}

a:hover {
    background-color: #2980b9;
}
</style>

    <h3>Add Product:</h3>
    <a href="../View/admin_addproduct.php">Add Product</a>

    <h3>Edit & Delete Product:</h3>
    <a href="../View/admin_editdeleteproduct.php">Edit & Delete Product</a>

    <h3>View & Search Product:</h3>
    <a href="../View/admin_viewsearchproduct.php">View & Search Product</a>

    <h3>View & Search Order:</h3>
    <a href="../View/admin_viewsearchorder.php">View & Search Order</a>




    <br><br>
    <a href="../Controller/logout.php">Logout</a>
</fieldset><br><br>
<?php include 'footer.php';?>
</body>
</html>
