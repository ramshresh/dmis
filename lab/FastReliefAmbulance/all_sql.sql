CREATE SEQUENCE tracking.location_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 3063
  CACHE 1;
ALTER TABLE tracking.location_id_seq OWNER TO "lerhkop";

CREATE SEQUENCE tracking.login_l_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE tracking.login_l_id_seq OWNER TO "lerhkop";
----------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE tracking."location"
(
  id serial NOT NULL,
  device_id character varying(255) NOT NULL,
  latitude character varying(255),
  longitude character varying(255),
  speed character varying(255)
);
ALTER TABLE tracking."location" OWNER TO "lerhkop";

-----------------------------------------------------------------------------------------------------------------------------------

CREATE TABLE tracking.coordinates
(
  id integer,
  device_id character varying(255) NOT NULL,
  longitude character varying(255),
  latitude character varying(255),
  speed character varying(255),
  CONSTRAINT pk_device_id PRIMARY KEY (device_id)
);
ALTER TABLE tracking.coordinates OWNER TO "lerhkop";
---------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE tracking.drivers
(
  "Firstname" character varying(255) NOT NULL,
  "Lastname" character varying(255) NOT NULL,
  "Address" character varying(255) NOT NULL,
  "Phonr" character varying(255) NOT NULL,
  "IMEI" character varying(255) NOT NULL,
  "Gender" character varying(20) NOT NULL,
  "Ambulance_Number" character varying(25) NOT NULL
);
ALTER TABLE tracking.drivers OWNER TO "lerhkop";
-----------------------------------------------------------------------------------------------------------------------------------------------
-- DROP TABLE tracking."A_Status";

CREATE TABLE tracking."A_Status"
(
  "IMEI" character varying(25),
  status character varying(10)
);
ALTER TABLE tracking."A_Status" OWNER TO "lerhkop";

------------------------------------------------------------------------------------------------------------------------------------------------
CREATE TABLE tracking."login"
(
  l_id serial NOT NULL
);
ALTER TABLE tracking."login" OWNER TO "lerhkop";

CREATE TABLE tracking."user"
(
  username character varying(255) NOT NULL,
  "password" character varying(255) NOT NULL
);
ALTER TABLE tracking."user" OWNER TO "lerhkop";

-----------------------------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------------------
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
ALTER FUNCTION tracking.insertlatest() OWNER TO "lerhkop";


CREATE TRIGGER addLatestLoc AFTER INSERT OR DELETE OR UPDATE
        ON "tracking".location FOR each ROW
        EXECUTE PROCEDURE "tracking".insertLatest();

--------------------------------------------------------------------------------------------------------------------------------------------------
-------------------------------------------------------------------------------------------------------------------------------------------------