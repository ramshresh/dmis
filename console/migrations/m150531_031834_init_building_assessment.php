<?php

use yii\db\Schema;
use yii\db\Migration;

class m150531_031834_init_building_assessment extends Migration
{
    public function safeUp()
    {
        $this->createSchemaBuildingAssessment();
        $this->createTableBuildingHoushold();
    }

    public function safeDown()
    {

        $this->dropTableBuildingHousehold();
        $this->dropSchemaBuildingAssessment();
        return true;
    }

    public function createSchemaBuildingAssessment(){
        $sql= <<<SQL
CREATE SCHEMA "building_assessment";
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function dropSchemaBuildingAssessment(){
        $sql = <<<SQL
DROP SCHEMA IF EXISTS "building_assessment";
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }
    public function createTableBuildingHoushold(){
        $sql = <<<SQL
CREATE TABLE "building_assessment".building_household(
  id BIGSERIAL,
  owner_name CHARACTER VARYING (128),
  owner_contact CHARACTER VARYING (128),
  occupancy_type TEXT, -- list
  current_condition CHARACTER VARYING (64),
  income_source TEXT, -- list
  income_level CHARACTER VARYING (64), -- below 10k/ 10k-20k/ 20k-30k / above 30k
  construction_type TEXT, --list
  current_income_status CHARACTER VARYING (32),-- running / partially running / ended

  damage_type CHARACTER VARYING (32), -- collapsed / severe_damage / moderate damage

  user_id INTEGER ,
  no_of_occupants SMALLINT ,
  event_name CHARACTER VARYING (64),

  timestamp_created_at TIMESTAMP WITHOUT TIME ZONE,
  timestamp_updated_at TIMESTAMP WITHOUT TIME ZONE,
  timestamp_occurance TIMESTAMP WITHOUT TIME ZONE,
  longitude DOUBLE PRECISION ,
  latitude DOUBLE PRECISION ,
  geom GEOMETRY (POINT),
  wkt TEXT,
  address CHARACTER VARYING (128),
  c_code SMALLINT,
  z_code SMALLINT,
  d_code SMALLINT,
  v_code SMALLINT,
  ward_no SMALLINT,

  impact_death SMALLINT,
  impact_injured SMALLINT,
  impact_missing SMALLINT,
  impact_displaced SMALLINT,
  impact_orphaned SMALLINT,

  tags HSTORE,

  CONSTRAINT pk_building_household_id PRIMARY KEY (id),
  CONSTRAINT fk_building_household_user_id_fk FOREIGN KEY (user_id)
      REFERENCES "user"."user" (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function dropTableBuildingHousehold(){
        $sql = <<<SQL
DROP TABLE IF EXISTS  "building_assessment".building_household;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

    }
}
