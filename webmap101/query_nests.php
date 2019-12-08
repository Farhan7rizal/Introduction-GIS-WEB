<?php
//    foreach ($_POST as $key=>$val) {
//        echo "Key: {$key}-{$val}<br>";
//    }

    if (isset($_POST['submit'])){
        $df = $_POST['date_found'];
        $cs = $_POST['current_status'];
        $db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;','postgres','Farhan7');
        $sql = $db->prepare("SELECT nest_id, date_found,last_date_inspected, current_status,ST_AsGeoJSON(ST_Transform(geom,4326),5) FROM raptor_nests WHERE date_found> :df AND current_status = :cs");
        $params = ["df"=>$df, "cs"=>$cs]; //replace place holder ':'
        $sql->execute($params); //we execute this sql statement by calling the execute method of the PDO statement object ($sql) and passed the paremeter array ($params)
        
        
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <form action="" method="post">
            <input type="date" name="date_found" value="2015-01-01">
            <br>
            <select name="current_status" id="">
                <option value="ACTIVE">Active Nest</option>
                <option value="INACTIVE NEST">Inactive Nest</option>
                <option value="FLEDGED NEST">Fledged Nest</option>
            </select>
            <br>
            <input type="submit" name="submit" value="Submit">
            <hr>
            <?php
                if(isset($_POST['submit'])) {
                    echo "<table class='table table-striped'>";
                        echo "<tr>
                            <th>Nest</th>
                            <th>Date Found</th>
                            <th>Last Date Inspected</th>                            
                            <th>Status</th>
                            <th>Geometry</th>
                            </tr>";
                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                            foreach($row as $field=>$value) {
                            echo "<td>{$value}
                                </td>";
                                }
                                echo "
                                </tr>";   
        }
        echo "<table/>";
                }
            ?>
            
        </form>
    </body>
</html>