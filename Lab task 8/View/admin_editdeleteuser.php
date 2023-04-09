<?php
session_start();

// Check if the user is logged in as an admin
if ($_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}

// Include the database connection file
include '../Model/dbconnection.php';

// Get the list of users
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// If no users found
if (mysqli_num_rows($result) == 0) {
    echo "No users found.";
    exit();
}
?>

<?php include 'admin_header.php';?>
    <title>View/Edit/Delete Users</title>
</head>
<body>
    <h1>View/Edit/Delete Users</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Gender</th>
            <th>Date of Birth</th>
            <th>User Type</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><input type="text" name="name" value="<?php echo $row['name']; ?>"></td>
            <td><?php echo $row['username']; ?></td>
            <td>
                <select name="gender">
                    <option value="male" <?php if ($row['gender'] == 'male') echo 'selected'; ?>>Male</option>
                    <option value="female" <?php if ($row['gender'] == 'female') echo 'selected'; ?>>Female</option>
                    <option value="other" <?php if ($row['gender'] == 'other') echo 'selected'; ?>>Other</option>
                </select>
            </td>
            <td><input type="date" name="date_of_birth" value="<?php echo $row['date_of_birth']; ?>"></td>
            <td>
                <select name="user_type">
                    <option value="admin" <?php if ($row['user_type'] == 'admin') echo 'selected'; ?>>Admin</option>
                    <option value="customer" <?php if ($row['user_type'] == 'customer') echo 'selected'; ?>>User</option>
                </select>
            </td>
            <td>
                <a href="../Controller/admin_editdeleteuserC.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="../Controller/admin_editdeleteuserC.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
        </fieldset>
</body><br><br>
</html>
<?php include 'footer.php';?>
