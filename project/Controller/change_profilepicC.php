<?php
session_start();

// Check if the user is logged in as an admin
if ($_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}

// Include the database connection file
include '../Model/dbconnection.php';

// Get the form data
$username = $_POST['username'];

// Handle the profile picture upload
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $imageFileType;
    $new_target_file = $target_dir . $new_filename;

    // Check if the file is an image
    $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
    if ($check !== false) {
        // Upload the file
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $new_target_file)) {
            // Update the database with the new profile picture path
            $new_profile_pic_path = "../uploads/" . $new_filename;
            $sql = "UPDATE users SET profile_picture = '$new_profile_pic_path' WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Redirect back to the profile page
                header("Location: ../View/admin_info.php?status=success");
                exit();
            } else {
                die("Database query failed. " . mysqli_error($conn));
            }
        } else {
            die("File upload failed.");
        }
    } else {
        die("File is not an image.");
    }
} else {
    die("No file uploaded.");
}

// Close the database connection
mysqli_close($conn);
?>
