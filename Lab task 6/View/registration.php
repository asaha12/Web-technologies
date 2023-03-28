<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration Form</h2>
    <form action="../Controller/registrationC.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name"><br><br>

        <label for="username">Username:</label>
        <input type="text" name="username"><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password"><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password"><br><br>

        <label for="gender">Gender:</label>
        <select name="gender">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth"><br><br>

        <label for="profile_picture">Profile Picture:</label>
        <input type="file" name="profile_picture"><br><br>

        <label for="user_type">User Type:</label>
        <select name="user_type">
            <option value="">Select User Type</option>
            <option value="admin">Admin</option>
            <option value="customer">Customer</option>
        </select><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
