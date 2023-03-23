<?php
//Model for product table
require_once('dbconnection.php');

class Product {
  //Get all products
  function getProducts() {
    global $conn;
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);
    return $result;
  }

  //Get product by id
  function getProductById($id) {
    global $conn;
    $sql = "SELECT * FROM products WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    return $result;
  }

  //Add new product
  function addProduct($name, $selling_price, $buying_price) {
    global $conn;
    $sql = "INSERT INTO products (name, selling_price, buying_price) VALUES ('$name', '$selling_price', '$buying_price')";
    $result = mysqli_query($conn, $sql);
    return $result;
  }

  //Update product
  function updateProduct($id, $name, $selling_price, $buying_price) {
    global $conn;
    $sql = "UPDATE products SET name = '$name', selling_price = '$selling_price', buying_price = '$buying_price' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    return $result;
  }

  //Delete product
  function deleteProduct($id) {
    global $conn;
    $sql = "DELETE FROM products WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    return $result;
  }

  //Search products
  function searchProducts($keyword) {
    global $conn;
    $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%'";
    $result = mysqli_query($conn, $sql);
    return $result;
  }
}
?>
