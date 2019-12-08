<?php
    //if (isset($_POST['submit'])){ //this is used in form based, but it is never do anything with ajax
        //$df = $_POST['date_found'];
        $cs = $_POST['current_status'];
        $db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;','postgres','Farhan7');
        $sql = $db->prepare("SELECT ST_AsGeoJSON(ST_Transform(geom,4326),5)::json as geojson, nest_id, date_found,last_date_inspected, current_status FROM raptor_nests WHERE current_status = :cs");
        $params = ["cs"=>$cs]; //replace place holder ':'
        $sql->execute($params); //we execute this sql statement by calling the execute method of the PDO statement object ($sql) and passed the paremeter array ($params)
# Build GeoJSON feature collection array
$geojson = array(
   'type'      => 'FeatureCollection',
   'features'  => array()
);
# Loop through rows to build feature arrays
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    $properties = $row;
    # Remove geojson and geometry fields from properties
    unset($properties['geojson']);
    unset($properties['geom']);
    $feature = array(
         'type' => 'Feature',
         'geometry' => json_decode($row['geojson'], true),
         'properties' => $properties
    );
    # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);
}
//header('Content-type: application/json');
echo json_encode($geojson, JSON_NUMERIC_CHECK);
       
?>