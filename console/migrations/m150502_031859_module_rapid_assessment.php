<?php

use yii\db\Schema;
use yii\db\Migration;

class m150502_031859_module_rapid_assessment extends Migration
{
    public function safeUp()
    {
        Yii::$app->db->createCommand('CREATE SCHEMA IF NOT EXISTS "rapid_assessment"')->execute();
        Yii::$app->db->createCommand('CREATE EXTENSION IF NOT EXISTS postgis;')->execute();
        Yii::$app->db->createCommand('CREATE EXTENSION IF NOT EXISTS hstore;')->execute();
        $this->createTables();
    }

    public function safeDown()
    {

             /*echo "m150502_005701_rapid_assessment_create_schema cannot be reverted.\n";
        return false;*/
    }

    public function createTables(){
        $sql = <<<SQL

            CREATE TABLE "rapid_assessment".item
            (
              id bigserial NOT null,
              name character varying(255) NOT NULL,
              display_name character varying(255) DEFAULT NULL::character varying,
              tags character varying(255)[] DEFAULT NULL::character varying[],
              meta_hstore hstore,
              meta_json json,
              is_verified boolean DEFAULT false,
              CONSTRAINT pk_item_id PRIMARY KEY (id),
              CONSTRAINT unique_item_display_name UNIQUE (display_name),
              CONSTRAINT unique_item_name UNIQUE (name)
            )
            WITH (
              OIDS=FALSE
            );
            ALTER TABLE "rapid_assessment".item
              OWNER TO postgres;



SQL;
        Yii::$app->db->createCommand($sql)->execute();


    }
}
