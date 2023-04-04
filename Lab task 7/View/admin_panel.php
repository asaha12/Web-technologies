<?php
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}
?>

<?php include 'admin_header.php';?>

    <h3>Logged User Info:</h3>
    <a href="../View/admin_info.php">View Info</a>

    <h3>Edit Profile:</h3>
    <a href="../View/admin_editprofile.php">Edit Profile</a>

    <h3>Change Password:</h3>
    <a href="../View/admin_changepassword.php">Change Password</a>

    <h3>Change Profile Picture:</h3>
    <a href="../View/change_profilepic.php">Change Profile Picture</a>

    <h3>Add User:</h3>
    <a href="../View/admin_adduser.php">Add User</a>

    <h3>Edit & Delete Users:</h3>
    <a href="../View/admin_editdeleteuser.php">Edit & Delete User</a>


    <br><br>
    <a href="../Controller/logout.php">Logout</a>
</fieldset><br>
<?php include 'footer.php';?>
</body>
</html>
