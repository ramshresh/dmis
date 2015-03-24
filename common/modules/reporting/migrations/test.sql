WITH within AS (SELECT ST_Within(
                                geom
                                ,(select ST_GeomFromText('POLYGON((-180 -90,-180 90,180 90,180 -90,-180 -90))',4326))
	))
SELECT * FROM "tracking".tracking_driver;