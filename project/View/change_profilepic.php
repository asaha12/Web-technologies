<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../View/login.php");
    exit();
}
include 'admin_header.php';
// Include the database connection file
include '../Model/dbconnection.php';

// Get the user's info
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Profile Picture</title>
</head>
<body>
    <h2>Change Profile Picture</h2>
    <form action="../Controller/change_profilepicC.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
        <label for="profile_picture">Profile Picture:</label>
        <input type="file" name="profile_picture" required><br><br>

        <input type="submit" value="Update">
    </form>
</fieldset>
</body>
</html>
<?php include 'footer.php';?>