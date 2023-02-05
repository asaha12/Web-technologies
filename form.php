<!DOCTYPE html>
<html>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname">
  <p>Please select your age:</p>
  <input type="radio" id="age1" name="age" value="30">
  <label for="age1">0 - 30</label><br>
  <input type="radio" id="age2" name="age" value="60">
  <label for="age2">31 - 60</label><br>  
  <input type="radio" id="age3" name="age" value="100">
  <label for="age3">61 - 100</label><br><br>

  <p>Please select your education:</p>
  <input type="checkbox" id="education1" name="education1" value="SSC">
  <label for="education1"> SSC</label><br>
  <input type="checkbox" id="education2" name="education2" value="HSC">
  <label for="education2"> HSC</label><br>
  <input type="checkbox" id="education3" name="education3" value="PSC">
  <label for="education3"> PSC</label><br><br>

  <label for="area">Choose your area:</label>

<select name="area" id="area">
  <option value="volvo">Alamdanga</option>
  <option value="saab">Chuadanga</option>
  <option value="mercedes">Bogra</option>
  <option value="audi">Dhaka</option>
  <option value="audi">Jashore</option>
</select>
<br>
Tell about yourself: <input type="text" name="paragraph">
  <br>
  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = htmlspecialchars($_REQUEST['fname']);
    if (empty($name)) {
        echo "Name is empty";
    } else {
        echo $name;
    }

    $education1 = htmlspecialchars($_REQUEST['education1']);
    if (isset($education)) {
        echo "Name is not set";
    } else {
        echo $education1;
    }

    $education2 = htmlspecialchars($_REQUEST['education2']);
    if (isset($education2)) {
        echo "Name is not set";
    } else {
        echo $education2;
    }
    
    $education3 = htmlspecialchars($_REQUEST['education3']);
    if (isset($education3)) {
        echo "Name is not set";
    } else {
        echo $education3;
    }
    $area = htmlspecialchars($_REQUEST['area']);
    if (isset($area)) {
        echo "Area is not set";
    } else {
        echo $area;
    }

    $input = htmlspecialchars($_REQUEST['paragraph']);
    if (empty($input)) {
        echo "Input is empty";
    } else {
        echo $input;
    }


}
?>

</body>
</html>