<?php
include_once("db.php");

// Retrieve all products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Check if any products were found
if ($result->num_rows > 0) {
  // Display a table of all products
  echo "<table>";
  echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Actions</th></tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["price"] . "</td>";
    echo "<td><a href='edit_product.php?id=" . $row["id"] . "'>Edit</a></td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No products found.";
}

$conn->close();
?>
