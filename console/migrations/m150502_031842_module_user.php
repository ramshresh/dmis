<?php

use yii\db\Schema;
use yii\db\Migration;

class m150502_031842_module_user extends yii\db\Migration
{

    public function Up()
    {

        Yii::$app->db->createCommand('CREATE SCHEMA "user"')->execute();
        //$this->createTables();
    }

    public function createTables()
    {
        $sql = <<<SQL
-- Table: "user".role

-- DROP TABLE "user".role;

CREATE TABLE IF NOT EXISTS "user".role
(
  id serial NOT NULL,
  name character varying(255) NOT NULL,
  create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  update_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  can_admin smallint NOT NULL DEFAULT 0,
  CONSTRAINT role_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "user".role
  OWNER TO postgres;

  -- Table: "user"."user"

-- DROP TABLE "user"."user";

CREATE TABLE IF NOT EXISTS "user"."user"
(
  id bigserial NOT NULL,
  role_id integer NOT NULL,
  status smallint NOT NULL,
  email character varying(255) DEFAULT NULL::character varying,
  new_email character varying(255) DEFAULT NULL::character varying,
  username character varying(255) DEFAULT NULL::character varying,
  password character varying(255) DEFAULT NULL::character varying,
  auth_key character varying(255) DEFAULT NULL::character varying,
  api_key character varying(255) DEFAULT NULL::character varying,
  login_ip character varying(255) DEFAULT NULL::character varying,
  login_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  create_ip character varying(255) DEFAULT NULL::character varying,
  create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  update_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  ban_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  ban_reason character varying(255) DEFAULT NULL::character varying,
  CONSTRAINT user_pkey PRIMARY KEY (id),
  CONSTRAINT user_role_id FOREIGN KEY (role_id)
      REFERENCES "user".role (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "user"."user"
  OWNER TO postgres;

-- Index: "user".user_email

-- DROP INDEX "user".user_email;

CREATE UNIQUE INDEX user_email
  ON "user"."user"
  USING btree
  (email COLLATE pg_catalog."default");

-- Index: "user".user_username

-- DROP INDEX "user".user_username;

CREATE UNIQUE INDEX user_username IF NOT EXISTS
  ON "user"."user"
  USING btree
  (username COLLATE pg_catalog."default");

-- Table: "user".profile

-- DROP TABLE "user".profile;

CREATE TABLE IF NOT EXISTS "user".profile
(
  id bigserial NOT NULL,
  user_id bigint NOT NULL,
  create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  update_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  full_name character varying(255) DEFAULT NULL::character varying,
  CONSTRAINT profile_pkey PRIMARY KEY (id),
  CONSTRAINT profile_user_id FOREIGN KEY (user_id)
      REFERENCES "user"."user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "user".profile
  OWNER TO postgres;
-- Table: "user".user_auth

-- DROP TABLE "user".user_auth;

CREATE TABLE IF NOT EXISTS "user".user_auth
(
  id bigserial NOT NULL,
  user_id bigint NOT NULL,
  provider character varying(255) NOT NULL,
  provider_id character varying(255) NOT NULL,
  provider_attributes text NOT NULL,
  create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  update_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  CONSTRAINT user_auth_pkey PRIMARY KEY (id),
  CONSTRAINT user_auth_user_id FOREIGN KEY (user_id)
      REFERENCES "user"."user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "user".user_auth
  OWNER TO postgres;

-- Index: "user".user_auth_provider_id

-- DROP INDEX "user".user_auth_provider_id;

CREATE INDEX user_auth_provider_id IF NOT EXISTS
  ON "user".user_auth
  USING btree
  (provider_id COLLATE pg_catalog."default");

-- Table: "user".user_key

-- DROP TABLE "user".user_key;

CREATE TABLE IF NOT EXISTS "user".user_key
(
  id bigserial NOT NULL,
  user_id bigint NOT NULL,
  type smallint NOT NULL,
  key character varying(255) NOT NULL,
  create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  consume_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  expire_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  CONSTRAINT user_key_pkey PRIMARY KEY (id),
  CONSTRAINT user_key_user_id FOREIGN KEY (user_id)
      REFERENCES "user"."user" (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "user".user_key
  OWNER TO postgres;

-- Index: "user".user_key_key

-- DROP INDEX "user".user_key_key;

CREATE UNIQUE  INDEX IF NOT EXISTS user_key_key
  ON "user".user_key
  USING btree
  (key COLLATE pg_catalog."default");


SQL;


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

    public function safeDown()
    {
        echo "m150502_020718_user cannot be reverted.\n";

        return false;
    }

    public function populateTables()
    {

        $sql = <<<SQL

INSERT INTO "user".role (name,create_time,can_admin) VALUES ('Admin',now()::timestamp,1);
INSERT INTO "user".role (name,create_time,can_admin) VALUES ('User',now()::timestamp,0);

INSERT INTO "user".profile (user_id,full_name,create_time) VALUES (1,'My name is Neo',now()::TIMESTAMP);
SQL;
        Yii::$app->db->createCommand($sql,[])->execute();
    }
}
