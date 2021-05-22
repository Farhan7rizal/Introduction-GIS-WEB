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

    if (isset($_POST['latitude']) && is_numeric($_POST['latitude'])) {
        $latitude = $_POST['latitude'];
    } else {
        $latitude = "-90";
    }
    if (isset($_POST['longitude']) && is_numeric($_POST['longitude'])) {
        $longitude = $_POST['longitude'];
    } else {
        $longitude = "-90";
    }

    $db = new PDO('pgsql:host=localhost;port=5432;dbname=webmap101;', 'postgres', 'Farhan7');

    $sql1 = $db->prepare("SELECT ST_X(geom) as longitude FROM cdmx_attractions");
    // $sql = $db->prepare("SELECT id, name, category,ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(ST_X(geom), ST_Y(geom))::geography, 100000)");

    // $longitude2 = ['items' => ['127.0492', '127.1492','127.4492' ]];
    // $latitude2 = ['items' => ['37.51572', '37.61572','37.71572' ]];
    //$params = ["lng"=>$longitude, "lat"=>$latitude];
    //  $params = ["lng"=>['127.0492','127.1492'], "lat"=>['37.51572','37.11572']];

    $sql1->execute();


    // echo "<br>";
    $sql2 = $db->prepare("SELECT ST_Y(geom) as latitude FROM cdmx_attractions");
    // $sql = $db->prepare("SELECT id, name, category,ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(ST_X(geom), ST_Y(geom))::geography, 100000)");

    // $longitude2 = ['items' => ['127.0492', '127.1492','127.4492' ]];
    // $latitude2 = ['items' => ['37.51572', '37.61572','37.71572' ]];
    //$params = ["lng"=>$longitude, "lat"=>$latitude];
    //  $params = ["lng"=>['127.0492','127.1492'], "lat"=>['37.51572','37.11572']];

    $sql2->execute();

    // echo "<br>";
    $sql3_2 = $db->prepare("SELECT id, name, category,ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(:lng, :lat)::geography, 100000)");

    $sql3 = $db->prepare("SELECT id, name, category,ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(:lng, :lat)::geography, 100000 AND category = 'Park')");

    $sql4 = $db->prepare("SELECT id, name, category, ST_X(geom) as longitude, ST_Y(geom) as latitude FROM cdmx_attractions WHERE category = 'Place'");
    $sql4->execute();

    $sqlPark = $db->prepare("SELECT count(category)FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(:lng, :lat)::geography, 100000) AND category = 'Park'");
    $sqlPlace = $db->prepare("SELECT count(category)FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(:lng, :lat)::geography, 100000) AND category = 'Place'");
    $sqlOther = $db->prepare("SELECT count(category)FROM cdmx_attractions WHERE ST_DWithin(geom, ST_MakePoint(:lng, :lat)::geography, 100000) AND category = 'Other'");

    /*
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
    
$sql3_2->execute($params);
$sqlPlace->execute($params);
echo "<br>";
while ($row = $sql3_2->fetch(PDO::FETCH_ASSOC)) {
    
    foreach ($row as $field=>$value) {
        if ($field=="id"){
        json_encode($value);
        // json_decode($value);    
             $string = $value .","; 
            echo $string;
            // echo substr($string, 0, -1);
            
        } 
        // echo $value ." ";
        
             
    }
    // 
    // echo $string = rtrim($string, ",");
    
}

}
  

}
*/
    // /*
    $nilai = [];
    while ($row = $sql4->fetch(PDO::FETCH_ASSOC)) {

        foreach ($row as $field1 => $value1) {
            if ($field1 == "longitude") {

                $long = json_decode($value1);
            }
        }

        foreach ($row as $field2 => $value2) {
            if ($field2 == "latitude") {

                $lati = json_decode($value2);
            }
        }



        $longitude = [$long];
        $latitude = [$lati];

        foreach ($longitude as $lng) {
            $lng . "<br>";

            foreach ($latitude as $lat) {
                $lat . "<br>";
            }
            $params = ["lng" => $lng, "lat" => $lat];

            $sqlPlace->execute($params);
            $sqlPark->execute($params);
            $sqlOther->execute($params);
            echo "<br>";
            // while ($place = $sqlPlace->fetchAll()) {

            $nilai1 = [];
            foreach ($sqlPlace as $key => $value) {
                if ($value !== false) {
                    //  echo implode(array_values($value));
                    $nilai1 = $value['count'];
                    //  print_r ($value['count']);
                    // print_r($nilai1);
                } else {
                    // $value = 2
                    echo 'kosong';
                }
                //  echo ",";
                $nilai2 = [];
            }
            foreach ($sqlPark as $key => $value) {
                if ($value !== false) {
                    $nilai2 = $value['count'];
                    //  print_r ($value['count']);
                    // print_r($nilai2);
                } else {
                    // $value = 2
                    echo 'kosong';
                }
            }
            //    echo ",";
            $nilai3 = [];
            foreach ($sqlOther as $key => $value) {
                if ($value !== false) {
                    $nilai3 = $value['count'];
                    //  print_r ($value['count']);
                    // print_r($nilai3);
                } else {
                    // $value = 2
                    echo 'kosong';
                }
            }
        }
        $nilai = array($nilai1 . "," . $nilai2 . "," . $nilai3);
        // $nilaix = $nilai;
        // $nilaiZ = [$nilai.""];
        // echo implode($nilai);
        // print_r($nilai);
    }
    // }
    // */


    // $place = $sqlPlace->fetchAll();
    //          foreach ($place as $value) {
    //          if ($value !== false) {
    //              echo implode($value);
    //          } else {
    //             // $value = 2
    //             echo 'kosong';
    //          }
    //         }

    ?>

<?php
//------------------------------------------------------------------------------------
//?Coba TOPSIS without database, no iteration maybe
echo "<br>";
// $alternatif = array(); //array("Galaxy", "iPhone", "BB", "Lumia");
$alternatif = array("kos1", "kos2", "kos3");
//?Nama Kos

// $queryalternatif = mysql_query("SELECT * FROM pemilik ORDER BY id_pemilik");
// $i=0;
// while ($dataalternatif = mysql_fetch_array($queryalternatif))
// {
//     $alternatif[$i] = $dataalternatif['nama_kos'];
//     $i++;
// } 
//? While loop pencarian nama kos

// $kriteria = array(); //array("Harga", "Kualitas", "Fitur", "Populer", "Purna Jual", "Keawetan");
$kriteria = array("Harga", "Kualitas", "Fitur", "asd", "sfsd");
//? Kriteria hanya banyaknya tiap fasilitas 

// $costbenefit = array(); //array("cost", "benefit", "benefit", "benefit", "benefit", "benefit");
$costbenefit = array("benefit", "benefit", "cost", "benefit", "cost");
//? Hanya benefit

// $kepentingan = array(); //array(4, 5, 4, 3, 3, 2);
$kepentingan = array(5, 4, 4, 3, 4);
//?Sudah didapat dari Analisis SIG

// $querykriteria = mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
// $i=0;
// while ($datakriteria = mysql_fetch_array($querykriteria))
// {
//     $kriteria[$i] = $datakriteria['nama_kriteria'];
//     $costbenefit[$i] = $datakriteria['atribut'];
//     $kepentingan[$i] = @$_POST['kepentingan'.$datakriteria['id_kriteria']]; //$datakriteria['kepentingan'];
//     $i++;
// }
//? While loop untuk mendapatkan kepentingan, tapi Sudah didapat dari Analisis SIG


$alternatifkriteria = array(
    array(4, 2000, 5000, 3, 1),
    array(2, 5000, 2000, 4, 4),
    array(3, 4000, 3000, 4, 3)

);
/* array(
                            array(3, 2, 3, 2, 2, 2),              
                            array(4500, 90, 10, 60, 2500, 48),                                             
                            array(4000, 80, 9, 90, 2000, 48),                                                                           
                            array(4000, 70, 8, 50, 1500, 60)
                          ); */
//? Array dalam array

// $queryalternatif = mysql_query("SELECT * FROM pemilik ORDER BY id_pemilik");
// $i=0;
// while ($dataalternatif = mysql_fetch_array($queryalternatif))
// {
//     $querykriteria = mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria");
//     $j=0;
//     while ($datakriteria = mysql_fetch_array($querykriteria))
//     {
//         $queryalternatifkriteria = mysql_query("SELECT * FROM analisa WHERE id_pemilik = '$dataalternatif[id_pemilik]' AND id_kriteria = '$datakriteria[id_kriteria]'");
//         $dataalternatifkriteria = mysql_fetch_array($queryalternatifkriteria);

//         $alternatifkriteria[$i][$j] = $dataalternatifkriteria['nilainya'];
//         $j++;
//     }
//     $i++;
// }

//? While loop untuk mendapatkan semua jumlah fasilitas dari semua kos, PENGAMBILAN dari database tabel analisis, mungkin kalo kasus ini dari analisis SIG diatas ya?

$pembagi = array();

for ($i = 0; $i < count($kriteria); $i++)
//? dihitung dari jumlah kriteria, dalam kasus ini yaitu nilai1, nilai2 dst
{
    $pembagi[$i] = 0;
    for ($j = 0; $j < count($alternatif); $j++)
    //? dihitung dari tiap kos yang ada
    {
        $pembagi[$i] = $pembagi[$i] + ($alternatifkriteria[$j][$i] * $alternatifkriteria[$j][$i]);
    }
    $pembagi[$i] = sqrt($pembagi[$i]);
    // echo implode($pembagi);
    // print_r($pembagi);
}
// echo implode($pembagi);
// print_r($pembagi);


$normalisasi = array();

for ($i = 0; $i < count($alternatif); $i++) {
    for ($j = 0; $j < count($kriteria); $j++) {
        $normalisasi[$i][$j] = $alternatifkriteria[$i][$j] / $pembagi[$j];
    }
}

// print_r($normalisasi);

$terbobot = array();

for ($i = 0; $i < count($alternatif); $i++) {
    for ($j = 0; $j < count($kriteria); $j++) {
        $terbobot[$i][$j] = $normalisasi[$i][$j] * $kepentingan[$j];
    }
}

// print_r($terbobot);

$aplus = array();

for ($i = 0; $i < count($kriteria); $i++) {
    if ($costbenefit[$i] == 'cost') {
        for ($j = 0; $j < count($alternatif); $j++) {
            if ($j == 0) {
                $aplus[$i] = $terbobot[$j][$i];
            } else {
                if ($aplus[$i] > $terbobot[$j][$i]) {
                    $aplus[$i] = $terbobot[$j][$i];
                }
            }
        }
    } else {
        for ($j = 0; $j < count($alternatif); $j++) {
            if ($j == 0) {
                $aplus[$i] = $terbobot[$j][$i];
            } else {
                if ($aplus[$i] < $terbobot[$j][$i]) {
                    $aplus[$i] = $terbobot[$j][$i];
                }
            }
        }
    }
}

print_r($aplus);

$amin = array();

for ($i = 0; $i < count($kriteria); $i++) {
    if ($costbenefit[$i] == 'cost') {
        for ($j = 0; $j < count($alternatif); $j++) {
            if ($j == 0) {
                $amin[$i] = $terbobot[$j][$i];
            } else {
                if ($amin[$i] < $terbobot[$j][$i]) {
                    $amin[$i] = $terbobot[$j][$i];
                }
            }
        }
    } else {
        for ($j = 0; $j < count($alternatif); $j++) {
            if ($j == 0) {
                $amin[$i] = $terbobot[$j][$i];
            } else {
                if ($amin[$i] > $terbobot[$j][$i]) {
                    $amin[$i] = $terbobot[$j][$i];
                }
            }
        }
    }
}

print_r($amin);

$dplus = array();

for ($i = 0; $i < count($alternatif); $i++) {
    $dplus[$i] = 0;
    for ($j = 0; $j < count($kriteria); $j++) {
        $dplus[$i] = $dplus[$i] + (($aplus[$j] - $terbobot[$i][$j]) * ($aplus[$j] - $terbobot[$i][$j]));
    }
    $dplus[$i] = sqrt($dplus[$i]);
}

print_r($dplus);

$dmin = array();

for ($i = 0; $i < count($alternatif); $i++) {
    $dmin[$i] = 0;
    for ($j = 0; $j < count($kriteria); $j++) {
        $dmin[$i] = $dmin[$i] + (($terbobot[$i][$j] - $amin[$j]) * ($terbobot[$i][$j] - $amin[$j]));
    }
    $dmin[$i] = sqrt($dmin[$i]);
}

print_r($dmin);

$hasil = array();

for ($i = 0; $i < count($alternatif); $i++) {
    $hasil[$i] = $dmin[$i] / ($dmin[$i] + $dplus[$i]);
}
print_r($hasil);

$alternatifrangking = array();
$hasilrangking = array();

for ($i = 0; $i < count($alternatif); $i++) {
    $hasilrangking[$i] = $hasil[$i];
    $alternatifrangking[$i] = $alternatif[$i];
}
print_r($hasilrangking);
print_r($alternatifrangking);

for ($i = 0; $i < count($alternatif); $i++) {
    for ($j = $i; $j < count($alternatif); $j++) {
        if ($hasilrangking[$j] > $hasilrangking[$i]) {
            $tmphasil = $hasilrangking[$i];
            $tmpalternatif = $alternatifrangking[$i];
            $hasilrangking[$i] = $hasilrangking[$j];
            $alternatifrangking[$i] = $alternatifrangking[$j];
            $hasilrangking[$j] = $tmphasil;
            $alternatifrangking[$j] = $tmpalternatif;
        }
    }
}
print_r($alternatifrangking);

//     $pembagi0 = 0;

//     $alternatifkriteria0 = array(4,2,3);

//     for ($j=0;$j<count($alternatifkriteria0);$j++){
//         $pembagi0 = $pembagi0 + ($alternatifkriteria0[$j] * $alternatifkriteria0[$j]);
//     }        

//     $pembagi0 = sqrt($pembagi0)."___";
//     print_r($pembagi0); 

//     $pembagi1 = array();

//     $alternatifkriteria1 = array(
//         array(2, 1, 1),              
//         array(2, 1, 1),                                             
//         array(2, 1, 0),                                                                           
//         array(2, 0, 6),
//         array(1, 2, 0)

//       );
//     for ($i=0;$i<count($kriteria);$i++){ 
//         $pembagi1[$i] = 0;
//     for ($j=0;$j<count($alternatifkriteria1);$j++){
//         $pembagi1[$i] = $pembagi1[$i] + ($alternatifkriteria1[$j][$i] * $alternatifkriteria1[$j][$i]);
//         // echo "_";
//     }
//     // echo "<br>";
//     $pembagi1[$i] = sqrt($pembagi1[$i]);
//     // echo implode($pembagi1);
//     // print_r($pembagi);
// }
//------------------------------------------------------------------------------------
?>





























