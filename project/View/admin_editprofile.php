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
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Output the user's info
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h2>Edit Profile</h2>
    <form action="../Controller/admin_editprofileC.php" method="post">
        <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
        <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br><br>

    <label for="gender">Gender:</label>
    <input type="radio" name="gender" value="male" <?php if($user['gender'] == 'male') echo 'checked'; ?>>Male
    <input type="radio" name="gender" value="female" <?php if($user['gender'] == 'female') echo 'checked'; ?>>Female
    <input type="radio" name="gender" value="other" <?php if($user['gender'] == 'other') echo 'checked'; ?>>Other
    <br><br>

    <label for="date_of_birth">Date of Birth:</label>
    <input type="date" name="date_of_birth" value="<?php echo $user['date_of_birth']; ?>" required><br><br>

    <input type="submit" value="Update">
</fieldset>
</form>
</body>
</html>
<?php include 'footer.php' ?>;