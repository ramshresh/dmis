


DROP TABLE "reporting".symbol;
DROP TABLE "reporting".item;
DROP TABLE "reporting".item_type;
DROP TABLE "reporting".item_subtype;
DROP TABLE "reporting".item_child;
DROP TABLE "reporting".item_symbol;


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
  CONSTRAINT item_subtype_has_item_id_as_fk FOREIGN KEY (item_id)
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
  CONSTRAINT item_child_has_child_id_as_fk FOREIGN KEY (child_id)
      REFERENCES "reporting".item (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT item_child_has_parent_id_as_fk FOREIGN KEY (parent_id)
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
