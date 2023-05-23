
<?php
// Include database connection file
include_once("../Model/dbconnection.php");

// Get the search term from the AJAX POST request
$searchTerm = $_POST['search'];

// Build SQL query to search for products with matching name
$sql = "SELECT * FROM products";

// Execute SQL query
$result = mysqli_query($con, $sql);

// Check if any products were found
if (mysqli_num_rows($result) > 0) {
	// Display each product in a table row
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>" . $row['id'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['price'] . "</td>";
		echo "<td><img src='" . $row['image'] . "' width='100'></td>";
		echo "</tr>";
	}
} else {
	// Display message if no products were found
	echo "<tr><td colspan='4'>No products found</td></tr>";
}
?>
