<?php
// Controller for adding product

require_once('../Model/product_model.php');

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $sellingPrice = $_POST['selling_price'];
  $buyingPrice = $_POST['buying_price'];

  $product = new Product();
  $result = $product->addProduct($name, $sellingPrice, $buyingPrice);

  if ($result) {
    header('Location: ../View/addproduct_view.php?msg=Product added successfully');
  } else {
    header('Location: ../View/addproduct_view.php?error=Error adding product');
  }
}
?>
