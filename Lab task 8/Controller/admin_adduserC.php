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
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$gender = $_POST['gender'];
$date_of_birth = $_POST['date_of_birth'];
$user_type = $_POST['user_type'];

// Validate the form data
if (empty($name) || empty($username) || empty($password) || empty($confirm_password) || empty($gender) || empty($date_of_birth) || empty($user_type)) {
    die("Please fill all fields");
}
if (!preg_match("/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/", $name)) {
    die("Invalid Name");
}
if (!preg_match("/^[a-zA-Z0-9_]{5,}$/", $username)) {
    die("Invalid Username");
}
if (!preg_match("/[\'^£$%&*()}{@#~?><,|=_+¬-]/", $password)) {
    die("Password must contain at least one special characters");
}
if ($password !== $confirm_password) {
    die("Passwords do not match");
}

// Handle profile picture upload
$target_dir = "../uploads/";
$profile_picture = $_FILES['profile_picture']['name'];
$target_file = $target_dir . basename($profile_picture);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$allowed_types = array('jpg', 'jpeg', 'png', 'gif');

if (!in_array($imageFileType, $allowed_types)) {
    die("Invalid file format. Only JPG, JPEG, PNG and GIF are allowed.");
}


if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
    $profile_picture = $target_file;
} else {
    die("Sorry, there was an error uploading your file.");
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the data into the database
$sql = "INSERT INTO users (name, username, password, gender, date_of_birth, profile_picture, user_type)
VALUES ('$name', '$username', '$hashed_password', '$gender', '$date_of_birth', '$profile_picture', '$user_type')";

if (mysqli_query($conn, $sql)) {
    echo "User added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
