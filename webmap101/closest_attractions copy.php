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

while ($row = $sql1->fetch(PDO::FETCH_ASSOC)) {
    //echo "<tr>";
    foreach ($row as $field=>$value) {

             $value; 
    }
    
    //echo $value;
    // $long = json_encode($value);
    $long = json_decode($value);
    // echo $long ;
    //echo json_decode($value).",";
}
echo "<br>";
$sql2 = $db->prepare("SELECT ST_Y(geom) as latitude FROM cdmx_attractions");
// $sql = $db->prepare("SELECT id, name, category,ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(ST_X(geom), ST_Y(geom))::geography, 100000)");

// $longitude2 = ['items' => ['127.0492', '127.1492','127.4492' ]];
// $latitude2 = ['items' => ['37.51572', '37.61572','37.71572' ]];
//$params = ["lng"=>$longitude, "lat"=>$latitude];
//  $params = ["lng"=>['127.0492','127.1492'], "lat"=>['37.51572','37.11572']];

$sql2->execute();

while ($row = $sql2->fetch(PDO::FETCH_ASSOC)) {
    //echo "<tr>";
    foreach ($row as $field=>$value) {

             $value; 
    }
    
    //echo $value;
    // $lati = json_encode($value);
    $lati = json_decode($value);
    // echo $lati;
    //echo json_decode($value).",";
}
echo "<br>";
$sql3 = $db->prepare("SELECT id, name, category,ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(:lng, :lat)::geography, 100000)");
// $sql = $db->prepare("SELECT id, name, category,ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(ST_X(geom), ST_Y(geom))::geography, 100000)");

// $longitude2 = ['lng' => ['134.32413', '127.1492','127.4492' ]];
// $latitude2 = ['lat' => ['44.22946', '37.61572','37.71572' ]];
// $longitude2 = ["lng" => 134.32413];
// $latitude2 = ["lng" => 44.22946];
// $params = [$longitude2, $latitude2];
 $params = ["lng"=>$longitude, "lat"=>$latitude];
// $params = ["lng"=>$long, "lat"=>$lati];
// $params = ["lng"=>134.32413, 142.26106, "lat"=>44.22946, 44.99588];

// for ($x = 0; $x <= 30; $x++) {
//     // $params = ["lng"=>$long, "lat"=>$lati];
//     // echo implode ($params);
//    echo $long. "<br>";
// }

echo $long;

// foreach($aso_arr as $side=>$direc) { 
//     echo $side . " => " . $direc . "\n";  
// } 
  

$sql3->execute($params);

while ($row = $sql3->fetch(PDO::FETCH_ASSOC)) {
    //echo "<tr>";
    foreach ($row as $field=>$value) {
        if ($field=="id"){

            //  echo $value . "<br>"; 
             
        } 
    }
    
    
    // echo json_encode($value);
    //echo json_decode($value);
}

?>




























