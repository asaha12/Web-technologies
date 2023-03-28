

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h2>User Login Form</h2>
    <form action="../Controller/loginC.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <label for="remember_me">Remember Me:</label>
        <input type="checkbox" name="remember_me"><br><br>
        
        <input type="submit" value="Login">
    </form>
</body>
</html>
