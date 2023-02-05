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
  <option value="alamdanga">Alamdanga</option>
  <option value="chuadanga">Chuadanga</option>
  <option value="bogra">Bogra</option>
  <option value="dhaka">Dhaka</option>
  <option value="jashore">Jashore</option>
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
    echo "<br>";

    $education1 = htmlspecialchars($_POST['education1']);
    if (isset($education1)) {
        echo $education1 . "<br>";
    } else {
        echo "Education 1 is not set <br>";
    }

    $education2 = htmlspecialchars($_POST['education2']);
    if (isset($education2)) {
        echo $education2 . "<br>";
    } else {
        echo "Education 2 is not set <br>";
    }

    $education3 = htmlspecialchars($_POST['education3']);
    if (isset($education3)) {
        echo $education3 . "<br>";
    } else {
        echo "Education 3 is not set <br>";
    }

    if (isset($_POST["area"])) {
        $area = htmlspecialchars($_POST["area"]);
        echo "Area: " . $area . "<br>";
    }  else {
        echo "Area is not set <br>";
    }


    $paragraph = htmlspecialchars($_POST['paragraph']);
    if (empty($paragraph)) {
        echo "Input is empty";
    } else {
        echo $paragraph;
    }
    echo "<br>";

}
