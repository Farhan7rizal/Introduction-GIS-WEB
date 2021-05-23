SELECT id, name, category
FROM cdmx_attractions
WHERE ST_DWithin(geom, ST_MakePoint(127.0492,37.51572)
::geography, 10000);

SELECT a.id AS holdingid, a.pointgeom, b.buffergeom
FROM (SELECT id, ST_SetSRID(ST_MakePoint(127.21373, 37.62266), 4326) AS pointgeom
	FROM cdmx_attractions) AS a, (SELECT ST_Transform((ST_Buffer((ST_Transform((ST_SetSRID(ST_MakePoint(127.21373, 37.62266), 4326)),32734)),20000)),4326) AS buffergeom) AS b
WHERE ST_Intersects(a.pointgeom, b.buffergeom)


