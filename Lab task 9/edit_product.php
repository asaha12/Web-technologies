<?php
include_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $id = test_input($_GET["id"]);

  // Retrieve the product from the database
  $sql = "SELECT * FROM products WHERE id='$id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $price = $row["price"];
  } else {
    die("Product not found.");
  }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = test_input($_POST["id"]);
  $name = test_input($_POST["name"]);
  $price = test_input($_POST["price"]);

  // Validate inputs
  if (empty($name)) {
    die("Product name is required.");
  }
  if (empty($price) || !is_numeric($price)) {
    die("Price must be a number.");
  }

  // Update the product in the database
  $sql = "UPDATE products SET name='$name', price='$price' WHERE id='$id'";

  if ($conn->query($sql) === TRUE) {
    echo "Product updated successfully.";
    die();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<html>
<body>

<h2>Edit Product</h2>

<form method="post" onsubmit="updateProduct(event)">
  <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
  <label for="name">Product name:</label>
  <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br><br>
  <label for="price">Price:</label>
  <input type="number" id="price" name="price" value="<?php echo $price; ?>"><br><br>
  <input type="submit" value="Update product">
</form>

<script>
  function updateProduct(event) {
    event.preventDefault();
    var id = document.getElementById("id").value;
    var name = document.getElementById("name").value;
    var price = document.getElementById("price").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        alert(this.responseText);
      }
    };
    xhttp.open("POST", "edit_product.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id + "&name=" + name + "&price=" + price);
  }
</script>

</body>
</html>
