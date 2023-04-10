<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["name"])) {
  $name = $_GET["name"];
  echo "<h3>Hello, $name!</h3>";
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"])) {
  $name = $_POST["name"];
  echo "<h3>Hello, $name!</h3>";
}
?>
