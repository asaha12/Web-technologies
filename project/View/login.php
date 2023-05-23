<?php include 'normalheader.php';?>
<head>
    <title>User Login</title>
    <style>
        body {
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
}

h2 {
    color: #333;
    font-size: 24px;
}

input[type=text], input[type=password] {
    border: 1px solid #ccc;
    padding: 5px;
    font-size: 16px;
}

label {
    display: inline-block;
    width: 120px;
    font-weight: bold;
}

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #3e8e41;
}

        </style>
    <script>
     function validateForm() {
            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;
            var usernameError = document.getElementById("usernameError");
            var passwordError = document.getElementById("passwordError");

            if (username == "") {
                usernameError.innerHTML = "Please enter your username";
                usernameError.style.color = "red";
                document.forms["loginForm"]["username"].style.borderColor = "red";
            } else {
                usernameError.innerHTML = "";
                document.forms["loginForm"]["username"].style.borderColor = "";
            }

            if (password == "") {
                passwordError.innerHTML = "Please enter your password";
                passwordError.style.color = "red";
                document.forms["loginForm"]["password"].style.borderColor = "red";
            } else {
                passwordError.innerHTML = "";
                document.forms["loginForm"]["password"].style.borderColor = "";
            }

            if (username == "" || password == "") {
                return false;
            } else {
                return true;
            }
}

        
        function removeErrorMessage(input, error) {
            input.style.borderColor = "";
            error.innerHTML = "";
        }
    </script>
    <style>
        input[type=text], input[type=password] {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h2>User Login Form</h2>
    <form name="loginForm" action="../Controller/loginC.php" method="post" onsubmit="return validateForm()">
        <label for="username">Username:</label>
        <input type="text" name="username" oninput="removeErrorMessage(this, usernameError)"><br>
        <span id="usernameError"></span><br>
        
        <label for="password">Password:</label>
        <input type="password" name="password" oninput="removeErrorMessage(this, passwordError)"><br>
        <span id="passwordError"></span><br>

        <label for="remember_me">Remember Me:</label>
        <input type="checkbox" name="remember_me"><br><br>

        <input type="submit" value="Login">
    </form>
    <br>
    <?php include 'footer.php';?>
</body>
</html>
