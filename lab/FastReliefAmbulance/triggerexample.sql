--@author: Ayam
CREATE LANGUAGE plpgsql;;

CREATE FUNCTION "tracking".insertLatest() RETURNS trigger AS '
BEGIN
  IF tg_op = ''INSERT'' THEN
     DELETE FROM "tracking".coordinates where device_id = new.device_id;
     INSERT INTO "tracking".coordinates(id,device_id,longitude,latitude, speed)
     VALUES (new.id,new.device_id, new.longitude,new.latitude, new.speed);
     RETURN new;
  END IF;
  IF tg_op = ''UPDATE'' THEN
     DELETE FROM "tracking".coordinates where device_id = new.device_id;
     INSERT INTO "tracking".coordinates(id,device_id,longitude,latitude, speed)
     VALUES (new.id,new.device_id, new.longitude,new.latitude, new.speed);
     RETURN new;
  END IF;
  COMMIT;
END
' LANGUAGE plpgsql;;

CREATE TRIGGER addLatestLoc AFTER INSERT OR DELETE OR UPDATE
        ON "tracking".location FOR each ROW
        EXECUTE PROCEDURE "tracking".insertLatest();
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
--SELECT pg_size_pretty(pg_relation_size('"tracking".coordinates')) INTO delta_time_key;
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
--SELECT pg_size_pretty(pg_total_relation_size('"tracking"."coordinates"'));
--SELECT pg_relation_size('"tracking".coordinates')
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
do
$$
declare r record;

begin

    for r in SELECT pg_relation_size('"tracking".coordinates') loop
        raise notice '%', r.pg_relation_size;
    end loop;

end$$

-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

CREATE FUNCTION "tracking".tableSizeMonitor() returns trigger AS '
    DECLARE
	
		m record;

	BEGIN


		SELECT pg_relation_size(''"tracking".location'') into m;
		IF m.pg_relation_size >8192  THEN
            TRUNCATE TABLE "tracking".location;
        END IF;
		return new;

	END;
' LANGUAGE plpgsql;

--@author: Ayam
CREATE TRIGGER tableSizeMonitor BEFORE INSERT OR UPDATE ON "tracking".location
    FOR EACH ROW EXECUTE PROCEDURE "tracking".tableSizeMonitor();


------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

do
$$
declare m record;

begin

    --for r in SELECT pg_relation_size('"tracking".coordinates') loop
		SELECT pg_relation_size('"tracking".coordinates') into m;
        raise notice '%', m.pg_relation_size;
    --end loop;

end$$