CREATE SCHEMA reporting
  AUTHORIZATION postgres;



-- Table: "reporting".item

CREATE TABLE "reporting".item
(
  id bigserial,
  name character varying(75),
  tags character varying(25)[],
  meta_hstore hstore,
  meta_json json,
  displayname character varying(75),
  CONSTRAINT item_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT item_has_name_and_displayname_as_unique UNIQUE (name, displayname)
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".item
OWNER TO postgres;


-- Table: "reporting".item_type

CREATE TABLE "reporting".item_type
(
  id bigserial,
  type smallint NOT NULL,
  item_id bigint NOT NULL,
  description CHARACTER VARYING (255) NULL ,
  CONSTRAINT item_type_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT item_type_has_item_id_as_fk FOREIGN KEY (item_id)
  REFERENCES "reporting".item (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_type_has_item_id_and_type_as_unique UNIQUE (type, item_id)
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".item_type
OWNER TO postgres;





-- Table: "reporting".item_subtype

CREATE TABLE "reporting".item_subtype
(
  id bigserial,
  item_id bigint NOT NULL,
  name CHARACTER VARYING (25),
  description CHARACTER VARYING (255) NULL ,
  CONSTRAINT item_subtype_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT item_subtype_has_item_id_from_item_as_fk FOREIGN KEY (item_id)
  REFERENCES "reporting".item (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_subtype_has_item_id_and_name_as_unique UNIQUE (item_id,name)
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".item_subtype
OWNER TO postgres;



-- Table: "reporting".item_child

CREATE TABLE "reporting".item_child
(
  id bigserial,
  parent_id bigint NOT NULL,
  child_id bigint NOT NULL,
  parent_type smallint NOT NULL ,
  child_type smallint NOT NULL ,
  CONSTRAINT item_child_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT item_child_has_child_id_from_item_as_fk FOREIGN KEY (child_id)
  REFERENCES "reporting".item (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_child_has_parent_id_from_item_as_fk FOREIGN KEY (parent_id)
  REFERENCES "reporting".item (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_child_has_child_id_and_child_type_from_item_type_as_fk FOREIGN KEY (child_id, child_type)
  REFERENCES "reporting".item_type (item_id, type) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_child_has_parent_id_and_parent_type_from_item_type_as_fk FOREIGN KEY (parent_id, parent_type)
  REFERENCES "reporting".item_type (item_id, type) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE ,
  CONSTRAINT "item_child_has_child_type_GREATER_THAN_parenttype_as_check" CHECK (child_type > parent_type)
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".item_child
OWNER TO postgres;



-- Table: "reporting".symbol

CREATE TABLE "reporting".symbol
(
  id bigserial NOT NULL  ,
  type smallint NOT NULL ,
  name character varying(75),
  format character varying(10),
  extension character varying(10),
  path text NOT NULL,
  url text NOT NULL,
  size integer,
  resolution_x integer,
  resolution_y integer,
  source text,
  description text,
  is_verified boolean,
  tags character varying(25)[],
  meta_hstore hstore,
  meta_json json,

  CONSTRAINT symbol_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT symbol_has_path_and_url_as_unique UNIQUE (path, url)
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".symbol
OWNER TO postgres;


-- Table: "reporting".item_symbol

CREATE TABLE "reporting".item_symbol
(
  id bigserial NOT NULL ,
  item_id bigint NOT NULL,
  symbol_id bigint NOT NULL ,
  is_default boolean DEFAULT FALSE ,
  CONSTRAINT item_symbol_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT item_symbol_has_item_id_from_item_as_fk FOREIGN KEY (item_id)
  REFERENCES "reporting".item (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_symbol_has_symbol_id_from_symbol_as_fk FOREIGN KEY (symbol_id)
  REFERENCES "reporting".symbol (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_symbol_has_item_id_and_symbol_id_as_unique UNIQUE (item_id, symbol_id)
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".item_symbol
OWNER TO postgres;




-- Table: "reporting".units
CREATE TABLE "reporting".units
(
  id bigserial NOT NULL ,
  standard CHARACTER VARYING(25) NOT NULL ,
  category CHARACTER VARYING(25) NOT NULL ,
  shortname CHARACTER VARYING(25),
  displayname CHARACTER VARYING(25),
  timestamp_created timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  timestamp_updated timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  is_verified boolean DEFAULT FALSE ,
  tags character varying(25)[] DEFAULT NULL::character varying[],
  meta_hstore hstore,
  meta_json json,
  CONSTRAINT units_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT units_has_shortname_and_displayname_as_unique UNIQUE (shortname,displayname),
  CONSTRAINT units_has_displayname_as_unique UNIQUE (displayname),
  CONSTRAINT units_has_short_name_as_unique UNIQUE (shortname)
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".units
OWNER TO postgres;





-- Table: "reporting".reportitem
CREATE TABLE "reporting".reportitem
(
  id bigserial NOT NULL ,
  type smallint NOT NULL,
  subtype_name CHARACTER VARYING(25) DEFAULT NULL ,
  item_id BIGINT DEFAULT NULL,
  title CHARACTER VARYING(75) DEFAULT NULL ,
  description TEXT DEFAULT NULL ,
  is_verified boolean DEFAULT false,
  timestamp_created timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  timestamp_updated timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  tags character varying(25)[] DEFAULT NULL::character varying[],
  meta_hstore hstore,
  meta_json json,
  CONSTRAINT reportitem_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT reportitem_has_item_id_from_item_as_fk FOREIGN KEY (item_id)
  REFERENCES "reporting".item (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT reportitem_has_subtype_name_and_item_id_from_item_subtype_as_fk FOREIGN KEY (subtype_name, item_id)
  REFERENCES "reporting".item_subtype (name,item_id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".reportitem
OWNER TO postgres;





-- Table: "reporting".event
CREATE TABLE "reporting".event
(
  id bigserial NOT NULL,
  reportitem_id BIGINT NOT NULL ,
  timestamp_occurance TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
  duration INTERVAL DEFAULT NULL::INTERVAL,

  status SMALLINT DEFAULT 0,
  CONSTRAINT event_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT event_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES "reporting".reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE

)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".event
OWNER TO postgres;



-- Table: "reporting".emergency_situation

CREATE TABLE "reporting".emergency_situation
(
  id bigserial NOT NULL,
  reportitem_id bigint NOT NULL,
  primary_event_id BIGINT NOT NULL,
  timestamp_declared TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL ::TIMESTAMP,
  declared_by CHARACTER VARYING(75),
  status SMALLINT DEFAULT 0,
  CONSTRAINT emergency_situation_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT emergency_situation_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES "reporting".reportitem (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT emergency_situation_has_primary_event_id_from_event_as_fk FOREIGN KEY (primary_event_id)
  REFERENCES "reporting".event (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".emergency_situation
OWNER TO postgres;




-- Table: "reporting".incident

CREATE TABLE "reporting".incident
(
  id bigserial NOT NULL,
  reportitem_id BIGINT NOT NULL ,
  timestamp_occurance TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
  duration INTERVAL DEFAULT NULL::INTERVAL,
  status SMALLINT DEFAULT 0,

  CONSTRAINT incident_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT incident_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES "reporting".reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE

)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".incident
OWNER TO postgres;


-- Table: "reporting".damage

CREATE TABLE "reporting".damage
(
  id bigserial NOT NULL,
  reportitem_id BIGINT NOT NULL ,
  quantity integer NOT NULL ,
  units_shortname CHARACTER VARYING(25),
  units_displayname CHARACTER VARYING(25),
  status SMALLINT DEFAULT 0,

  CONSTRAINT damage_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT damage_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES "reporting".reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,

  CONSTRAINT damage_has_units_shortname_and_units_displayname_from_units_as_fk FOREIGN KEY (units_shortname,units_displayname)
  REFERENCES "reporting".units (shortname,displayname) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE


)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".damage
OWNER TO postgres;





-- Table: "reporting".need

CREATE TABLE "reporting".need
(
  id bigserial NOT NULL,
  reportitem_id BIGINT NOT NULL ,
  quantity integer NOT NULL ,
  units_shortname CHARACTER VARYING(25),
  units_displayname CHARACTER VARYING(25),
  status SMALLINT DEFAULT 0,

  CONSTRAINT need_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT need_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES "reporting".reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT need_has_units_shortname_and_units_displayname_from_units_as_fk FOREIGN KEY (units_shortname,units_displayname)
  REFERENCES "reporting".units (shortname,displayname) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".need
OWNER TO postgres;

-- Table: reporting.geometry

CREATE TABLE reporting.geometry
(
  id bigserial NOT NULL,
  reportitem_id BIGINT NOT NULL ,
  geom geometry DEFAULT NULL ,
  wkt TEXT DEFAULT NULL ,
  srid CHARACTER VARYING(15) DEFAULT NULL ,
  type character varying(15) DEFAULT NULL ,
  bbox text DEFAULT NULL ,
  perimeter_meter double precision DEFAULT NULL ,
  area_sqmeter double precision DEFAULT NULL ,
  length double precision DEFAULT NULL ,
  center_latitude double precision DEFAULT NULL ,
  center_longitude double precision DEFAULT NULL ,

  CONSTRAINT geometry_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT geometry_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES "reporting".reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT geometry_has_reportitem_id_and_type_as_unique UNIQUE (reportitem_id,type)
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".geometry
OWNER TO postgres;


-- Table: reporting.geocode

CREATE TABLE "reporting".geocode
(
  id bigserial NOT NULL,
  api_name CHARACTER VARYING(25),
  geometry_id BIGINT NOT NULL ,
  reportitem_id BIGINT NOT NULL ,
  full_address text DEFAULT NULL::TEXT,
  place_name character varying(75) DEFAULT NULL::TEXT ,
  country_name character varying(75) DEFAULT NULL::TEXT ,
  state_name character varying(75) DEFAULT NULL::TEXT ,
  county_name character varying(75) DEFAULT NULL::TEXT ,
  city_name character varying(75) DEFAULT NULL::TEXT ,
  neighborhood_name character varying(75) DEFAULT NULL::TEXT ,
  street_address character varying(75) DEFAULT NULL::TEXT ,
  provided_location text DEFAULT NULL::TEXT ,
  postal_code integer DEFAULT NULL::INTEGER ,
  type text DEFAULT NULL::TEXT ,
  display_latlng text DEFAULT NULL::text ,
  geocode_quality text DEFAULT NULL::text ,
  meta_hstore hstore DEFAULT NULL::hstore ,
  meta_json json DEFAULT NULL::json ,
  CONSTRAINT geocode_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT geocode_has_geometry_id_from_geometry_as_fk FOREIGN KEY (geometry_id)
  REFERENCES "reporting".geometry (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT geocode_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES "reporting".reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE  ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".geocode
OWNER TO postgres;



-- Table: "reporting".multimedia

CREATE TABLE "reporting".multimedia
(
  id BIGSERIAL,
  reportitem_id BIGINT DEFAULT NULL ,
  type CHARACTER VARYING(75),
  title CHARACTER VARYING(75),
  extension CHARACTER VARYING(10),
  thumbnail_url TEXT,
  description CHARACTER VARYING(255),
  latitude DOUBLE PRECISION,
  longitude DOUBLE PRECISION,
  url TEXT,
  path TEXT,
  timestamp_taken TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
  caption CHARACTER VARYING(75),
  resolution_x INTEGER,
  resolution_y INTEGER,
  size_bytes INTEGER,
  is_verified BOOLEAN,
  tags CHARACTER VARYING(25)[],
  meta_hstore hstore,
  meta_json json,

  CONSTRAINT multimedia_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT multimedia_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES "reporting".reportitem (id)
  ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".multimedia
OWNER TO postgres;


-- Table: "reporting".rating

CREATE TABLE reporting.rating
(

  id BIGSERIAL,
  reportitem_id BIGINT NOT NULL ,
  rating SMALLINT,
  comment CHARACTER VARYING(225),
  is_valid BOOLEAN DEFAULT NULL ,
  user_id BIGINT NOT NULL ,
  timestamp_created TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,
  timestamp_updated TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,

  CONSTRAINT rating_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT rating_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES "reporting".reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT rating_has_user_id_from_user_as_fk FOREIGN KEY (user_id)
  REFERENCES "user".user (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT rating_has_reportitem_id_and_user_id_as_unique UNIQUE (reportitem_id, user_id)

)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".rating
OWNER TO postgres;

-- Table: "reporting".reportitem_user

CREATE TABLE "reporting".reportitem_user
(

  id BIGSERIAL,
  reportitem_id BIGINT NOT NULL ,
  user_id BIGINT NOT NULL ,
  action_type SMALLINT,
  timestamp TIMESTAMP WITHOUT TIME ZONE DEFAULT NULL::TIMESTAMP WITHOUT TIME ZONE,

  CONSTRAINT reportitem_user_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT reportitem_user_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES "reporting".reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT reportitem_user_has_user_id_from_user_as_fk FOREIGN KEY (user_id)
  REFERENCES "user".user (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT reportitem_user_has_reportitem_id_and_user_id_and_action_type_as_unique UNIQUE (reportitem_id, user_id,action_type)

)
WITH (
OIDS=FALSE
);
ALTER TABLE "reporting".reportitem_user
OWNER TO postgres;