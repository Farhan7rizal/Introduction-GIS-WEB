<?php

//if (isset($_POST['id']) && is_numeric($_POST['id'])) {
//    $id = $_POST['id'];
//} else {
//    $id = "-99999";
//}

if(isset($_POST['id'])){
        $id=$_POST['id'];
    } else {
        $id = "N/A";
    }

    $db = new PDO('pgsql:host=localhost;port=5432;dbname=webmap101;','postgres','Farhan7');
    $sql = $db->prepare("DELETE FROM cdmx_attractions WHERE id=:id");
    $params = ["id"=>$id];

    if ($sql->execute($params)) {
        echo "{$id} Attraction succesfully deleted";
    } else {
        echo var_dump($sql->errorInfo());
    };



?>