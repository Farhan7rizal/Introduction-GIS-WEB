<?php
    $sql = "UPDATE coords SET ";
    foreach ($_POST as $key=>$val) {
        $sql .= "{$key} = '{$val}' ";
    }
    $sql .= "WHERE id=13";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
   <h2>Latitude: <?php echo $_POST['lat']; ?></h2><br>
   <h2>Longitude: <?php echo $_POST['long']; ?></h2><br>
   <h2>Altitude: <?php echo $_POST['alt']; ?></h2><br>
    <hr>
    <h2><?php echo $sql; ?></h2>
</body>
</html>