<!DOCTYPE HTML>  
<html>
  <head> <title> LOGIN Page </title>
    <style>
     .error {color: Red;}
    </style>
    </head>
    <body>  
	
	   

    <?php
	
    $username = $password = "";
    $usernameErr = $passwordErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
    
        if (empty($_POST["username"])) {
            $usernameErr = "UserName is required!";
        } else {
            $username = test_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Z0-9._-]*$/", $username)) {
                $usernameErr = "User Name can contain alpha numeric characters, period, dash or underscore only!";
            }
            if (strlen($username) < 2) {
                $usernameErr = "UserName contains at least 2 char!";
            }
        }
    
        if (empty($_POST["password"])) {
            $passwordErr = "Password is required!";
        } else {
            $password = test_input($_POST["password"]);
            if (strlen($password) < 8) {
                $passwordErr = "Password must not be less than 8 char!";
            }
            if (!preg_match('/[@#$%]/', $password)) {
                $passwordErr .= "Password must contain at least 1 of the special characters (@, #, $, %)!";
            }
        }
    }
    
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
        
    ?>
	       <br>

		  
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		  
             <fieldset>
                <legend>LOGIN</legend>
		  
		     <b> <label for="username"> UserName : </label> </b>
			   <input type="text" name="username" value="<?php echo htmlspecialchars($username);?>">
			   <span class="error"> * <?php echo $usernameErr; ?> </span>
             
               <br><br>
			  
			    <b> <label for="password"> Password : </label> </b>
                <input type="password" name="password" value="<?php echo htmlspecialchars($password);?>">
                <span class="error"> * <?php echo $passwordErr;?></span>
                <br><br>
				
		     <div>
                <hr>
                <input type="checkbox" name="Remember me"> Remember Me <br><br>

                <input type="submit" name="submit" value="Submit" echo $Login Successful;  > <a href="http://">Forgot Password?</a><br>

             
                    
             </div>
             </fieldset>
         </form> <br>
	 
    </body>
</html>