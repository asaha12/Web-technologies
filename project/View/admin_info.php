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
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Info</title>
    <style>
        /* Style the page header */
        h2 {
            font-size: 28px;
            text-align: center;
            margin-top: 20px;
        }

        /* Style the user info container */
        .user-info {
            width: 80%;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
        }

        /* Style the user info paragraphs */
        .user-info p {
            font-size: 18px;
            margin: 10px 0;
        }

        /* Style the user profile picture */
        .user-info img {
            display: block;
            margin: auto;
            margin-top: 20px;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="user-info">
        <h2>User Info:</h2>
        <p><b>Name:</b> <?php echo $user['name']; ?></p>
        <p><b>Username:</b> <?php echo $user['username']; ?></p>
        <p><b>Gender:</b> <?php echo $user['gender']; ?></p>
        <p><b>Date of Birth:</b> <?php echo $user['date_of_birth']; ?></p>
        <p><b>Profile Picture:</b></p>
        <img src="<?php echo $user['profile_picture']; ?>" width="150" height="150">
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>

