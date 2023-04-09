<?php
session_start();

// Check if the user is logged in as an admin
if ($_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}

// Include the database connection file
include '../Model/dbconnection.php';

// Get the form data
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];
$username = $_SESSION['username'];

// Get the user's info
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Verify the current password
if (!password_verify($current_password, $user['password'])) {
    die("Invalid Current Password");
}

// Verify the new password and confirm password match
if ($new_password !== $confirm_password) {
    die("New Passwords Do Not Match");
}

// Hash and update the new password in the database
$new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
$sql = "UPDATE users SET password = '$new_password_hash' WHERE username = '$username'";
mysqli_query($conn, $sql);

// Close the database connection
mysqli_close($conn);

// Redirect to the admin panel
header("Location: ../View/admin_panel.php");
?>
