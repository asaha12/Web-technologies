<?php
// Include the database connection file
include '../Model/dbconnection.php';

// Get the user ID from the URL
$id = $_GET['id'];

// Check if the form has been submitted for deleting user
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    // Delete the user from the database
    $sql = "DELETE FROM users WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $user_type = $_POST['user_type'];

    // Update the data in the database
    $sql = "UPDATE users SET name='$name', username='$username', gender='$gender', date_of_birth='$date_of_birth', user_type='$user_type' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "User updated successfully.";
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
    exit();
}

// Get the user data from the database
$sql = "SELECT * FROM users WHERE id=$id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $username = $row['username'];
    $gender = $row['gender'];
    $date_of_birth = $row['date_of_birth'];
    $user_type = $row['user_type'];
} else {
    echo "User not found.";
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?php echo $name; ?>"><br>

    <label for="username">Username:</label>
    <input type="text" name="username" value="<?php echo $username; ?>"><br>

    <label for="gender">Gender:</label>
    <select name="gender">
        <option value="male" <?php if ($gender == 'male') echo 'selected'; ?>>Male</option>
        <option value="female" <?php if ($gender == 'female') echo 'selected'; ?>>Female</option>
        <option value="other" <?php if ($gender == 'other') echo 'selected'; ?>>Other</option>
    </select><br>

    <label for="date_of_birth">Date of Birth:</label>
    <input type="date" name="date_of_birth" value="<?php echo $date_of_birth; ?>"><br>

    <label for="user_type">User Type:</label>
    <select name="user_type">
        <option value="admin" <?php if ($user_type == 'admin') echo 'selected'; ?>>Admin</option>
        <option value="customer" <?php if ($user_type == 'customer') echo 'selected'; ?>>User</option>
    </select><br>

    <input type="submit" value="Update">
</form>

<br>

<form method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
    <input type="hidden" name="action" value="delete">
    <input type="submit" value="Delete">
</form>
</body>
</html>