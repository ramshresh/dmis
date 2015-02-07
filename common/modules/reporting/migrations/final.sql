CREATE SCHEMA reporting
  AUTHORIZATION postgres;

-- Table "reporting".event
CREATE TABLE "reporting".emergency_situation(

) WITH (
OIDS =FALSE
);
ALTER TABLE "reporting".emergency_situation
OWNER TO postgres;


-- Table "reporting".event
CREATE TABLE "reporting".event (
  id BIGSERIAL,
--Common Attributes
  category CHARACTER VARYING (25),
  sub_category CHARACTER VARYING (25),
  $description TEXT,
--Specific Attributes
  quantity INTEGER NOT NULL ,
  units CHARACTER VARYING(25),
  status SMALLINT DEFAULT 0,
  is_verified BOOLEAN,
--Geometry and Shape
  latitude DOUBLE PRECISION,
  longitude DOUBLE PRECISION,
  geom_point GEOMETRY (POINT),
--Location and Place
  full_address TEXT,
--Time related
  timestamp_created TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
  timestamp_updated TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
--Extra
  tags character varying(25)[] DEFAULT NULL::character varying[],
  meta_hstore hstore,
  meta_json json
) WITH (
OIDS =FALSE
);
ALTER TABLE "reporting".event
OWNER TO postgres;

-- Table "reporting".incident
CREATE TABLE "reporting".incident (
  id BIGSERIAL,
--Common Attributes
  category CHARACTER VARYING (25),
  sub_category CHARACTER VARYING (25),
  $description TEXT,
--Specific Attributes
  quantity INTEGER NOT NULL ,
  units CHARACTER VARYING(25),
  status SMALLINT DEFAULT 0,
  is_verified BOOLEAN,
--Geometry and Shape
  latitude DOUBLE PRECISION,
  longitude DOUBLE PRECISION,
  geom_point GEOMETRY (POINT),
--Location and Place
  full_address TEXT,
--Time related
  timestamp_created TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
  timestamp_updated TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
--Extra
  tags character varying(25)[] DEFAULT NULL::character varying[],
  meta_hstore hstore,
  meta_json json
) WITH (
OIDS =FALSE
);
ALTER TABLE "reporting".incident
OWNER TO postgres;

-- Table "reporting".damage
CREATE TABLE "reporting".damage (
  id BIGSERIAL,
--Common Attributes
  category CHARACTER VARYING (25),
  sub_category CHARACTER VARYING (25),
  $description TEXT,
--Specific Attributes
  quantity INTEGER NOT NULL ,
  units CHARACTER VARYING(25),
  status SMALLINT DEFAULT 0,
  is_verified BOOLEAN,
--Geometry and Shape
  latitude DOUBLE PRECISION,
  longitude DOUBLE PRECISION,
  geom_point GEOMETRY (POINT),
--Location and Place
  full_address TEXT,
--Time related
  timestamp_created TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
  timestamp_updated TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
--Extra
  tags character varying(25)[] DEFAULT NULL::character varying[],
  meta_hstore hstore,
  meta_json json
) WITH (
OIDS =FALSE
);
ALTER TABLE "reporting".damage
OWNER TO postgres;

-- Table "reporting".event
CREATE TABLE "reporting".need
(
  id BIGSERIAL,
  --Common Attributes
  category CHARACTER VARYING (25),
  sub_category CHARACTER VARYING (25),
  $description TEXT,
  --Specific Attributes
  quantity INTEGER NOT NULL ,
  units CHARACTER VARYING(25),
  status SMALLINT DEFAULT 0,
  is_verified BOOLEAN,
  --Geometry and Shape
  latitude DOUBLE PRECISION,
  longitude DOUBLE PRECISION,
  geom_point GEOMETRY (POINT),
  --Location and Place
  full_address TEXT,
  --Time related
  timestamp_created TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
  timestamp_updated TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
  --Extra
  tags character varying(25)[] DEFAULT NULL::character varying[],
  meta_hstore hstore,
  meta_json json
) WITH (
OIDS =FALSE
);
ALTER TABLE "reporting".need
OWNER TO postgres;

CREATE TABLE "reporting".event_incident
(
  event_id BIGINT NOT NULL,
  incident_id BIGINT NOT NULL
) WITH (
OIDS =FALSE
);
ALTER TABLE "reporting".event_incident
OWNER TO postgres;

CREATE TABLE "reporting".incident_damage
(
  incident_id BIGINT NOT NULL,
  damage_id BIGINT NOT NULL
) WITH (
OIDS =FALSE
);
ALTER TABLE "reporting".incident_damage
OWNER TO postgres;

CREATE TABLE "reporting".incident_need
(
  incident_id BIGINT NOT NULL,
  need_id BIGINT NOT NULL
) WITH (
OIDS =FALSE
);
ALTER TABLE "reporting".incident_need
OWNER TO postgres;


