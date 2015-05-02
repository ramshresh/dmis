<?php

use yii\db\Schema;
use yii\db\Migration;

class m150502_071207_tracking extends Migration
{
    public function safeUp()
    {
        Yii::$app->db->createCommand('CREATE SCHEMA IF NOT EXISTS "tracking";')->execute();
        Yii::$app->db->createCommand($this->createTableDriver())->execute();
        Yii::$app->db->createCommand($this->createTableLocation())->execute();
        Yii::$app->db->createCommand($this->createTableStatus())->execute();
        Yii::$app->db->createCommand($this->createTableCoordinate())->execute();


        Yii::$app->db->createCommand($this->createTrigFnInsertLatest())->execute();
        Yii::$app->db->createCommand($this->createTriggerAddLatestLock())->execute();

        Yii::$app->db->createCommand($this->createViewTrackingDriver())->execute();

    }

    public function safeDown()
    {
        Yii::$app->db->createCommand('DROP SCHEMA IF EXISTS "tracking" CASCADE;')->execute();
        return true;
    }

    public function createTableDriver(){
$sql = <<<SQL
CREATE TABLE "tracking".driver
(
  "Firstname" character varying(255) NOT NULL,
  "Lastname" character varying(255) NOT NULL,
  "Address" character varying(255) NOT NULL,
  "Phonr" character varying(255) NOT NULL,
  "IMEI" character varying(255) NOT NULL,
  "Gender" character varying(20) NOT NULL,
  "Ambulance_Number" character varying(25),
  id bigserial NOT NULL ,
  CONSTRAINT pk_tracking_drivers_id PRIMARY KEY (id),
  CONSTRAINT unique_driver_imei_tracking UNIQUE ("IMEI")
)
SQL;
return $sql;
    }
    public function createTableLocation(){
        $sql = <<<SQL
CREATE TABLE "tracking".location
(
  device_id character varying(255) NOT NULL,
  speed character varying(255),
  id bigserial NOT NULL ,
  latitude double precision,
  longitude double precision,
  CONSTRAINT pk_id_tracking_location PRIMARY KEY (id),
  CONSTRAINT fk_tracking_locations_device_id FOREIGN KEY (device_id)
      REFERENCES "tracking".driver ("IMEI") MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);
SQL;
        return $sql;
    }

    public function createTableStatus(){
        $sql = <<<SQL
CREATE TABLE "tracking".status
(
  "IMEI" character varying(25),
  status character varying(10),
  id bigserial NOT NULL ,
  CONSTRAINT astatus_id_pk PRIMARY KEY (id),
  CONSTRAINT fkey_drivers FOREIGN KEY ("IMEI")
      REFERENCES "tracking".driver ("IMEI") MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);
SQL;
        return $sql;
    }

    public function createTableCoordinate(){
        $sql = <<<SQL
CREATE TABLE "tracking".coordinate
(
  device_id character varying(255) NOT NULL,
  speed character varying(255),
  id bigserial NOT NULL ,
  latitude double precision,
  longitude double precision,
  CONSTRAINT pk_tracking_coordinates_id_pk PRIMARY KEY (id),
  CONSTRAINT fk_coordinates_tracking_fkey FOREIGN KEY (device_id)
      REFERENCES "tracking".driver ("IMEI") MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
SQL;
        return $sql;
    }



    public function createTrigFnInsertLatest(){
        $bodyTag='$BODY$';
        $sql=<<<SQL

CREATE OR REPLACE FUNCTION "tracking".insertlatest()
  RETURNS trigger AS
$bodyTag
BEGIN
  IF tg_op = 'INSERT' THEN
     DELETE FROM "tracking".coordinate where device_id = new.device_id;
     INSERT INTO "tracking".coordinate(id,device_id,longitude,latitude, speed)
     VALUES (new.id,new.device_id, new.longitude,new.latitude, new.speed);
     RETURN new;
  END IF;
  IF tg_op = 'UPDATE' THEN
     DELETE FROM "tracking".coordinate where device_id = new.device_id;
     INSERT INTO "tracking".coordinate(id,device_id,longitude,latitude, speed)
     VALUES (new.id,new.device_id, new.longitude,new.latitude, new.speed);
     RETURN new;
  END IF;
  COMMIT;
END
$bodyTag
  LANGUAGE plpgsql VOLATILE
  COST 100;
SQL;
        return $sql;
    }

    public function createTriggerAddLatestLock(){
        $sql = <<<SQL

CREATE TRIGGER addlatestloc
  AFTER INSERT OR UPDATE OR DELETE
  ON "tracking".location
  FOR EACH ROW
  EXECUTE PROCEDURE "tracking".insertlatest();

SQL;
        return $sql;
    }



    public function createViewTrackingDriver(){
        $sql=<<<SQL
CREATE OR REPLACE VIEW "tracking".tracking_driver AS
 SELECT fra."Firstname",
    fra."Lastname",
    fra."Ambulance_Number",
    fra."Gender",
    fra.longitude,
    fra.latitude,
    fra.status,
    st_setsrid(st_makepoint(fra.longitude, fra.latitude), 4326) AS geom
   FROM ( SELECT coordinate.device_id,
            coordinate.speed,
            coordinate.id,
            coordinate.latitude,
            coordinate.longitude,
            driver."Firstname",
            driver."Lastname",
            driver."Address",
            driver."Phonr",
            driver."IMEI",
            driver."Gender",
            driver."Ambulance_Number",
            driver.id,
            status."IMEI",
            status.status,
            status.id
           FROM "tracking".coordinate
             LEFT JOIN "tracking".driver ON coordinate.device_id::text = driver."IMEI"::text
             LEFT JOIN "tracking".status ON coordinate.device_id::text = status."IMEI"::text
          WHERE (coordinate.device_id::text IN ( SELECT driver_1."IMEI"
                   FROM "tracking".driver driver_1))) fra(device_id, speed, id, latitude, longitude, "Firstname", "Lastname", "Address", "Phonr", "IMEI", "Gender", "Ambulance_Number", id_1, "IMEI_1", status, id_2);

SQL;
return $sql;}
}
