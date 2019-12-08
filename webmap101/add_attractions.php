 <?php
    if(isset($_POST['name'])){
        $name=$_POST['name'];
    } else {
        $name = "N/A";
    }
    if(isset($_POST['image'])){
        $image=$_POST['image'];
    } else {
        $image = "N/A";
    }
    if(isset($_POST['web'])){
        $web=$_POST['web'];
    } else {
        $web = "N/A";
    }
    if(isset($_POST['category'])){
        $category = $_POST['category'];
    } else {
        $category = "N/A";
    }
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
    $sql = $db->prepare("INSERT INTO cdmx_attractions (id,name, image, web,category, geom) VALUES (10,:nm, :im, :wb, :ct, ST_SetSRID(ST_MakePoint(:lng, :lat), 4326))");

    $params = ["nm"=>$name, "im"=>$image, "wb"=>$web, "ct"=>$category, "lng"=>$longitude, "lat"=>$latitude];

    if($sql->execute($params)) {
        echo "{$name} succesfully added";
    } else {
        echo var_dump($sql->errorInfo());
        echo "gagal";
    };

?>