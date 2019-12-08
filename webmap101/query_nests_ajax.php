<?php
    //if (isset($_POST['submit'])){ //this is used in form based, but it is never do anything with ajax
        //$df = $_POST['date_found'];
        $cs = $_POST['current_status'];
        $db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;','postgres','Farhan7');
        $sql = $db->prepare("SELECT ST_AsGeoJSON(ST_Transform(geom,4326),5)::json as geom, nest_id, date_found,last_date_inspected, current_status FROM raptor_nests WHERE current_status = :cs");
        $params = ["cs"=>$cs]; //replace place holder ':'
        $sql->execute($params); //we execute this sql statement by calling the execute method of the PDO statement object ($sql) and passed the paremeter array ($params)
        
//    echo "<table class='table table-striped'>";
//    echo "<tr>
//        <th>Nest</th>
//        <th>Date Found</th>
//        <th>Last Date Inspected</th>                            
//        <th>Status</th>
//        <th>Geometry</th>
//        </tr>";
    $features=[];
    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
//        echo "<tr>";
//        foreach($row as $field=>$value) {
//                echo "<td>{$value}</td>";
//            }
//            echo "</tr>";  
        $feature=['type'=>'Feature'];
        //$row['geom']=json_decode($row['geom']);
        $row['geometry']=json_decode($row['geom']); //instead bring this geom object back to the row , we create a new element in a feature array 
        unset($row['geom']);//delete the old geometry element out of the row array 
        $feature['properties']=$row;//new element in a feature array with key of properties, and set back equal to the row array and that we remove the geom key
        array_push($features, $feature);
        
        
}
//    echo "<table/>";

$featureCollection=['type'=>'FeatureCollection','feature'=>$features];
echo json_encode($featureCollection);
?>
           
           
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
             
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
           
            
       