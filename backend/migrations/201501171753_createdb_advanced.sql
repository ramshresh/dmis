-- Database: advanced

-- DROP DATABASE advanced;

CREATE DATABASE advanced
  WITH OWNER = postgres
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'en_US.UTF-8'
       LC_CTYPE = 'en_US.UTF-8'
       CONNECTION LIMIT = -1;


-- Extension: hstore
-- DROP EXTENSION hstore;
CREATE EXTENSION hstore;

-- Extension: postgis
-- DROP EXTENSION ppostgis;
CREATE EXTENSION postgis;


-- Schema: incident_reporting

-- DROP SCHEMA incident_reporting;

CREATE SCHEMA incident_reporting
     AUTHORIZATION postgres;

-- Table: incident_reporting.reportitem

-- DROP TABLE incident_reporting.reportitem;

CREATE TABLE incident_reporting.reportitem
(
     name character varying(75) NOT NULL,
     symbology hstore,
     description text,
     type smallint,
     CONSTRAINT reportitem_name_pk PRIMARY KEY (name)
)
WITH (
OIDS=FALSE
);
ALTER TABLE incident_reporting.reportitem
OWNER TO postgres;


-- Table: incident_reporting.reportitem_child

-- DROP TABLE incident_reporting.reportitem_child;

CREATE TABLE incident_reporting.reportitem_child
(
     parent character varying(75) NOT NULL,
     child character varying(75) NOT NULL,
     CONSTRAINT report_item_child_pk PRIMARY KEY (parent, child),
     CONSTRAINT reportitem_child_child_fk FOREIGN KEY (child)
     REFERENCES incident_reporting.reportitem (name) MATCH SIMPLE
     ON UPDATE CASCADE ON DELETE CASCADE,
     CONSTRAINT reportitem_child_parent_fk FOREIGN KEY (parent)
     REFERENCES incident_reporting.reportitem (name) MATCH SIMPLE
     ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE incident_reporting.reportitem_child
OWNER TO postgres;


-- Table: incident_reporting.reportitem_type

-- DROP TABLE incident_reporting.reportitem_type;

CREATE TABLE incident_reporting.reportitem_type
(
     reportitem_name character varying(75) NOT NULL,
     type smallint NOT NULL,
     description text,
     CONSTRAINT reportitem_type_pk PRIMARY KEY (reportitem_name, type),
     CONSTRAINT reportitem_type_name_fk FOREIGN KEY (reportitem_name)
     REFERENCES incident_reporting.reportitem (name) MATCH SIMPLE
     ON UPDATE CASCADE ON DELETE CASCADE
)
WITH (
OIDS=FALSE
);
ALTER TABLE incident_reporting.reportitem_type
OWNER TO postgres;

ALTER TABLE incident_reporting.reportitem
DROP COLUMN type;
ALTER TABLE incident_reporting.reportitem
ADD COLUMN display_name character varying(75) NOT NULL;
