<?php
include_once '../Model/dbconnection.php';

$action = $_POST['action'];

if ($action == 'get-products') {
    // Get the list of products from the database
    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);

    // Generate the HTML for the product list
    $output = '<table>';
    $output .= '<tr><th>ID</th><th>Name</th><th>Quantity</th><th>Price</th><th>Actions</th></tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '<tr>';
        $output .= '<td>' . $row['id'] . '</td>';
        $output .= '<td>' . $row['name'] . '</td>';
        $output .= '<td>' . $row['quantity'] . '</td>';
        $output .= '<td>$' . number_format($row['price'], 2) . '</td>';
        $output .= '<td>';
        $output .= '<button onclick="editProduct(' . $row['id'] . ', \'' . $row['name'] . '\', ' . $row['quantity'] . ', ' . $row['price'] . ')">Edit</button>';
        $output .= '</td>';
        $output .= '</tr>';
    }
    $output .= '</table>';

    echo $output;
} elseif ($action == 'edit') {
    // Update the product in the database
    $productId = $_POST['productId'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $query = "UPDATE products SET name='$name', quantity='$quantity', price='$price' WHERE id='$productId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'Product updated successfully';
    } else {
        echo 'Error updating product: ' . mysqli_error($conn);
    }
} elseif ($action == 'delete') {
    // Delete the product from the database
    $productId = $_POST['productId'];

    $query = "DELETE FROM products WHERE id='$productId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'Product deleted successfully';
    } else {
        echo 'Error deleting product: ' . mysqli_error($conn);
    }
}
?>
