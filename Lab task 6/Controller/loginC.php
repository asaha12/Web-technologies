<?php
// Start the session
session_start();
// Include the database connection file
include '../Model/dbconnection.php';

// Get the form data
$username = $_POST['username'];
$password = $_POST['password'];
$remember_me = $_POST['remember_me'];

// Get the user from the database
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

// Check if the user exists
if (mysqli_num_rows($result) == 0) {
    die("Invalid Username or Password");
}

// Verify the password
$user = mysqli_fetch_assoc($result);
if (!password_verify($password, $user['password'])) {
    die("Invalid Username or Password");
}

// Store the user information in session variables
$_SESSION['user_type'] = $user['user_type'];
$_SESSION['username'] = $user['username'];


// Set the remember me cookie if the checkbox is checked
if ($remember_me) {
    $cookie_name = "user_credentials";
    $cookie_value = base64_encode($username . ":" . $password);
    $cookie_expiration = time() + (30 * 24 * 60 * 60); // 30 days
    setcookie($cookie_name, $cookie_value, $cookie_expiration, "/");}

// Redirect to the appropriate panel
if ($_SESSION['user_type'] == 'admin') {
    header("Location: ../View/admin_panel.php");
} elseif ($_SESSION['user_type'] == 'customer') {
    header("Location: ../View/customer_panel.php");
} else {
    die("Unknown user type");
}

// Close the database connection
mysqli_close($conn);
?>
