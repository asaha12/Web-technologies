<?php
session_start();

// Check if the user is logged in as an admin
if ($_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}
include 'admin_header.php';
// Include the database connection file
include '../Model/dbconnection.php';

// Get the user's info
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
} else {
    die("Session variable not set");
}

// Output the user's info
echo "<h2>User Info:</h2>";
echo "<p><b>Name:</b> " . $user['name'] . "</p>";
echo "<p><b>Username:</b> " . $user['username'] . "</p>";
echo "<p><b>Gender:</b> " . $user['gender'] . "</p>";
echo "<p><b>Date of Birth:</b> " . $user['date_of_birth'] . "</p>";
echo "<p><b>Profile Picture:</b></p>";
echo "<img src='" . $user['profile_picture'] . "' width='150' height='150'>";
echo "</fieldset>";
echo "<br><br>";
// Close the database connection
mysqli_close($conn);

include 'footer.php';
?>
