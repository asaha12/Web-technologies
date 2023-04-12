<?php
error_reporting(0);

include_once("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $price = test_input($_POST["price"]);

  // Validate inputs
  if (empty($name)) {
    die("Product name is required.");
  }
  if (empty($price) || !is_numeric($price)) {
    die("Price must be a number.");
  }

  // Insert into database
  $sql = "INSERT INTO products (name, price)
  VALUES ('$name', '$price')";

if ($conn->query($sql) === TRUE) {
  echo "Product added successfully.";
  die(); // Terminate the script after displaying the message
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

<form method="post" onsubmit="addProduct(event)">
  <label for="name">Product name:</label>
  <input type="text" id="name" name="name"><br><br>
  <label for="price">Price:</label>
  <input type="number" id="price" name="price"><br><br>
  <input type="submit" value="Add product">
</form>

<script>
  function addProduct(event) {
    event.preventDefault();
    var name = document.getElementById("name").value;
    var price = document.getElementById("price").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        alert(this.responseText);
      }
    };
    xhttp.open("POST", "add_product.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("name=" + name + "&price=" + price);
  }
</script>

</body>
</html>
