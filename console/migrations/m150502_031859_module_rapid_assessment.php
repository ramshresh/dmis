<?php

use yii\db\Schema;
use yii\db\Migration;

class m150502_031859_module_rapid_assessment extends Migration
{
    public function up()
    {

        Yii::$app->db->createCommand('CREATE SCHEMA IF NOT EXISTS rapid_assessment')->execute();
        $this->createTables();

    }

    public function down()
    {

        Yii::$app->db->createCommand('CREATE SCHEMA IF NOT EXISTS rapid_assessment')->execute();

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
              id bigserial NOT NULL ,
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


              -- Table: rapid_assessment.report_item

-- DROP TABLE rapid_assessment.report_item;

CREATE TABLE "rapid_assessment".report_item
(
  id bigserial NOT NULL,
  type character varying(255) NOT NULL,
  item_name character varying(255) NOT NULL,
  class_basis character varying(255) DEFAULT NULL::character varying,
  class_name character varying(255) DEFAULT NULL::character varying,
  title character varying(255) DEFAULT NULL::character varying,
  description text,
  is_verified boolean DEFAULT false,
  status character varying(255),
  timestamp_occurance timestamp without time zone,
  timestamp_created_at timestamp without time zone,
  timestamp_updated_at timestamp without time zone,
  tags character varying(255)[] DEFAULT NULL::character varying[],
  meta_hstore hstore,
  meta_json json,
  declared_by character varying(255),
  timestamp_declared_at timestamp without time zone,
  magnitude double precision,
  units character varying(255),
  wkt text,
  geom geometry,
  latitude double precision,
  longitude double precision,
  address character varying(255) DEFAULT NULL::character varying,
  user_id bigint,
  CONSTRAINT pk_reportitem_id PRIMARY KEY (id),
  CONSTRAINT fk_reportitem_userid_user FOREIGN KEY (user_id)
      REFERENCES "user"."user" (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT unique_reportitem_id_and_type UNIQUE (id, type),
  CONSTRAINT unique_reportitem_id_class_basis_and_class_name UNIQUE (id, class_basis, class_name)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "rapid_assessment".report_item
  OWNER TO postgres;

-- Table: rapid_assessment.report_item_child

-- DROP TABLE rapid_assessment.report_item_child;

CREATE TABLE "rapid_assessment".report_item_child
(
  id bigserial NOT NULL,
  parent_id bigint NOT NULL,
  child_id bigint NOT NULL,
  parent_type character varying(255) NOT NULL,
  child_type character varying(255) NOT NULL,
  CONSTRAINT pk_reportitemchild_id PRIMARY KEY (id),
  CONSTRAINT fk_reportitemchild_child_id_and_child_type_reportitem FOREIGN KEY (child_id, child_type)
      REFERENCES "rapid_assessment".report_item (id, type) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_reportitemchild_parent_id_and_parent_type_reportitem FOREIGN KEY (parent_id, parent_type)
      REFERENCES "rapid_assessment".report_item (id, type) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT unique_reportitemchild_child_id_parent_id UNIQUE (child_id, parent_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "rapid_assessment".report_item_child
  OWNER TO postgres;

-- Table: rapid_assessment.report_item_multimedia

-- DROP TABLE rapid_assessment.report_item_multimedia;

CREATE TABLE "rapid_assessment".report_item_multimedia
(
  id bigserial NOT NULL,
  report_item_id bigint,
  type character varying(255) DEFAULT NULL::character varying,
  title character varying(255) DEFAULT NULL::character varying,
  extension character varying(255) DEFAULT NULL::character varying,
  thumbnail_url text,
  description character varying(255) DEFAULT NULL::character varying,
  latitude double precision,
  longitude double precision,
  url text,
  path text,
  timestamp_taken_at timestamp without time zone,
  caption character varying(255) DEFAULT NULL::character varying,
  resolution_x integer,
  resolution_y integer,
  size_bytes integer,
  is_verified boolean,
  tags character varying(255)[] DEFAULT NULL::character varying(255)[],
  meta_hstore hstore,
  meta_json json,
  CONSTRAINT pk_reportitemmultimedia_id PRIMARY KEY (id),
  CONSTRAINT fk_reportitemmultimedia_report_item_id_reportitem_as_fk FOREIGN KEY (report_item_id)
      REFERENCES "rapid_assessment".report_item (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "rapid_assessment".report_item_multimedia
  OWNER TO postgres;

-- Table: rapid_assessment.report_item_rating

-- DROP TABLE rapid_assessment.report_item_rating;

CREATE TABLE "rapid_assessment".report_item_rating
(
  id bigserial NOT NULL,
  report_item_id bigint NOT NULL,
  rating smallint NOT NULL,
  comment character varying(225),
  is_valid boolean DEFAULT true,
  user_id bigint NOT NULL,
  timestamp_created_at timestamp without time zone,
  timestamp_updated_at timestamp without time zone,
  CONSTRAINT pk_reportitemrating_id PRIMARY KEY (id),
  CONSTRAINT fk_reportitemrating_report_item_id_reportitem FOREIGN KEY (report_item_id)
      REFERENCES "rapid_assessment".report_item (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_reportitemrating_user_id_user FOREIGN KEY (user_id)
      REFERENCES "user"."user" (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT unique_reportitemrating_report_item_id_and_user_id UNIQUE (report_item_id, user_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "rapid_assessment".report_item_rating
  OWNER TO postgres;

SQL;
        Yii::$app->db->createCommand($sql)->execute();


    }
}
