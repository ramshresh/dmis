-- CHANGESET
-- add user_id as fk in reportitem

-- ****************DROM Reports****************----
--  DROP TABLE reporting.need;
--  DROP TABLE reporting.damage;
--  DROP TABLE reporting.incident;
--  DROP TABLE reporting.event;
--  DROP TABLE reporting.emergency_situation;
--  DROP TABLE reporting.units;
--  DROP TABLE reporting.multimedia;
--  DROP TABLE reporting.rating;
--  DROP TABLE reporting.reportitem_user;
--  DROP TABLE reporting.geocode;
--  DROP TABLE reporting.geometry;
--  DROP TABLE reporting.reportitem_child;
--  DROP TABLE reporting.reportitem;
-- ****************DROM Reports****************----
--  ****************CREATE Reports****************----

--  ****************CREATE Reports****************----

-- Table: reporting.reportitem

CREATE TABLE reporting.reportitem
(
  id bigserial NOT NULL,
  type smallint NOT NULL,
  subtype_name character varying(25) DEFAULT NULL::character varying,
  item_name character varying(75) NOT NULL,
  title character varying(75) DEFAULT NULL::character varying,
  description text,
  is_verified boolean DEFAULT false,
  timestamp_created timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  timestamp_updated timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  tags character varying(25)[] DEFAULT NULL::character varying[],
  meta_hstore hstore,
  meta_json json,
  CONSTRAINT reportitem_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT reportitem_has_item_name_from_item_as_fk FOREIGN KEY (item_name)
  REFERENCES reporting.item (name) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT reportitem_has_subtype_name_and_item_name_from_item_subtype_as_ FOREIGN KEY (subtype_name, item_name)
  REFERENCES reporting.item_subtype (name, item_name) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT reportitem_has_id_and_type_as_unique UNIQUE (id, type)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.reportitem
OWNER TO postgres;

-- Table: reporting.reportitem_child

CREATE TABLE reporting.reportitem_child
(
  id bigserial NOT NULL,
  parent_id bigint,
  child_id bigint,
  parent_type smallint,
  child_type smallint,
  CONSTRAINT reportitem_child_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT reportitem_child_has_child_id_and_child_type_from_reportitem_as FOREIGN KEY (child_id, child_type)
  REFERENCES reporting.reportitem (id, type) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT reportitem_child_has_parent_id_and_parent_type_from_reportitem_ FOREIGN KEY (parent_id, parent_type)
  REFERENCES reporting.reportitem (id, type) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT "reportitem_child_has_child_type_GREATER_THAN_parent_type_CHECK" CHECK (child_type > parent_type)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.reportitem_child
OWNER TO postgres;

-- Table: reporting.geometry

CREATE TABLE reporting.geometry
(
  id bigserial NOT NULL,
  reportitem_id bigint NOT NULL,
  geom geometry,
  wkt text,
  srid character varying(15) DEFAULT NULL::character varying,
  type character varying(15) DEFAULT NULL::character varying,
  bbox text,
  perimeter_meter double precision,
  area_sqmeter double precision,
  length double precision,
  center_latitude double precision,
  center_longitude double precision,
  CONSTRAINT geometry_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT geometry_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES reporting.reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT geometry_has_reportitem_id_and_type_as_unique UNIQUE (reportitem_id, type)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.geometry
OWNER TO postgres;

-- Table: reporting.geocode

CREATE TABLE reporting.geocode
(
  id bigserial NOT NULL,
  api_name character varying(25),
  geometry_id bigint NOT NULL,
  reportitem_id bigint NOT NULL,
  full_address text,
  place_name character varying(75) DEFAULT NULL::text,
  country_name character varying(75) DEFAULT NULL::text,
  state_name character varying(75) DEFAULT NULL::text,
  county_name character varying(75) DEFAULT NULL::text,
  city_name character varying(75) DEFAULT NULL::text,
  neighborhood_name character varying(75) DEFAULT NULL::text,
  street_address character varying(75) DEFAULT NULL::text,
  provided_location text,
  postal_code integer,
  type text,
  display_latlng text,
  geocode_quality text,
  meta_hstore hstore,
  meta_json json,
  CONSTRAINT geocode_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT geocode_has_geometry_id_from_geometry_as_fk FOREIGN KEY (geometry_id)
  REFERENCES reporting.geometry (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT geocode_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES reporting.reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.geocode
OWNER TO postgres;

-- Table: reporting.reportitem_user

CREATE TABLE reporting.reportitem_user
(
  id bigserial NOT NULL,
  reportitem_id bigint NOT NULL,
  user_id bigint NOT NULL,
  action_type smallint,
  "timestamp" timestamp without time zone,
  CONSTRAINT reportitem_user_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT reportitem_user_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES reporting.reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT reportitem_user_has_user_id_from_user_as_fk FOREIGN KEY (user_id)
  REFERENCES "user"."user" (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT reportitem_user_has_reportitem_id_and_user_id_and_action_type_a UNIQUE (reportitem_id, user_id, action_type)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.reportitem_user
OWNER TO postgres;

-- Table: reporting.rating

CREATE TABLE reporting.rating
(
  id bigserial NOT NULL,
  reportitem_id bigint NOT NULL,
  rating smallint,
  comment character varying(225),
  is_valid boolean,
  user_id bigint NOT NULL,
  timestamp_created timestamp without time zone,
  timestamp_updated timestamp without time zone,
  CONSTRAINT rating_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT rating_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES reporting.reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT rating_has_user_id_from_user_as_fk FOREIGN KEY (user_id)
  REFERENCES "user"."user" (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT rating_has_reportitem_id_and_user_id_as_unique UNIQUE (reportitem_id, user_id)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.rating
OWNER TO postgres;

-- Table: reporting.multimedia

CREATE TABLE reporting.multimedia
(
  id bigserial NOT NULL,
  reportitem_id bigint,
  type character varying(75),
  title character varying(75),
  extension character varying(10),
  thumbnail_url text,
  description character varying(255),
  latitude double precision,
  longitude double precision,
  url text,
  path text,
  timestamp_taken timestamp without time zone,
  caption character varying(75),
  resolution_x integer,
  resolution_y integer,
  size_bytes integer,
  is_verified boolean,
  tags character varying(25)[],
  meta_hstore hstore,
  meta_json json,
  CONSTRAINT multimedia_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT multimedia_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES reporting.reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.multimedia
OWNER TO postgres;

-- Table: reporting.units


CREATE TABLE reporting.units
(
  id bigserial NOT NULL,
  standard character varying(25) NOT NULL,
  category character varying(25) NOT NULL,
  shortname character varying(25),
  displayname character varying(25),
  timestamp_created timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  timestamp_updated timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
  is_verified boolean DEFAULT false,
  tags character varying(25)[] DEFAULT NULL::character varying[],
  meta_hstore hstore,
  meta_json json,
  CONSTRAINT units_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT units_has_displayname_as_unique UNIQUE (displayname),
  CONSTRAINT units_has_short_name_as_unique UNIQUE (shortname),
  CONSTRAINT units_has_shortname_and_displayname_as_unique UNIQUE (shortname, displayname)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.units
OWNER TO postgres;


-- Table: reporting.emergency_situation

CREATE TABLE reporting.emergency_situation
(
  id bigserial NOT NULL,
  reportitem_id bigint NOT NULL,
  primary_event_id bigint,
  timestamp_declared timestamp without time zone,
  declared_by character varying(75),
  status smallint DEFAULT 0,
  CONSTRAINT emergency_situation_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT emergency_situation_has_primary_event_id_from_event_as_fk FOREIGN KEY (primary_event_id)
  REFERENCES reporting.event (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT emergency_situation_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES reporting.reportitem (id) MATCH SIMPLE
  ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.emergency_situation
OWNER TO postgres;


-- Table: reporting.event

CREATE TABLE reporting.event
(
  id bigserial NOT NULL,
  reportitem_id bigint,
  timestamp_occurance timestamp without time zone,
  duration interval,
  status smallint DEFAULT 0,
  CONSTRAINT event_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT event_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES reporting.reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.event
OWNER TO postgres;


-- Table: reporting.incident

CREATE TABLE reporting.incident
(
  id bigserial NOT NULL,
  reportitem_id bigint NOT NULL,
  timestamp_occurance timestamp without time zone,
  duration interval,
  status smallint DEFAULT 0,
  CONSTRAINT incident_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT incident_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES reporting.reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.incident
OWNER TO postgres;

-- Table: reporting.damage

CREATE TABLE reporting.damage
(
  id bigserial NOT NULL,
  reportitem_id bigint,
  quantity integer NOT NULL,
  units_shortname character varying(25),
  units_displayname character varying(25),
  status smallint DEFAULT 0,
  CONSTRAINT damage_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT damage_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES reporting.reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.damage
OWNER TO postgres;

-- Table: reporting.need

CREATE TABLE reporting.need
(
  id bigserial NOT NULL,
  reportitem_id bigint NOT NULL,
  quantity integer NOT NULL,
  units_shortname character varying(25),
  units_displayname character varying(25),
  status smallint DEFAULT 0,
  CONSTRAINT need_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT need_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id)
  REFERENCES reporting.reportitem (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT need_has_units_shortname_and_units_displayname_from_units_as_fk FOREIGN KEY (units_shortname, units_displayname)
  REFERENCES reporting.units (shortname, displayname) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.need
OWNER TO postgres;




-- ****************DROP Items****************----
-- DROP TABLE reporting.item_symbol_icon;
-- DROP TABLE reporting.symbol_icon;
-- DROP TABLE reporting.item_child;
-- DROP TABLE reporting.item_subtype;
-- DROP TABLE reporting.item_type;
-- DROP TABLE reporting.item;
-- ****************DROM Items****************----
--  ****************CREATE Items****************----
-- Table: reporting.item
CREATE TABLE reporting.item
(
  id bigserial NOT NULL,
  name character varying(75),
  tags character varying(25)[],
  meta_hstore hstore,
  meta_json json,
  displayname character varying(75),
  CONSTRAINT item_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT item_has_displayname_as_unique UNIQUE (displayname),
  CONSTRAINT item_has_name_as_unique UNIQUE (name)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.item
OWNER TO postgres;


-- Table: reporting.item_type
CREATE TABLE reporting.item_type
(
  id bigserial NOT NULL,
  item_name character varying(75),
  type smallint NOT NULL,
  description character varying(255),
  CONSTRAINT item_type_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT item_type_has_item_name_as_fk FOREIGN KEY (item_name)
  REFERENCES reporting.item (name) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_type_has_item_name_and_type_as_unique UNIQUE (item_name, type)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.item_type
OWNER TO postgres;

-- Table: reporting.item_subtype

CREATE TABLE reporting.item_subtype
(
  id bigserial NOT NULL,
  item_name character varying(75),
  name character varying(25),
  description character varying(255),
  CONSTRAINT item_subtype_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT item_subtype_has_item_name_as_fk FOREIGN KEY (item_name)
  REFERENCES reporting.item (name) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_subtype_has_item_name_and_name_as_unique UNIQUE (item_name, name)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.item_subtype
OWNER TO postgres;

-- Table: reporting.item_child

CREATE TABLE reporting.item_child
(
  id bigserial NOT NULL,
  parent_name character varying(75),
  child_name character varying(75),
  parent_type smallint NOT NULL,
  child_type smallint NOT NULL,
  CONSTRAINT item_child_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT item_child_has_child_name_and_child_type_from_item_type_as_fk FOREIGN KEY (child_name, child_type)
  REFERENCES reporting.item_type (item_name, type) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_child_has_child_name_as_fk FOREIGN KEY (child_name)
  REFERENCES reporting.item (name) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_child_has_parent_name_and_parent_type_from_item_type_as_fk FOREIGN KEY (parent_name, parent_type)
  REFERENCES reporting.item_type (item_name, type) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_child_has_parent_name_as_fk FOREIGN KEY (parent_name)
  REFERENCES reporting.item (name) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT "item_child_has_child_type_GREATER_THAN_parent_type_as_check" CHECK (child_type > parent_type)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.item_child
OWNER TO postgres;

-- Table: reporting.symbol_icon

CREATE TABLE reporting.symbol_icon
(
  id bigserial NOT NULL,
  type smallint NOT NULL,
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
  CONSTRAINT symbol_icon_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT symbol_icon_has_path_and_url_as_unique UNIQUE (path, url)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.symbol_icon
OWNER TO postgres;

-- Table: reporting.item_symbol_icon

CREATE TABLE reporting.item_symbol_icon
(
  id bigserial NOT NULL,
  item_name character varying(75),
  symbol_id bigint NOT NULL,
  is_default boolean DEFAULT false,
  CONSTRAINT item_symbol_icon_has_id_as_pk PRIMARY KEY (id),
  CONSTRAINT item_symbol_icon_has_item_name_from_item_as_fk FOREIGN KEY (item_name)
  REFERENCES reporting.item (name) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_symbol_icon_has_symbol_id_from_symbol_as_fk FOREIGN KEY (symbol_id)
  REFERENCES reporting.symbol_icon (id) MATCH SIMPLE
  ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_symbol_icon_has_item_name_and_symbol_id_as_unique UNIQUE (item_name, symbol_id)
)
WITH (
OIDS=FALSE
);
ALTER TABLE reporting.item_symbol_icon
OWNER TO postgres;
-- ****************CREATE Items****************----