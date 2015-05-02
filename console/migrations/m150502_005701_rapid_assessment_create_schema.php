<?php

use yii\db\Schema;
use yii\db\Migration;

class m150502_005701_rapid_assessment_create_schema extends Migration
{
    public function safeUp()
    {
        Yii::$app->db->createCommand('CREATE SCHEMA IF NOT EXISTS rapid_assessment')->execute();
       // $this->createTables();
    }

    public function safeDown()
    {

        Yii::$app->db->createCommand('DROP SCHEMA IF EXISTS rapid_assessment')->execute();

        /*echo "m150502_005701_rapid_assessment_create_schema cannot be reverted.\n";
        return false;*/
    }

    public function createTables(){
        $sql = <<<SQL

            CREATE EXTENSION IF NOT EXISTS hstore;
            CREATE EXTENSION IF NOT EXISTS postgis;

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


            -- Table: rapid_assessment.item_type

            -- DROP TABLE rapid_assessment.item_type;

            CREATE TABLE "rapid_assessment".item_type
            (
              id bigserial NOT NULL,
              item_name character varying(255) NOT NULL,
              type character varying(255) NOT NULL,
              description character varying(255) DEFAULT NULL::character varying,
              is_verified boolean DEFAULT false,
              CONSTRAINT pk_itemtype_id PRIMARY KEY (id),
              CONSTRAINT unique_itemtype_item_name_and_type UNIQUE (item_name, type)
            )
            WITH (
              OIDS=FALSE
            );
            ALTER TABLE "rapid_assessment".item_type
              OWNER TO postgres;

            -- DROP TABLE rapid_assessment.item_class;

            CREATE TABLE "rapid_assessment".item_class
            (
              id big SERIALIZABLE NOT NULL ,,
              item_name character varying(255) NOT NULL,
              basis character varying(255) NOT NULL,
              name character varying(255) NOT NULL,
              display_name character varying(255) DEFAULT NULL::character varying,
              range double precision,
              range_units character varying(255) DEFAULT NULL::character varying,
              standard character varying(255),
              description character varying(255) DEFAULT NULL::character varying,
              is_verified boolean DEFAULT false,
              CONSTRAINT pk_itemclass_id_as PRIMARY KEY (id),
              CONSTRAINT unique_itemclass_item_name_and_basis_and_name UNIQUE (item_name, basis, name)
            )
            WITH (
              OIDS=FALSE
            );
            ALTER TABLE "rapid_assessment".item_class
              OWNER TO postgres;


            -- Table: rapid_assessment.item_child

            -- DROP TABLE rapid_assessment.item_child;

            CREATE TABLE "rapid_assessment".item_child
            (
              id bigserial NOT NULL,
              parent_name character varying(255) NOT NULL,
              child_name character varying(255) NOT NULL,
              parent_type character varying(255) NOT NULL,
              child_type character varying(255) NOT NULL,
              is_verified boolean DEFAULT false,
              CONSTRAINT pk_itemchild_id PRIMARY KEY (id),
              CONSTRAINT fk_itemchild_child_name_and_child_type_itemtype FOREIGN KEY (child_name, child_type)
                  REFERENCES "rapid_assessment".item_type (item_name, type) MATCH SIMPLE
                  ON UPDATE CASCADE ON DELETE CASCADE,
              CONSTRAINT fk_itemchild_parent_name_and_parent_type_itemtype FOREIGN KEY (parent_name, parent_type)
                  REFERENCES "rapid_assessment".item_type (item_name, type) MATCH SIMPLE
                  ON UPDATE CASCADE ON DELETE CASCADE,
              CONSTRAINT unique_itemchild_child_name_type_parent_name_type UNIQUE (child_name, child_type, parent_name, parent_type)
            )
            WITH (
              OIDS=FALSE
            );
            ALTER TABLE "rapid_assessment".item_child
              OWNER TO postgres;

SQL;
Yii::$app->db->createCommand($sql)->execute();


    }


    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
