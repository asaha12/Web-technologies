<?php
session_start();

// Check if the user is logged in as an admin
if ($_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}
?>

<?php include 'admin_header.php';?>
<head>
    <title>Change Password</title>
</head>
<body>
    <h2>Change Password</h2>
    <form action="../Controller/admin_changepasswordC.php" method="post">
        <label for="current_password">Current Password:</label>
        <input type="password" name="current_password" required><br><br>

        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required><br><br>

        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" name="confirm_password" required><br><br>

        <input type="submit" value="Change Password">
    </form>
    </fieldset>
    <br>
</body>
</html>
<?php include 'footer.php';?>