 <?php

    // if(isset($_POST['latitude']) && is_numeric($_POST['latitude'])){
    //     $latitude=$_POST['latitude'];
    // } else {
    //     $latitude = "-90";
    // }
    // if(isset($_POST['longitude']) && is_numeric($_POST['longitude'])){
    //     $longitude=$_POST['longitude'];
    // } else {
    //     $longitude = "-90";
    // }
    
    // $db = new PDO('pgsql:host=localhost;port=5432;dbname=webmap101;','postgres','Farhan7');
    // $sql = $db->prepare("SELECT ST_Distance_Sphere(ST_SetSRID(ST_MakePoint(:lng, :lat), 4326), geom)/1000 as dist, name, category,image FROM cdmx_attractions ORDER BY dist LIMIT 5");

    // $params = ["lng"=>$longitude, "lat"=>$latitude];
    // $sql->execute($params);
    // echo "<table class='table table-striped'>";
    // echo "<tr><th>Distance (km)</th><th>Name</th><th>Category</th><th>Image</th></tr>";
    // while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    //     echo "<tr>";
    //     foreach ($row as $field=>$value) {
    //         if ($field=="image"){
    //             echo "<td><img src='img/{$value}' width='50px'></td>";
            
    //         } elseif ($field=="dist") {
    //             echo "<td>".number_format($value, 3)."</td>";
    //         } else {
    //             echo "<td>{$value}</td>";
    //         }
    //     }
        
    //     echo "</tr>";
    // }
    // echo "</table>";
?>
 <?php

if(isset($_POST['latitude']) && is_numeric($_POST['latitude'])){
    $latitude=$_POST['latitude'];
} else {
    $latitude = "-90";
}
if(isset($_POST['longitude']) && is_numeric($_POST['longitude'])){
    $longitude=$_POST['longitude'];
} else {
    $longitude = "-90";
}

$db = new PDO('pgsql:host=localhost;port=5432;dbname=webmap101;','postgres','Farhan7');

$sql1 = $db->prepare("SELECT ST_X(geom) as longitude FROM cdmx_attractions");
// $sql = $db->prepare("SELECT id, name, category,ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(ST_X(geom), ST_Y(geom))::geography, 100000)");

// $longitude2 = ['items' => ['127.0492', '127.1492','127.4492' ]];
// $latitude2 = ['items' => ['37.51572', '37.61572','37.71572' ]];
//$params = ["lng"=>$longitude, "lat"=>$latitude];
//  $params = ["lng"=>['127.0492','127.1492'], "lat"=>['37.51572','37.11572']];

$sql1->execute();


echo "<br>";
$sql2 = $db->prepare("SELECT ST_Y(geom) as latitude FROM cdmx_attractions");
// $sql = $db->prepare("SELECT id, name, category,ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(ST_X(geom), ST_Y(geom))::geography, 100000)");

// $longitude2 = ['items' => ['127.0492', '127.1492','127.4492' ]];
// $latitude2 = ['items' => ['37.51572', '37.61572','37.71572' ]];
//$params = ["lng"=>$longitude, "lat"=>$latitude];
//  $params = ["lng"=>['127.0492','127.1492'], "lat"=>['37.51572','37.11572']];

$sql2->execute();

echo "<br>";
$sql3 = $db->prepare("SELECT id, name, category,ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(:lng, :lat)::geography, 100000)");

$sql4 = $db->prepare("SELECT id, name, category, ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions");
$sql4->execute();
while ($row = $sql4->fetch(PDO::FETCH_ASSOC)) {
    
    foreach ($row as $field1=>$value1) {
        if ($field1=="longitude"){

            //  echo $value1 . "<br>"; 
            // $long = json_encode($value1);
            $long = json_decode($value1);
            // echo $long . "<br>" ;
        } 
        
    }
    
    foreach ($row as $field2=>$value2) {
        if ($field2=="latitude"){

            //  echo $value2 . "<br>"; 
            // $lati = json_encode($value2). ",";
            $lati = json_decode($value2);
            //  echo $lati;
        } 

    
    }
    foreach ($row as $field3=>$value3) {
        if ($field3=="id"){

            //  echo $value3 . "<br>"; 
            // $id = json_encode($value3). ",";
            $id = json_decode($value3);
            //  echo "_".$id."_" ;
        } 

    
    }
    
$longitude = [$long];
$latitude = [$lati];

foreach ($longitude as $lng )  {
    $lng ."<br>";

    foreach ($latitude as $lat )  {
        $lat ."<br>";
        
    }
    $params = ["lng"=>$lng, "lat"=>$lat];
    
$sql3->execute($params);
echo "<br>";
while ($row = $sql3->fetch(PDO::FETCH_ASSOC)) {
    
    foreach ($row as $field=>$value) {
        if ($field=="id"){
        json_encode($value);
        // json_decode($value);    
             echo $value ." "; 
             
        } 
    }
    
    
    
}
}
  

}


?>




























