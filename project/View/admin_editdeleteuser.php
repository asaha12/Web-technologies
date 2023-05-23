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
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #333;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #ddd;
    }
    input[type=text], input[type=date], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type=submit]:hover {
        background-color: #45a049;
    }
</style>
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
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['date_of_birth']; ?></td>
            <td><?php echo $row['user_type']; ?></td>
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
