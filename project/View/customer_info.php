<?php
session_start();

// Check if the user is logged in as an customer
if ($_SESSION['user_type'] != 'customer') {
    header("Location: ../View/login.php");
    exit();
}
include 'customer_header.php';
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
		fieldset {
			width: 50%;
			margin: auto;
			background-color: #f2f2f2;
			border-radius: 10px;
			padding: 20px;
			text-align: center;
		}
		img {
			display: block;
			margin: auto;
			margin-top: 20px;
			border-radius: 50%;
			border: 3px solid #ddd;
			box-shadow: 0px 0px 10px #ddd;
			max-width: 150px;
			max-height: 150px;
		}
		button {
			padding: 10px;
			background-color: #4CAF50;
			color: white;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}
		button:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<fieldset>
		<legend>User Info:</legend>
		<p><b>Name:</b> <?= $user['name'] ?></p>
		<p><b>Username:</b> <?= $user['username'] ?></p>
		<p><b>Gender:</b> <?= $user['gender'] ?></p>
		<p><b>Date of Birth:</b> <?= $user['date_of_birth'] ?></p>
		<p><b>Profile Picture:</b></p>
		<img src="<?= $user['profile_picture'] ?>">
	</fieldset>
	<br><br>
	<?php include 'footer.php'; ?>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
