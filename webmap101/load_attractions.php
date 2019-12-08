<?php
        
    $strQuery = "SELECT id, name, image, web,category, ST_AsGeoJSON(ST_Transform(geom,4326),5)::json as geojson FROM cdmx_attractions ORDER BY name";
    if (isset($_POST['filter'])) {
        if ($_POST['filter']!='All'){
            $strQuery = "SELECT id, name, image, web,category, ST_AsGeoJSON(ST_Transform(geom,4326),5)::json as geojson FROM cdmx_attractions WHERE category='{$_POST['filter']}'ORDER BY name";
        }
    }

    $db = new PDO('pgsql:host=localhost;port=5432;dbname=webmap101;','postgres','Farhan7');
        $sql = $db->query($strQuery);

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