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
$username = $_POST['username'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$date_of_birth = $_POST['date_of_birth'];

// Update the user's info in the database
$sql = "UPDATE users SET name='$name', gender='$gender', date_of_birth='$date_of_birth' WHERE username='$username'";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Redirect to the profile page
    header("Location: ../View/admin_info.php");
} else {
    die("Update failed");
}

// Close the database connection
mysqli_close($conn);
?>