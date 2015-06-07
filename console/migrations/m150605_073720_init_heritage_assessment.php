<?php

use yii\db\Schema;
use yii\db\Migration;

class m150605_073720_init_heritage_assessment extends Migration
{
    public function safeUp()
    {
        $this->createSchemaHeritageAssessment();
        $this->createTableHeritage();
    }

    public function safeDown()
    {

        $this->dropTableHeritage();
        $this->dropSchemaHeritageAssessment();
        return true;
    }

    public function createSchemaHeritageAssessment(){
        $sql= <<<SQL
CREATE SCHEMA "heritage_assessment";
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function dropSchemaHeritageAssessment(){
        $sql = <<<SQL
DROP SCHEMA IF EXISTS "heritage_assessment";
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }
    public function createTableHeritage(){
        $sql = <<<SQL
CREATE TABLE "heritage_assessment".heritage(
  id BIGSERIAL,
  inventory_id TEXT,
  kitta_no TEXT,
  damage_type TEXT,
  present_physical_conditions TEXT,
  historical_socio_cultural_significance TEXT,
  important_features TEXT,
  items_to_be_preserved TEXT,
  description TEXT,
  recorded_by TEXT,
  surveyor_opinion TEXT,
  old_date TIMESTAMP WITHOUT TIME ZONE ,
  new_date TIMESTAMP WITHOUT TIME ZONE ,

  timestamp_created_at TIMESTAMP WITHOUT TIME ZONE ,
  timestamp_updated_at TIMESTAMP WITHOUT TIME ZONE ,

  latitude DOUBLE  PRECISION ,
  longitude DOUBLE  PRECISION ,
  geom GEOMETRY(POINT) ,
  wkt TEXT ,
  d_code SMALLINT ,
  v_code SMALLINT ,
  ward_no SMALLINT ,

  user_id BIGINT,
  CONSTRAINT pk_heritage_id PRIMARY KEY (id)

)
SQL;

        Yii::$app->db->createCommand($sql)->execute();
    }

    public function dropTableHeritage(){
        $sql = <<<SQL
DROP TABLE IF EXISTS  "heritage_assessment".heritage;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

    }
}
