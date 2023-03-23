<!-- View for editing and deleting product -->

<!DOCTYPE html>
<html>
<head>
  <title>Edit/Delete Product</title>
</head>
<body>
  <h1>Edit/Delete Product</h1>
  <?php
    if (isset($_GET['msg'])) {
      echo '<p>' . $_GET['msg'] . '</p>';
    }
  ?>
  <table>
    <thead>
      <tr>
        <th>Product Name</th>
        <th>Profit</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        require_once('../Model/product_model.php');

        $product = new Product();
        $result = $product->getAllProducts();

        while ($row = mysqli_fetch_assoc($result)) {
          $profit = $row['selling_price'] - $row['buying_price'];
          echo '<tr>';
          echo '<td>' . $row['name'] . '</td>';
          echo '<td>' . $profit . '</td>';
          echo '<td>';
          echo '<a href="../Controller/delete_edit_controller.php?id=' . $row['id'] . '&action=edit">Edit</a> | ';
          echo '<a href="../Controller/delete_edit_controller.php?id=' . $row['id'] . '&action=delete">Delete</a>';
          echo '</td>';
          echo '</tr>';
        }
      ?>
    </tbody>
  </table>
  <br>
  <a href="addproduct_view.php">Add Product</a> |
  <a href="search_view.php">Search Product</a>
</body>
</html>
