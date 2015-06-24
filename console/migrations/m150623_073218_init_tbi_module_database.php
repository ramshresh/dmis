<?php

use yii\db\Schema;
use yii\db\Migration;

class m150623_073218_init_tbi_module_database extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $sql = <<<SQL
CREATE SCHEMA "tbi";
SQL;
Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
CREATE TABLE "tbi".building(
  id BIGSERIAL, -- Auto Generated
  user_id BIGINT, -- Logged in user Id

  surveyor TEXT, --"suresh manandhar"
  surveyed_by TEXT, -- "KVPT"
  survey_date DATE , -- "2015-06-09"


  owner_name TEXT, -- Some Guthi
  owner_contact TEXT, -- "mobile:9841616161"
  owner_comment TEXT, -- "very Bad"

  building_name TEXT, -- "Some Temple"
  year_of_construction INTEGER, --"1800"
  no_of_storey INTEGER , -- 5
  current_use TEXT, -- "education"
  special_features TEXT, -- "nothing special"
  type TEXT, -- Options RadioList ["other","pati","jahru","dyo_chhe","pokhari","sattal","hiti","inar_or_kuwa","temple","freestanding shrines","residental_dwelling"]
  type_other TEXT, --Free writing
  style TEXT, --Options RadioList ["other","vernacular","gurung","tharu","tamang","chetteri","brahmin","newar","rana","modern"]
  style_other TEXT, -- Free writing

  physical_condition TEXT, -- Option RadioList ["no visible damage","minor damage","partial damage","major damage","completely collapsed"]
  physical_condition_comment TEXT,


  street TEXT, --
  settlement TEXT, --
  ward_no integer, -- 12
  v_code INTEGER ,-- [4 digit integer <vdc code>] for example  27060 for "Budhanilkantha Municipality"
  d_code INTEGER ,-- [2 digit integer <district code>] for example  27 for "Kathmandu"
  z_code INTEGER ,-- [1 digit integer <] for example 5 for "Zone"

  latitude DOUBLE  PRECISION ,
  longitude DOUBLE  PRECISION ,
  surveyed_at TIMESTAMP WITHOUT TIME ZONE ,

  --The following fields are processed at server
  timestamp_created_at TIMESTAMP WITHOUT TIME ZONE , -- The timestamp of record saved
  timestamp_updated_at TIMESTAMP WITHOUT TIME ZONE , -- The timestamp of record updated
  geom GEOMETRY(POINT) , -- Geometry
  wkt TEXT ,-- Well Known Format text

  CONSTRAINT pk_tbi_building_id PRIMARY KEY (id)
)
SQL;

        Yii::$app->db->createCommand($sql)->execute();

        $sql=<<<SQL

CREATE TABLE "tbi".gallery_image
(
  id bigserial NOT NULL,
  type character varying(255),
  "ownerId" bigint NOT NULL,
  rank integer NOT NULL DEFAULT 0,
  name character varying(255),
  description text,
  latitude double precision,
  longitude double precision,
  versions json NOT NULL,
  route character varying(255),
  extension character varying(255),
  CONSTRAINT tbi_building_gallery_image_pkey PRIMARY KEY (id),
  CONSTRAINT fk_thi_building_gi_owner_id FOREIGN KEY ("ownerId") REFERENCES "tbi".building (id) ON UPDATE CASCADE ON DELETE CASCADE
)
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }
    
    public function safeDown()
    {

        $sql = <<<SQL
DROP TABLE IF EXISTS "tbi".gallery_image;
SQL;
        Yii::$app->db->createCommand($sql)->execute();


        $sql = <<<SQL
DROP TABLE IF EXISTS "tbi".building;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
DROP SCHEMA IF EXISTS "tbi";
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        return true;
    }
}
