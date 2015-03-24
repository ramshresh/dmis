-- Table: migration

-- DROP TABLE migration;

CREATE TABLE "user".migration
(
  version character varying(180) NOT NULL,
  apply_time integer,
  CONSTRAINT migration_pkey PRIMARY KEY (version)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "user".migration
  OWNER TO postgres;




-- Table: role

-- DROP TABLE role;

CREATE TABLE "user".role
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




-- Table: "user"

-- DROP TABLE "user";

CREATE TABLE "user".user
(
  id serial NOT NULL,
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
ALTER TABLE "user".user
  OWNER TO postgres;

-- Index: user_email

-- DROP INDEX user_email;

CREATE UNIQUE INDEX user_email
  ON "user".user
  USING btree
  (email COLLATE pg_catalog."default");

-- Index: user_username

-- DROP INDEX user_username;

CREATE UNIQUE INDEX user_username
  ON "user".user
  USING btree
  (username COLLATE pg_catalog."default");



-- Table: profile

-- DROP TABLE profile;

CREATE TABLE "user".profile
(
  id serial NOT NULL,
  user_id integer NOT NULL,
  create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  update_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  full_name character varying(255) DEFAULT NULL::character varying,
  CONSTRAINT profile_pkey PRIMARY KEY (id),
  CONSTRAINT profile_user_id FOREIGN KEY (user_id)
      REFERENCES "user".user (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "user".profile
  OWNER TO postgres;


-- Table: user_auth

-- DROP TABLE user_auth;

CREATE TABLE "user".user_auth
(
  id serial NOT NULL,
  user_id integer NOT NULL,
  provider character varying(255) NOT NULL,
  provider_id character varying(255) NOT NULL,
  provider_attributes text NOT NULL,
  create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  update_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  CONSTRAINT user_auth_pkey PRIMARY KEY (id),
  CONSTRAINT user_auth_user_id FOREIGN KEY (user_id)
      REFERENCES "user".user (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "user".user_auth
  OWNER TO postgres;

-- Index: user_auth_provider_id

-- DROP INDEX user_auth_provider_id;

CREATE INDEX user_auth_provider_id
  ON "user".user_auth
  USING btree
  (provider_id COLLATE pg_catalog."default");


-- Table: user_key

-- DROP TABLE user_key;

CREATE TABLE "user".user_key
(
  id serial NOT NULL,
  user_id integer NOT NULL,
  type smallint NOT NULL,
  key character varying(255) NOT NULL,
  create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  consume_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  expire_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  CONSTRAINT user_key_pkey PRIMARY KEY (id),
  CONSTRAINT user_key_user_id FOREIGN KEY (user_id)
      REFERENCES "user".user (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE "user".user_key
  OWNER TO postgres;

-- Index: user_key_key

-- DROP INDEX user_key_key;

CREATE UNIQUE INDEX user_key_key
  ON "user".user_key
  USING btree
  (key COLLATE pg_catalog."default");
