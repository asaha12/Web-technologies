<?php
// Include the database connection file
include '../Model/dbconnection.php';

// Get the form data
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

// Check if an image was uploaded
if (isset($_FILES['image'])) {
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_type = $_FILES['image']['type'];
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    
    // Check if the file is an image
    if (!in_array($image_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        exit();
    }
    
    // Check if the file size is less than or equal to 5MB
    if ($image_size > 5000000) {
        echo "Error: Image file size must be less than or equal to 5MB.";
        exit();
    }
    
    // Generate a unique filename for the image
    $image_filename = 'image-' . uniqid() . '.' . $image_ext;
    
    // Move the uploaded image to the /uploads directory
    if (!move_uploaded_file($image_tmp_name, '../uploads/' . $image_filename)) {
        echo "Error uploading image.";
        exit();
    }
} else {
    echo "Error: No image selected.";
    exit();
}

// Insert the data into the database
$sql = "INSERT INTO products (name, quantity, price, image) VALUES ('$name', $quantity, $price, '../uploads/$image_filename')";

if (mysqli_query($conn, $sql)) {
    echo "Product added successfully.";
    die();
} else {
    echo "Error adding product: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
exit(); 