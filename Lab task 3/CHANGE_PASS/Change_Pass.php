<!DOCTYPE html>
<html>
<head> <title> CHANGE PASSWORD </title>
  
  <style>

      .error {color: Red;}
     
     
     </style>
   
  </head>
    <body>
      <?php
        $currentPassword = "abc@1234";
        $newpassword = $rnewpassword = "";
        $cpasswordError = $npasswordError = $rnpasswordError = "";
        $updated = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["currentPassword"])) {
                $cpasswordError = "Current password is required!";
            } else {
                $currentPassword = test_input($_POST["currentPassword"]);
                if ($currentPassword !== "abc@1234") {
                    $cpasswordError = "Incorrect password!";
                }
            }
        
            if (empty($_POST["newpassword"])) {
                $npasswordError = "New password is required!";
            } else {
                $newpassword = test_input($_POST["newpassword"]);
                if ($newpassword === $currentPassword) {
                    $npasswordError = "New Password should not be same as the Current Password!";
                }
            }
        
            if (empty($_POST["rnewpassword"])) {
                $rnpasswordError = "Retype New Password is required!";
            } else {
                $rnewpassword = test_input($_POST["rnewpassword"]);
                if ($newpassword !== $rnewpassword) {
                    $rnpasswordError = "New Password must match with the Retyped Password!";
                } else {
                    $updated = "Password updated successfully";
                }
            }
        }
        
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
         ?>
	     <div>
          <br>
          <fieldset>
          <legend> CHANGE PASSWORD </legend>
          <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		  
	  
          <label>Current Password :</label> 
		      <input type="password" name="currentPassword" value="<?php echo $currentPassword;?>">
          <span class="error">* <?php echo $cpasswordError;?></span>
          <br/><br/>
		  
		  
          <label style="color:green">New Password :</label>
          <input type="password" name="newpassword" value="<?php echo $newpassword;?>">
          <span class="error">* <?php echo $npasswordError;?></span>
          <br/><br/>
		  
		  
          <label style="color:Red">Retype New Password :</label>

          <input type="password" name="rnewpassword" value="<?php echo $rnewpassword;?>">
          <span class="error">* <?php echo $rnpasswordError;?></span>
          <br/><br/>
           <hr> </hr>
		  
          
		      </div> 
          <br>
		 
          <input type="submit" name=" submit" value="Submit">
          
		      <?php  					 
               if(isset($updated))  
                 {  
                       echo $updated;  
                 }  
          ?> 
          </fieldset>
          <br/><br/>
                
      
      </form>
      
  </body>
</html>