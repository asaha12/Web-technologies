<!-- View for searching product -->

<!DOCTYPE html>
<html>
<head>
  <title>Search Product</title>
</head>
<body>
  <h1>Search Product</h1>
  <?php
    if (isset($_GET['msg'])) {
      echo '<p>' . $_GET['msg'] . '</p>';
    }
  ?>
  <form action="../Controller/search_controller.php" method="POST">
    <label for="search">Search Term:</label>
    <input type="text" id="search" name="search">
    <input type="submit" value="Search">
  </form>
  <br>
  <?php
    if (isset($result)) {
      if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Product Name</th>';
        echo '<th>Selling Price</th>';
        echo '<th>Buying Price</th>';
        echo '<th>Profit</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
          $profit = $row['selling_price'] - $row['buying_price'];
          echo '<tr>';
          echo '<td>' . $row['name'] . '</td>';
          echo '<td>' . $row['selling_price'] . '</td>';
          echo '<td>' . $row['buying_price'] . '</td>';
          echo '<td>' . $profit . '</td>';
          echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
      } else {
        echo '<p>No results found</p>';
      }
    }
  ?>
  <br>
  <a href="addproduct_view.php">Add Product</a> |
  <a href="delete_edit_view.php">Edit/Delete Product</a>
</body>
</html>
