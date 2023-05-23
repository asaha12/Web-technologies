<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
    }
    
    h1, h2, h3, h4, h5, h6 {
        margin: 0;
        font-weight: normal;
    }
    
    a {
        text-decoration: none;
        color: SlateBlu;
    }
    
    a:hover {
        text-decoration: underline;
    }
    
    legend {
        font-size: 1.2em;
        font-weight: bold;
    }
    
    fieldset {
        border: none;
        padding: 20px;
    }
    
    hr {
        border: 0;
        border-top: 1px solid #ccc;
        margin: 20px 0;
    }
    
    #header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    #header h1 {
        font-size: 3em;
        color: green;
        margin: 0;
    }
    
    #header h1 sub {
        font-size: 0.5em;
        color: black;
        vertical-align: super;
    }
    
    #header h3 {
        margin: 0;
    }
    
    #header h3 a {
        margin-left: 20px;
    }
    
    #welcome {
        text-align: center;
        margin-top: 50px;
    }
    
    #welcome h1 {
        font-size: 2em;
        color: green;
        margin: 0;
    }
    
    #welcome sub {
        font-size: 1em;
        color: black;
    }
    
    #footer {
        text-align: center;
        margin-top: 50px;
        color: #8c8c8c;
    }
</style>

    
<fieldset>
		   <div> 
		   
		      <p ><h1 style="color: green">  X  <sub style="color:black">Company </sub> <h1> </p> 
		 
		 
		   
		       <h3 align= "right">
		 
		 
		       <a style="color:SlateBlu;" href="home.php">  Home |  </a> 
		       <a style="color:SlateBlu;" href="login.php">  Login |  </a>  
		       <a style="color:SlateBlu;" href="registration.php">  Registration </a> 
		 
		  
		   </h3>
		   
		  <hr>
		  
		</div> 

	    <div>
	    	<legend>

		   <p> <h1 align="left" > Welcome to <sub style="color:green" > X <sup style="color:black">Company </sub> </p> <br> <br>
		   
		     <hr>
	      </div>
		   
		   <div align="center">
		   
		   <h4 > <span style="color: rgb(140, 140, 140);"> Copyright ©  <?php echo date(2017);?> </span> </h4>
		   </legend>
		   </div>
		   </fieldset>
	 </body>
</html>