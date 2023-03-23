<?php
// Controller for editing and deleting product

require_once('../Model/product_model.php');

if (isset($_GET['id']) && isset($_GET['action'])) {
  $id = $_GET['id'];
  $action = $_GET['action'];

  $product = new Product();

  if ($action == 'delete') {
    $result = $product->deleteProduct($id);
    if ($result) {
      header('Location: ../View/delete_edit_view.php?msg=Product deleted successfully');
    } else {
      header('Location: ../View/delete_edit_view.php?msg=Failed to delete product');
    }
  } else {
    $result = $product->getProductById($id);
    $row = mysqli_fetch_assoc($result);
    ?>
    <!-- Edit product form -->
    <form action="delete_edit_controller.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

      <label for="name">Product Name:</label><br>
      <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"><br>

      <label for="selling_price">Selling Price:</label><br>
      <input type="text" id="selling_price" name="selling_price" value="<?php echo $row['selling_price']; ?>"><br>

      <label for="buying_price">Buying Price:</label><br>
      <input type="text" id="buying_price" name="buying_price" value="<?php echo $row['buying_price']; ?>"><br><br>

      <input type="submit" name="update" value="Update">
    </form>
    <?php
  }
} elseif (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['selling_price']) && isset($_POST['buying_price'])) {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $selling_price = $_POST['selling_price'];
  $buying_price = $_POST['buying_price'];

  $product = new Product();
  $result = $product->updateProduct($id, $name, $selling_price, $buying_price);

  if ($result) {
    header('Location: ../View/delete_edit_view.php?msg=Product updated successfully');
  } else {
    header('Location: ../View/delete_edit_view.php?msg=Failed to update product');
  }
}
?>
