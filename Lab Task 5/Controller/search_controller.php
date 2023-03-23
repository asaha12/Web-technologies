<?php
// Controller for searching product

require_once('../Model/product_model.php');

if (isset($_POST['search'])) {
  $searchTerm = $_POST['search'];

  $product = new Product();
  $result = $product->searchProduct($searchTerm);
} else {
  header('Location: ../View/search_view.php?msg=Please enter a search term');
}
?>
