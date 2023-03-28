<?php
// Change these values according to your database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'project';

// Create a database connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection is successful
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
