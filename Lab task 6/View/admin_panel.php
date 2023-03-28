<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h2>Welcome to the Admin Panel, <?php echo $_SESSION['username']; ?>!</h2>

    <h3>Logged User Info:</h3>
    <a href="../View/admin_info.php">View Info</a>

    <h3>Edit Profile:</h3>
    <a href="../View/admin_editprofile.php">Edit Profile</a>

    <h3>Change Password:</h3>
    <a href="../View/admin_changepassword.php">Change Password</a>

    <h3>Change Profile Picture:</h3>
    <a href="../View/change_profilepic.php">Change Profile Picture</a>

    <br><br>
    <a href="../Controller/logout.php">Logout</a>
</body>
</html>
