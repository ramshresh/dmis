<?php

use yii\db\Migration;

class m150502_031842_module_user extends Migration
{

    public function safeUp()
    {
        Yii::$app->db->createCommand('CREATE SCHEMA IF NOT EXISTS "user"')->execute();

        Yii::$app->db->createCommand($this->createTableRole())->execute();
        Yii::$app->db->createCommand($this->createTableUser())->execute();
        Yii::$app->db->createCommand($this->createTableProfile())->execute();
        Yii::$app->db->createCommand($this->createTableUserAuth())->execute();
        Yii::$app->db->createCommand($this->createTableUserKey())->execute();

        Yii::$app->db->createCommand($this->createIndexUserEmail())->execute();
        Yii::$app->db->createCommand($this->createIndexUserUsername())->execute();
        Yii::$app->db->createCommand($this->createIndexUserAuthProviderId())->execute();
        Yii::$app->db->createCommand($this->createIndexUserKeyKey())->execute();

    }

    public function createTableRole()
    {
        $sql = <<<SQL
CREATE TABLE IF NOT EXISTS "user".role
(
  id serial NOT NULL,
  name character varying(255) NOT NULL,
  create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  update_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  can_admin smallint NOT NULL DEFAULT 0,
  CONSTRAINT role_pkey PRIMARY KEY (id)
);
SQL;
        return $sql;
    }

    public function createTableUser()
    {
        $sql = <<<SQL
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
);
SQL;
        return $sql;
    }

    public function createTableProfile()
    {
        $sql = <<<SQL
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
);
SQL;
        return $sql;
    }

    public function createTableUserAuth()
    {
        $sql = <<<SQL
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
);
SQL;
        return $sql;
    }

    public function createTableUserKey()
    {
        $sql = <<<SQL
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
);
SQL;
        return $sql;
    }

    public function createIndexUserEmail()
    {
        $sql = <<<SQL
CREATE UNIQUE INDEX user_email
  ON "user"."user"
  USING btree
  (email COLLATE pg_catalog."default");
SQL;
        return $sql;
    }

    public function createIndexUserUsername()
    {
        $sql = <<<SQL
        CREATE UNIQUE INDEX user_username IF NOT EXISTS
  ON "user"."user"
  USING btree
  (username COLLATE pg_catalog."default");
SQL;
        return $sql;
    }

    public function createIndexUserAuthProviderId()
    {
        $sql = <<<SQL
       CREATE INDEX user_auth_provider_id IF NOT EXISTS
  ON "user".user_auth
  USING btree
  (provider_id COLLATE pg_catalog."default");
SQL;
        return $sql;
    }

    public function createIndexUserKeyKey()
    {
        $sql = <<<SQL
        CREATE UNIQUE  INDEX IF NOT EXISTS user_key_key
  ON "user".user_key
  USING btree
  (key COLLATE pg_catalog."default");

SQL;
        return $sql;
    }


    public function safeDown()
    {
        Yii::$app->db->createCommand('DROP SCHEMA IF EXISTS "user" CASCADE;')->execute();
        return true;
    }

    public function populateTables()
    {
        $password = '$2y$13$itgfOLHC51n7cuRFG7bN4O0VQrQa1gRxSa6TlMaBsPFphLVh7zWKe';
        $sql = <<<SQL
INSERT INTO "user".role (name,create_time,can_admin) VALUES ('Admin',now()::timestamp,1),('User',now()::timestamp,0);

INSERT INTO "user".user (role_id,email,username,password,status,create_time,auth_key,api_key) VALUES (1,'neo@neo.com','neo','$password',1,now()::TIMESTAMP ,'X-tW6jgeJ5h0Iu0gaPyIoozrxiv_zBGA','u11L7tK7iAc11ISKrU6op5UCLvuxgvD0');
INSERT INTO "user".profile (user_id,full_name,create_time) VALUES (1,'My name is Neo',now()::TIMESTAMP);
SQL;


        Yii::$app->db->createCommand($sql, [])->execute();
    }
}
