<?php
    $header="Welcome to my PHP page";
    $space=" ";
    $myString1="Mickey".$space."Mouse";
    $myString2="Mickey $space Mouse";
    $myString3="Mickey{$space}Mouse"; 

    $animalType = ["CAT", "DOG", "CHICKEN"];
    $animalType[] = "BEAR";
    $animalType[6] = "FERRET"; //array number 6 before sort
    sort($animalType); //after sort become array number 4
    
    //conditional statement

    if (isset($_GET['lat'])) {
        $lat = $_GET['lat'];
    } else {
        $lat = 'N/A';
    }

    if (isset($_GET['long'])) {
        $long = $_GET['long'];
    } else {
        $long = 'N/A';
    }

    if (isset($_GET['alt'])) {
        $alt = $_GET['alt'];
    } else {
        $alt = 'N/A';
    }
    //if isset function return true or false depending on whether the variable that you pass it has been assigned  a value or not, in this case we pass it the get var within index of lat , and assign the var to $lat , else $lat = N/A 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   <h1><?php echo $header ?></h1>
   <h4><?php echo $myString1 ?></h4>
   <h4><?php echo $myString2 ?></h4>
   <h4><?php echo $myString3 ?></h4> 
   <hr>
   <h4><?php echo $animalType[0] ?></h4>
   <h4><?php echo $animalType[1] ?></h4>
   <h4><?php echo $animalType[2] ?></h4>
   <h4><?php echo $animalType[3] ?></h4>
   <h4><?php echo $animalType[4] ?></h4>
   <hr>
<!--
   <h4>Latitude: <?php //echo $_GET['lat']; ?></h4>
   <h4>Longitude: <?php //echo $_GET['long']; ?></h4>
   <h4>Altitude: <?php //echo $_GET['alt']; ?></h4>
-->
<!--
   <h4>Latitude: <?php //echo $lat; ?></h4>
   <h4>Longitude: <?php //echo $long; ?></h4>
   <h4>Altitude: <?php //echo $alt; ?></h4>
-->
<?php
    foreach ($_GET as $key=>$val) {
        echo "Key: {$key} Value: {$val}<br>";
    }
    
?>
<form method="post" action="process_lat.php">
    Latitude: <input type="text" name="lat"><br>
    Longitude: <input type="text" name="long"><br>
    Altitude: <input type="text" name="alt"><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>














