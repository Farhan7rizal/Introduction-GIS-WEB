<?php

if (isset($_POST['name'])) {
    $name = $_POST['name'];
} else {
    $name = "N/A";
}
if (isset($_POST['image'])) {
    $image = $_POST['image'];
} else {
    $image = "N/A";
}
if (isset($_POST['web'])) {
    $web = $_POST['web'];
} else {
    $web="N/A";
}
if (isset($_POST['category'])) {
    $category = $_POST['category'];
} else {
    $category = "N/A";
}
if (isset($_POST['latitude']) && is_numeric($_POST['latitude'])) {
    $latitude = $_POST['latitude'];
} else {
    $latitude="N/A";
}
if (isset($_POST['longitude']) && is_numeric($_POST['longitude'])) {
    $longitude = $_POST['longitude'];
} else {
    $longitude="N/A";
}
//if (isset($_POST['id']) && is_numeric($_POST['id'])) {
//    $id = $_POST['id'];
//} else {
//    $id = "N/A";
//}
if(isset($_POST['id'])){
        $id=$_POST['id'];
    } else {
        $id = "N/A";
    }               

    $db = new PDO('pgsql:host=localhost;port=5432;dbname=webmap101;','postgres','Farhan7');
    $sql = $db->prepare("UPDATE cdmx_attractions SET name=:nm, image=:im, web=:wb, category=:ct, geom = ST_SetSRID(ST_MakePoint(:lng, :lat), 4326) WHERE id=:id");
    
    $params = ["nm"=>$name, "im"=>$image, "wb"=>$web, "ct"=>$category, "lng"=>$longitude, "lat"=>$latitude, "id"=>$id];

    if($sql->execute($params)) {
        echo "{$id} succesfully added";
    } else {
        echo var_dump($sql->errorInfo());
        echo "gagal";
    };

















?>