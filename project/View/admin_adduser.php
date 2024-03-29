<?php
session_start();

// Check if the user is logged in as an admin
if ($_SESSION['user_type'] != 'admin') {
    header("Location: ../View/login.php");
    exit();
}

include 'admin_header.php';
?>

<head>
    <title>Add User</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #333;
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }
        input[type="text"], input[type="password"], select {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .error {
            color: red;
            font-size: 80%;
        }
        .invalid {
            border-color: red;
        }
    </style>
    
    <script>
function validateForm() {
    var name = document.getElementById("name");
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    var confirmPassword = document.getElementById("confirm_password");

    var nameError = document.getElementById("nameError");
    var usernameError = document.getElementById("usernameError");
    var passwordError = document.getElementById("passwordError");
    var confirmPasswordError = document.getElementById("confirmPasswordError");

    var valid = true;

    // Validate name
    name.addEventListener("input", function() {
        name.classList.remove("invalid");
        nameError.innerHTML = "";
    });

    if (name.value == "") {
        nameError.innerHTML = "Name cannot be empty";
        name.classList.add("invalid");
        valid = false;
    } else if (!/^[a-zA-Z ]+$/.test(name.value)) {
        nameError.innerHTML = "Name should only contain A-Z characters";
        name.classList.add("invalid");
        valid = false;
    }

    // Validate username
    username.addEventListener("input", function() {
        username.classList.remove("invalid");
        usernameError.innerHTML = "";
    });

    if (username.value == "") {
        usernameError.innerHTML = "Username cannot be empty";
        username.classList.add("invalid");
        valid = false;
    } else if (!/^[a-zA-Z0-9\-_]+$/.test(username.value)) {
        usernameError.innerHTML = "Username should only contain A-Z, 0-9, -, and _ characters";
        username.classList.add("invalid");
        valid = false;
    }

    // Validate password
    password.addEventListener("input", function() {
        password.classList.remove("invalid");
        passwordError.innerHTML = "";
    });

    if (password.value == "") {
        passwordError.innerHTML = "Password cannot be empty";
        password.classList.add("invalid");
        valid = false;
    } else if (!/[\'^£$%&*()}{@#~?><,|=_+¬-]/.test(password.value)) {
        passwordError.innerHTML = "Password should contain at least one special character";
        password.classList.add("invalid");
        valid = false;
    }

    // Validate confirm password
    confirmPassword.addEventListener("input", function() {
        confirmPassword.classList.remove("invalid");
        confirmPasswordError.innerHTML = "";
    });

    if (confirmPassword.value == "") {
        confirmPasswordError.innerHTML = "Confirm Password cannot be empty";
        confirmPassword.classList.add("invalid");
        valid = false;
    } else if (confirmPassword.value != password.value) {
        confirmPasswordError.innerHTML = "Confirm Password should match Password";
        confirmPassword.classList.add("invalid");
        valid = false;
    }

    return valid;
}
</script>

</head>
<body>
    <h2>Add User</h2>
    <form name="addUserForm" action="../Controller/admin_adduserC.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <label for="name">Name:</label>
        <input type="text" name="name" id="name" oninput="resetError(this)"><br>
        <span id="nameError" class="error"></span><br>

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" oninput="resetError(this)"><br>
        <span id="usernameError" class="error"></span><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" oninput="resetError(this)"><br>
        <span id="passwordError" class="error"></span><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" oninput="resetError(this)"><br>
        <span id="confirmPasswordError" class="error"></span><br>

        <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" id="date_of_birth"><br><br>

        <label for="profile_picture">Profile Picture:</label>
        <input type="file" name="profile_picture" id="profile_picture"><br><br>

        <label for="user_type">User Type:</label>
        <select name="user_type" id="user_type">
            <option value="">Select User Type</option>
            <option value="admin">Admin</option>
            <option value="customer">Customer</option>
        </select><br><br>

    <input type="submit" value="Add User">
</form>
<br><br>
</body>
<?php include 'footer.php';?>