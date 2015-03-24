--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.5
-- Dumped by pg_dump version 9.3.5
-- Started on 2015-02-16 09:47:54 NPT

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 6 (class 2615 OID 238515)
-- Name: reporting; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA reporting;


ALTER SCHEMA reporting OWNER TO postgres;

--
-- TOC entry 7 (class 2615 OID 238516)
-- Name: test_tabular_input; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA test_tabular_input;


ALTER SCHEMA test_tabular_input OWNER TO postgres;

--
-- TOC entry 8 (class 2615 OID 238517)
-- Name: user; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA "user";


ALTER SCHEMA "user" OWNER TO postgres;

--
-- TOC entry 9 (class 2615 OID 238518)
-- Name: user_management; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA user_management;


ALTER SCHEMA user_management OWNER TO postgres;

--
-- TOC entry 253 (class 3079 OID 11789)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 3823 (class 0 OID 0)
-- Dependencies: 253
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- TOC entry 255 (class 3079 OID 238519)
-- Name: hstore; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS hstore WITH SCHEMA public;


--
-- TOC entry 3824 (class 0 OID 0)
-- Dependencies: 255
-- Name: EXTENSION hstore; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION hstore IS 'data type for storing sets of (key, value) pairs';


--
-- TOC entry 254 (class 3079 OID 238639)
-- Name: postgis; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;


--
-- TOC entry 3825 (class 0 OID 0)
-- Dependencies: 254
-- Name: EXTENSION postgis; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis IS 'PostGIS geometry, geography, and raster spatial types and functions';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 250 (class 1259 OID 273417)
-- Name: migration; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE public.migration OWNER TO postgres;

--
-- TOC entry 252 (class 1259 OID 273424)
-- Name: user; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE "user" (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    auth_key character varying(32) NOT NULL,
    password_hash character varying(255) NOT NULL,
    password_reset_token character varying(255),
    email character varying(255) NOT NULL,
    status smallint DEFAULT 10 NOT NULL,
    created_at integer NOT NULL,
    updated_at integer NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- TOC entry 251 (class 1259 OID 273422)
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- TOC entry 3826 (class 0 OID 0)
-- Dependencies: 251
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


SET search_path = reporting, pg_catalog;

--
-- TOC entry 187 (class 1259 OID 239925)
-- Name: damage; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE damage (
    id bigint NOT NULL,
    reportitem_id bigint,
    quantity integer NOT NULL,
    units_shortname character varying(25),
    units_displayname character varying(25),
    status smallint DEFAULT 0
);


ALTER TABLE reporting.damage OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 239929)
-- Name: damage_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE damage_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.damage_id_seq OWNER TO postgres;

--
-- TOC entry 3827 (class 0 OID 0)
-- Dependencies: 188
-- Name: damage_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE damage_id_seq OWNED BY damage.id;


--
-- TOC entry 189 (class 1259 OID 239931)
-- Name: emergency_situation; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE emergency_situation (
    id bigint NOT NULL,
    reportitem_id bigint NOT NULL,
    primary_event_id bigint,
    timestamp_declared timestamp without time zone,
    declared_by character varying(75),
    status smallint DEFAULT 0
);


ALTER TABLE reporting.emergency_situation OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 239935)
-- Name: emergency_situation_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE emergency_situation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.emergency_situation_id_seq OWNER TO postgres;

--
-- TOC entry 3828 (class 0 OID 0)
-- Dependencies: 190
-- Name: emergency_situation_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE emergency_situation_id_seq OWNED BY emergency_situation.id;


--
-- TOC entry 191 (class 1259 OID 239937)
-- Name: event; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE event (
    id bigint NOT NULL,
    reportitem_id bigint,
    timestamp_occurance timestamp without time zone,
    duration interval,
    status smallint DEFAULT 0
);


ALTER TABLE reporting.event OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 239941)
-- Name: event_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE event_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.event_id_seq OWNER TO postgres;

--
-- TOC entry 3829 (class 0 OID 0)
-- Dependencies: 192
-- Name: event_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE event_id_seq OWNED BY event.id;


--
-- TOC entry 193 (class 1259 OID 239943)
-- Name: geocode; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE geocode (
    id bigint NOT NULL,
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
    meta_hstore public.hstore,
    meta_json json
);


ALTER TABLE reporting.geocode OWNER TO postgres;

--
-- TOC entry 194 (class 1259 OID 239956)
-- Name: geocode_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE geocode_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.geocode_id_seq OWNER TO postgres;

--
-- TOC entry 3830 (class 0 OID 0)
-- Dependencies: 194
-- Name: geocode_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE geocode_id_seq OWNED BY geocode.id;


--
-- TOC entry 195 (class 1259 OID 239958)
-- Name: geometry; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE geometry (
    id bigint NOT NULL,
    reportitem_id bigint,
    geom public.geometry,
    wkt text,
    srid character varying(15) DEFAULT NULL::character varying,
    type character varying(15) DEFAULT NULL::character varying,
    bbox text,
    perimeter_meter double precision,
    area_sqmeter double precision,
    length double precision,
    latitude double precision,
    longitude double precision
);


ALTER TABLE reporting.geometry OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 239966)
-- Name: geometry_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE geometry_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.geometry_id_seq OWNER TO postgres;

--
-- TOC entry 3831 (class 0 OID 0)
-- Dependencies: 196
-- Name: geometry_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE geometry_id_seq OWNED BY geometry.id;


--
-- TOC entry 197 (class 1259 OID 239968)
-- Name: incident; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE incident (
    id bigint NOT NULL,
    reportitem_id bigint,
    timestamp_occurance timestamp without time zone,
    duration interval,
    status smallint DEFAULT 0
);


ALTER TABLE reporting.incident OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 239972)
-- Name: incident_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE incident_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.incident_id_seq OWNER TO postgres;

--
-- TOC entry 3832 (class 0 OID 0)
-- Dependencies: 198
-- Name: incident_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE incident_id_seq OWNED BY incident.id;


--
-- TOC entry 199 (class 1259 OID 239974)
-- Name: item; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE item (
    id bigint NOT NULL,
    name character varying(75),
    tags character varying(25)[],
    meta_hstore public.hstore,
    meta_json json,
    displayname character varying(75)
);


ALTER TABLE reporting.item OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 239980)
-- Name: item_child; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE item_child (
    id bigint NOT NULL,
    parent_name character varying(75),
    child_name character varying(75),
    parent_type smallint NOT NULL,
    child_type smallint NOT NULL,
    CONSTRAINT "item_child_has_child_type_GREATER_THAN_parent_type_as_check" CHECK ((child_type > parent_type))
);


ALTER TABLE reporting.item_child OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 239984)
-- Name: item_child_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE item_child_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.item_child_id_seq OWNER TO postgres;

--
-- TOC entry 3833 (class 0 OID 0)
-- Dependencies: 201
-- Name: item_child_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE item_child_id_seq OWNED BY item_child.id;


--
-- TOC entry 202 (class 1259 OID 239986)
-- Name: item_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE item_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.item_id_seq OWNER TO postgres;

--
-- TOC entry 3834 (class 0 OID 0)
-- Dependencies: 202
-- Name: item_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE item_id_seq OWNED BY item.id;


--
-- TOC entry 203 (class 1259 OID 239988)
-- Name: item_subtype; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE item_subtype (
    id bigint NOT NULL,
    item_name character varying(75),
    name character varying(25),
    description character varying(255)
);


ALTER TABLE reporting.item_subtype OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 239991)
-- Name: item_subtype_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE item_subtype_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.item_subtype_id_seq OWNER TO postgres;

--
-- TOC entry 3835 (class 0 OID 0)
-- Dependencies: 204
-- Name: item_subtype_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE item_subtype_id_seq OWNED BY item_subtype.id;


--
-- TOC entry 205 (class 1259 OID 239993)
-- Name: item_symbol_icon; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE item_symbol_icon (
    id bigint NOT NULL,
    item_name character varying(75),
    symbol_id bigint NOT NULL,
    is_default boolean DEFAULT false
);


ALTER TABLE reporting.item_symbol_icon OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 239997)
-- Name: item_symbol_icon_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE item_symbol_icon_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.item_symbol_icon_id_seq OWNER TO postgres;

--
-- TOC entry 3836 (class 0 OID 0)
-- Dependencies: 206
-- Name: item_symbol_icon_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE item_symbol_icon_id_seq OWNED BY item_symbol_icon.id;


--
-- TOC entry 207 (class 1259 OID 239999)
-- Name: item_type; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE item_type (
    id bigint NOT NULL,
    item_name character varying(75),
    type smallint NOT NULL,
    description character varying(255)
);


ALTER TABLE reporting.item_type OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 240002)
-- Name: item_type_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE item_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.item_type_id_seq OWNER TO postgres;

--
-- TOC entry 3837 (class 0 OID 0)
-- Dependencies: 208
-- Name: item_type_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE item_type_id_seq OWNED BY item_type.id;


--
-- TOC entry 209 (class 1259 OID 240004)
-- Name: multimedia; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE multimedia (
    id bigint NOT NULL,
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
    meta_hstore public.hstore,
    meta_json json
);


ALTER TABLE reporting.multimedia OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 240010)
-- Name: multimedia_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE multimedia_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.multimedia_id_seq OWNER TO postgres;

--
-- TOC entry 3838 (class 0 OID 0)
-- Dependencies: 210
-- Name: multimedia_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE multimedia_id_seq OWNED BY multimedia.id;


--
-- TOC entry 211 (class 1259 OID 240012)
-- Name: need; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE need (
    id bigint NOT NULL,
    reportitem_id bigint,
    quantity integer NOT NULL,
    units_shortname character varying(25),
    units_displayname character varying(25),
    status smallint DEFAULT 0
);


ALTER TABLE reporting.need OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 240016)
-- Name: need_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE need_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.need_id_seq OWNER TO postgres;

--
-- TOC entry 3839 (class 0 OID 0)
-- Dependencies: 212
-- Name: need_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE need_id_seq OWNED BY need.id;


--
-- TOC entry 213 (class 1259 OID 240018)
-- Name: rating; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE rating (
    id bigint NOT NULL,
    reportitem_id bigint NOT NULL,
    rating smallint,
    comment character varying(225),
    is_valid boolean,
    user_id bigint NOT NULL,
    timestamp_created timestamp without time zone,
    timestamp_updated timestamp without time zone
);


ALTER TABLE reporting.rating OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 240021)
-- Name: rating_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE rating_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.rating_id_seq OWNER TO postgres;

--
-- TOC entry 3840 (class 0 OID 0)
-- Dependencies: 214
-- Name: rating_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE rating_id_seq OWNED BY rating.id;


--
-- TOC entry 215 (class 1259 OID 240023)
-- Name: reportitem; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE reportitem (
    id bigint NOT NULL,
    type smallint NOT NULL,
    subtype_name character varying(25) DEFAULT NULL::character varying,
    item_name character varying(75) NOT NULL,
    title character varying(75) DEFAULT NULL::character varying,
    description text,
    is_verified boolean DEFAULT false,
    timestamp_created timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    timestamp_updated timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    tags character varying(25)[] DEFAULT NULL::character varying[],
    meta_hstore public.hstore,
    meta_json json,
    user_id bigint
);


ALTER TABLE reporting.reportitem OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 240035)
-- Name: reportitem_child; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE reportitem_child (
    id bigint NOT NULL,
    parent_id bigint,
    child_id bigint,
    parent_type smallint,
    child_type smallint,
    CONSTRAINT "reportitem_child_has_child_type_GREATER_THAN_parent_type_CHECK" CHECK ((child_type > parent_type))
);


ALTER TABLE reporting.reportitem_child OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 240039)
-- Name: reportitem_child_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE reportitem_child_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.reportitem_child_id_seq OWNER TO postgres;

--
-- TOC entry 3841 (class 0 OID 0)
-- Dependencies: 217
-- Name: reportitem_child_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE reportitem_child_id_seq OWNED BY reportitem_child.id;


--
-- TOC entry 218 (class 1259 OID 240041)
-- Name: reportitem_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE reportitem_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.reportitem_id_seq OWNER TO postgres;

--
-- TOC entry 3842 (class 0 OID 0)
-- Dependencies: 218
-- Name: reportitem_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE reportitem_id_seq OWNED BY reportitem.id;


--
-- TOC entry 219 (class 1259 OID 240043)
-- Name: reportitem_user; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE reportitem_user (
    id bigint NOT NULL,
    reportitem_id bigint NOT NULL,
    user_id bigint NOT NULL,
    action_type smallint,
    "timestamp" timestamp without time zone
);


ALTER TABLE reporting.reportitem_user OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 240046)
-- Name: reportitem_user_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE reportitem_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.reportitem_user_id_seq OWNER TO postgres;

--
-- TOC entry 3843 (class 0 OID 0)
-- Dependencies: 220
-- Name: reportitem_user_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE reportitem_user_id_seq OWNED BY reportitem_user.id;


--
-- TOC entry 221 (class 1259 OID 240048)
-- Name: symbol_icon; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE symbol_icon (
    id bigint NOT NULL,
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
    meta_hstore public.hstore,
    meta_json json
);


ALTER TABLE reporting.symbol_icon OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 240054)
-- Name: symbol_icon_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE symbol_icon_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.symbol_icon_id_seq OWNER TO postgres;

--
-- TOC entry 3844 (class 0 OID 0)
-- Dependencies: 222
-- Name: symbol_icon_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE symbol_icon_id_seq OWNED BY symbol_icon.id;


--
-- TOC entry 223 (class 1259 OID 240056)
-- Name: units; Type: TABLE; Schema: reporting; Owner: postgres; Tablespace: 
--

CREATE TABLE units (
    id bigint NOT NULL,
    standard character varying(25) NOT NULL,
    category character varying(25) NOT NULL,
    shortname character varying(25),
    displayname character varying(25),
    timestamp_created timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    timestamp_updated timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    is_verified boolean DEFAULT false,
    tags character varying(25)[] DEFAULT NULL::character varying[],
    meta_hstore public.hstore,
    meta_json json
);


ALTER TABLE reporting.units OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 240066)
-- Name: units_id_seq; Type: SEQUENCE; Schema: reporting; Owner: postgres
--

CREATE SEQUENCE units_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE reporting.units_id_seq OWNER TO postgres;

--
-- TOC entry 3845 (class 0 OID 0)
-- Dependencies: 224
-- Name: units_id_seq; Type: SEQUENCE OWNED BY; Schema: reporting; Owner: postgres
--

ALTER SEQUENCE units_id_seq OWNED BY units.id;


SET search_path = test_tabular_input, pg_catalog;

--
-- TOC entry 225 (class 1259 OID 240068)
-- Name: course; Type: TABLE; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

CREATE TABLE course (
    id bigint NOT NULL,
    title character varying(75),
    code_title character varying(4) NOT NULL,
    code_no integer NOT NULL
);


ALTER TABLE test_tabular_input.course OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 240071)
-- Name: course_id_seq; Type: SEQUENCE; Schema: test_tabular_input; Owner: postgres
--

CREATE SEQUENCE course_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE test_tabular_input.course_id_seq OWNER TO postgres;

--
-- TOC entry 3846 (class 0 OID 0)
-- Dependencies: 226
-- Name: course_id_seq; Type: SEQUENCE OWNED BY; Schema: test_tabular_input; Owner: postgres
--

ALTER SEQUENCE course_id_seq OWNED BY course.id;


--
-- TOC entry 227 (class 1259 OID 240073)
-- Name: person; Type: TABLE; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

CREATE TABLE person (
    date_of_birth date,
    address text,
    gender "char",
    citizenship_no character varying(7) DEFAULT NULL::character varying,
    id bigint NOT NULL,
    nationality character(75),
    full_name character varying(75)
);


ALTER TABLE test_tabular_input.person OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 240080)
-- Name: person_child; Type: TABLE; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

CREATE TABLE person_child (
    parentid bigint NOT NULL,
    childid bigint NOT NULL,
    type smallint
);


ALTER TABLE test_tabular_input.person_child OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 240083)
-- Name: person_child_childid_seq; Type: SEQUENCE; Schema: test_tabular_input; Owner: postgres
--

CREATE SEQUENCE person_child_childid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE test_tabular_input.person_child_childid_seq OWNER TO postgres;

--
-- TOC entry 3847 (class 0 OID 0)
-- Dependencies: 229
-- Name: person_child_childid_seq; Type: SEQUENCE OWNED BY; Schema: test_tabular_input; Owner: postgres
--

ALTER SEQUENCE person_child_childid_seq OWNED BY person_child.childid;


--
-- TOC entry 230 (class 1259 OID 240085)
-- Name: person_child_parentid_seq; Type: SEQUENCE; Schema: test_tabular_input; Owner: postgres
--

CREATE SEQUENCE person_child_parentid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE test_tabular_input.person_child_parentid_seq OWNER TO postgres;

--
-- TOC entry 3848 (class 0 OID 0)
-- Dependencies: 230
-- Name: person_child_parentid_seq; Type: SEQUENCE OWNED BY; Schema: test_tabular_input; Owner: postgres
--

ALTER SEQUENCE person_child_parentid_seq OWNED BY person_child.parentid;


--
-- TOC entry 231 (class 1259 OID 240087)
-- Name: person_id_seq; Type: SEQUENCE; Schema: test_tabular_input; Owner: postgres
--

CREATE SEQUENCE person_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE test_tabular_input.person_id_seq OWNER TO postgres;

--
-- TOC entry 3849 (class 0 OID 0)
-- Dependencies: 231
-- Name: person_id_seq; Type: SEQUENCE OWNED BY; Schema: test_tabular_input; Owner: postgres
--

ALTER SEQUENCE person_id_seq OWNED BY person.id;


--
-- TOC entry 232 (class 1259 OID 240089)
-- Name: student; Type: TABLE; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

CREATE TABLE student (
    id bigint NOT NULL,
    registration_no character varying(7) NOT NULL,
    personid bigint NOT NULL
);


ALTER TABLE test_tabular_input.student OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 240092)
-- Name: student_course; Type: TABLE; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

CREATE TABLE student_course (
    id bigint NOT NULL,
    student_registration_no character varying(7) NOT NULL,
    course_code_title character varying(4) NOT NULL,
    course_code_no integer NOT NULL,
    enrollment_date date,
    gpa double precision,
    completion_date date
);


ALTER TABLE test_tabular_input.student_course OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 240095)
-- Name: student_course_id_seq; Type: SEQUENCE; Schema: test_tabular_input; Owner: postgres
--

CREATE SEQUENCE student_course_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE test_tabular_input.student_course_id_seq OWNER TO postgres;

--
-- TOC entry 3850 (class 0 OID 0)
-- Dependencies: 234
-- Name: student_course_id_seq; Type: SEQUENCE OWNED BY; Schema: test_tabular_input; Owner: postgres
--

ALTER SEQUENCE student_course_id_seq OWNED BY student_course.id;


--
-- TOC entry 235 (class 1259 OID 240097)
-- Name: student_id_seq; Type: SEQUENCE; Schema: test_tabular_input; Owner: postgres
--

CREATE SEQUENCE student_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE test_tabular_input.student_id_seq OWNER TO postgres;

--
-- TOC entry 3851 (class 0 OID 0)
-- Dependencies: 235
-- Name: student_id_seq; Type: SEQUENCE OWNED BY; Schema: test_tabular_input; Owner: postgres
--

ALTER SEQUENCE student_id_seq OWNED BY student.id;


--
-- TOC entry 236 (class 1259 OID 240099)
-- Name: student_personid_seq; Type: SEQUENCE; Schema: test_tabular_input; Owner: postgres
--

CREATE SEQUENCE student_personid_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE test_tabular_input.student_personid_seq OWNER TO postgres;

--
-- TOC entry 3852 (class 0 OID 0)
-- Dependencies: 236
-- Name: student_personid_seq; Type: SEQUENCE OWNED BY; Schema: test_tabular_input; Owner: postgres
--

ALTER SEQUENCE student_personid_seq OWNED BY student.personid;


SET search_path = "user", pg_catalog;

--
-- TOC entry 237 (class 1259 OID 240101)
-- Name: migration; Type: TABLE; Schema: user; Owner: postgres; Tablespace: 
--

CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE "user".migration OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 240104)
-- Name: profile; Type: TABLE; Schema: user; Owner: postgres; Tablespace: 
--

CREATE TABLE profile (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    update_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    full_name character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE "user".profile OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 240110)
-- Name: profile_id_seq; Type: SEQUENCE; Schema: user; Owner: postgres
--

CREATE SEQUENCE profile_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "user".profile_id_seq OWNER TO postgres;

--
-- TOC entry 3853 (class 0 OID 0)
-- Dependencies: 239
-- Name: profile_id_seq; Type: SEQUENCE OWNED BY; Schema: user; Owner: postgres
--

ALTER SEQUENCE profile_id_seq OWNED BY profile.id;


--
-- TOC entry 240 (class 1259 OID 240112)
-- Name: role; Type: TABLE; Schema: user; Owner: postgres; Tablespace: 
--

CREATE TABLE role (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    update_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    can_admin smallint DEFAULT 0 NOT NULL
);


ALTER TABLE "user".role OWNER TO postgres;

--
-- TOC entry 241 (class 1259 OID 240118)
-- Name: role_id_seq; Type: SEQUENCE; Schema: user; Owner: postgres
--

CREATE SEQUENCE role_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "user".role_id_seq OWNER TO postgres;

--
-- TOC entry 3854 (class 0 OID 0)
-- Dependencies: 241
-- Name: role_id_seq; Type: SEQUENCE OWNED BY; Schema: user; Owner: postgres
--

ALTER SEQUENCE role_id_seq OWNED BY role.id;


--
-- TOC entry 242 (class 1259 OID 240120)
-- Name: user; Type: TABLE; Schema: user; Owner: postgres; Tablespace: 
--

CREATE TABLE "user" (
    id bigint NOT NULL,
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
    ban_reason character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE "user"."user" OWNER TO postgres;

--
-- TOC entry 243 (class 1259 OID 240139)
-- Name: user_auth; Type: TABLE; Schema: user; Owner: postgres; Tablespace: 
--

CREATE TABLE user_auth (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    provider character varying(255) NOT NULL,
    provider_id character varying(255) NOT NULL,
    provider_attributes text NOT NULL,
    create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    update_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


ALTER TABLE "user".user_auth OWNER TO postgres;

--
-- TOC entry 244 (class 1259 OID 240147)
-- Name: user_auth_id_seq; Type: SEQUENCE; Schema: user; Owner: postgres
--

CREATE SEQUENCE user_auth_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "user".user_auth_id_seq OWNER TO postgres;

--
-- TOC entry 3855 (class 0 OID 0)
-- Dependencies: 244
-- Name: user_auth_id_seq; Type: SEQUENCE OWNED BY; Schema: user; Owner: postgres
--

ALTER SEQUENCE user_auth_id_seq OWNED BY user_auth.id;


--
-- TOC entry 245 (class 1259 OID 240149)
-- Name: user_id_seq; Type: SEQUENCE; Schema: user; Owner: postgres
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "user".user_id_seq OWNER TO postgres;

--
-- TOC entry 3856 (class 0 OID 0)
-- Dependencies: 245
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: user; Owner: postgres
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


--
-- TOC entry 246 (class 1259 OID 240151)
-- Name: user_key; Type: TABLE; Schema: user; Owner: postgres; Tablespace: 
--

CREATE TABLE user_key (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    type smallint NOT NULL,
    key character varying(255) NOT NULL,
    create_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    consume_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    expire_time timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


ALTER TABLE "user".user_key OWNER TO postgres;

--
-- TOC entry 247 (class 1259 OID 240157)
-- Name: user_key_id_seq; Type: SEQUENCE; Schema: user; Owner: postgres
--

CREATE SEQUENCE user_key_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "user".user_key_id_seq OWNER TO postgres;

--
-- TOC entry 3857 (class 0 OID 0)
-- Dependencies: 247
-- Name: user_key_id_seq; Type: SEQUENCE OWNED BY; Schema: user; Owner: postgres
--

ALTER SEQUENCE user_key_id_seq OWNED BY user_key.id;


SET search_path = user_management, pg_catalog;

--
-- TOC entry 248 (class 1259 OID 240159)
-- Name: user; Type: TABLE; Schema: user_management; Owner: postgres; Tablespace: 
--

CREATE TABLE "user" (
    id bigint NOT NULL,
    username character varying(75),
    password_hash text,
    password_reset_token text,
    email text,
    auth_key text,
    role integer,
    status integer,
    created_at integer,
    updated_at integer
);


ALTER TABLE user_management."user" OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 240165)
-- Name: user_id_seq; Type: SEQUENCE; Schema: user_management; Owner: postgres
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_management.user_id_seq OWNER TO postgres;

--
-- TOC entry 3858 (class 0 OID 0)
-- Dependencies: 249
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: user_management; Owner: postgres
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


SET search_path = public, pg_catalog;

--
-- TOC entry 3491 (class 2604 OID 273427)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


SET search_path = reporting, pg_catalog;

--
-- TOC entry 3408 (class 2604 OID 240167)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY damage ALTER COLUMN id SET DEFAULT nextval('damage_id_seq'::regclass);


--
-- TOC entry 3410 (class 2604 OID 240168)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY emergency_situation ALTER COLUMN id SET DEFAULT nextval('emergency_situation_id_seq'::regclass);


--
-- TOC entry 3412 (class 2604 OID 240169)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY event ALTER COLUMN id SET DEFAULT nextval('event_id_seq'::regclass);


--
-- TOC entry 3420 (class 2604 OID 240170)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY geocode ALTER COLUMN id SET DEFAULT nextval('geocode_id_seq'::regclass);


--
-- TOC entry 3423 (class 2604 OID 240171)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY geometry ALTER COLUMN id SET DEFAULT nextval('geometry_id_seq'::regclass);


--
-- TOC entry 3425 (class 2604 OID 240172)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY incident ALTER COLUMN id SET DEFAULT nextval('incident_id_seq'::regclass);


--
-- TOC entry 3426 (class 2604 OID 240173)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item ALTER COLUMN id SET DEFAULT nextval('item_id_seq'::regclass);


--
-- TOC entry 3427 (class 2604 OID 240174)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_child ALTER COLUMN id SET DEFAULT nextval('item_child_id_seq'::regclass);


--
-- TOC entry 3429 (class 2604 OID 240175)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_subtype ALTER COLUMN id SET DEFAULT nextval('item_subtype_id_seq'::regclass);


--
-- TOC entry 3431 (class 2604 OID 240176)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_symbol_icon ALTER COLUMN id SET DEFAULT nextval('item_symbol_icon_id_seq'::regclass);


--
-- TOC entry 3432 (class 2604 OID 240177)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_type ALTER COLUMN id SET DEFAULT nextval('item_type_id_seq'::regclass);


--
-- TOC entry 3433 (class 2604 OID 240178)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY multimedia ALTER COLUMN id SET DEFAULT nextval('multimedia_id_seq'::regclass);


--
-- TOC entry 3435 (class 2604 OID 240179)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY need ALTER COLUMN id SET DEFAULT nextval('need_id_seq'::regclass);


--
-- TOC entry 3436 (class 2604 OID 240180)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY rating ALTER COLUMN id SET DEFAULT nextval('rating_id_seq'::regclass);


--
-- TOC entry 3443 (class 2604 OID 240181)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY reportitem ALTER COLUMN id SET DEFAULT nextval('reportitem_id_seq'::regclass);


--
-- TOC entry 3444 (class 2604 OID 240182)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY reportitem_child ALTER COLUMN id SET DEFAULT nextval('reportitem_child_id_seq'::regclass);


--
-- TOC entry 3446 (class 2604 OID 240183)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY reportitem_user ALTER COLUMN id SET DEFAULT nextval('reportitem_user_id_seq'::regclass);


--
-- TOC entry 3447 (class 2604 OID 240184)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY symbol_icon ALTER COLUMN id SET DEFAULT nextval('symbol_icon_id_seq'::regclass);


--
-- TOC entry 3452 (class 2604 OID 240185)
-- Name: id; Type: DEFAULT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY units ALTER COLUMN id SET DEFAULT nextval('units_id_seq'::regclass);


SET search_path = test_tabular_input, pg_catalog;

--
-- TOC entry 3453 (class 2604 OID 240186)
-- Name: id; Type: DEFAULT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY course ALTER COLUMN id SET DEFAULT nextval('course_id_seq'::regclass);


--
-- TOC entry 3455 (class 2604 OID 240187)
-- Name: id; Type: DEFAULT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY person ALTER COLUMN id SET DEFAULT nextval('person_id_seq'::regclass);


--
-- TOC entry 3456 (class 2604 OID 240188)
-- Name: parentid; Type: DEFAULT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY person_child ALTER COLUMN parentid SET DEFAULT nextval('person_child_parentid_seq'::regclass);


--
-- TOC entry 3457 (class 2604 OID 240189)
-- Name: childid; Type: DEFAULT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY person_child ALTER COLUMN childid SET DEFAULT nextval('person_child_childid_seq'::regclass);


--
-- TOC entry 3458 (class 2604 OID 240190)
-- Name: id; Type: DEFAULT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY student ALTER COLUMN id SET DEFAULT nextval('student_id_seq'::regclass);


--
-- TOC entry 3459 (class 2604 OID 240191)
-- Name: personid; Type: DEFAULT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY student ALTER COLUMN personid SET DEFAULT nextval('student_personid_seq'::regclass);


--
-- TOC entry 3460 (class 2604 OID 240192)
-- Name: id; Type: DEFAULT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY student_course ALTER COLUMN id SET DEFAULT nextval('student_course_id_seq'::regclass);


SET search_path = "user", pg_catalog;

--
-- TOC entry 3464 (class 2604 OID 240193)
-- Name: id; Type: DEFAULT; Schema: user; Owner: postgres
--

ALTER TABLE ONLY profile ALTER COLUMN id SET DEFAULT nextval('profile_id_seq'::regclass);


--
-- TOC entry 3468 (class 2604 OID 240194)
-- Name: id; Type: DEFAULT; Schema: user; Owner: postgres
--

ALTER TABLE ONLY role ALTER COLUMN id SET DEFAULT nextval('role_id_seq'::regclass);


--
-- TOC entry 3482 (class 2604 OID 240195)
-- Name: id; Type: DEFAULT; Schema: user; Owner: postgres
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


--
-- TOC entry 3485 (class 2604 OID 240196)
-- Name: id; Type: DEFAULT; Schema: user; Owner: postgres
--

ALTER TABLE ONLY user_auth ALTER COLUMN id SET DEFAULT nextval('user_auth_id_seq'::regclass);


--
-- TOC entry 3489 (class 2604 OID 240197)
-- Name: id; Type: DEFAULT; Schema: user; Owner: postgres
--

ALTER TABLE ONLY user_key ALTER COLUMN id SET DEFAULT nextval('user_key_id_seq'::regclass);


SET search_path = user_management, pg_catalog;

--
-- TOC entry 3490 (class 2604 OID 240198)
-- Name: id; Type: DEFAULT; Schema: user_management; Owner: postgres
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


SET search_path = public, pg_catalog;

--
-- TOC entry 3813 (class 0 OID 273417)
-- Dependencies: 250
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY migration (version, apply_time) FROM stdin;
m000000_000000_base	1423815985
m130524_201442_init	1423816013
\.


--
-- TOC entry 3405 (class 0 OID 238907)
-- Dependencies: 175
-- Data for Name: spatial_ref_sys; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
\.


--
-- TOC entry 3815 (class 0 OID 273424)
-- Dependencies: 252
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY "user" (id, username, auth_key, password_hash, password_reset_token, email, status, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3859 (class 0 OID 0)
-- Dependencies: 251
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('user_id_seq', 1, false);


SET search_path = reporting, pg_catalog;

--
-- TOC entry 3750 (class 0 OID 239925)
-- Dependencies: 187
-- Data for Name: damage; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY damage (id, reportitem_id, quantity, units_shortname, units_displayname, status) FROM stdin;
142	607	4	nos	\N	0
\.


--
-- TOC entry 3860 (class 0 OID 0)
-- Dependencies: 188
-- Name: damage_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('damage_id_seq', 142, true);


--
-- TOC entry 3752 (class 0 OID 239931)
-- Dependencies: 189
-- Data for Name: emergency_situation; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY emergency_situation (id, reportitem_id, primary_event_id, timestamp_declared, declared_by, status) FROM stdin;
\.


--
-- TOC entry 3861 (class 0 OID 0)
-- Dependencies: 190
-- Name: emergency_situation_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('emergency_situation_id_seq', 12, true);


--
-- TOC entry 3754 (class 0 OID 239937)
-- Dependencies: 191
-- Data for Name: event; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY event (id, reportitem_id, timestamp_occurance, duration, status) FROM stdin;
256	606	2015-02-12 02:30:40	\N	0
\.


--
-- TOC entry 3862 (class 0 OID 0)
-- Dependencies: 192
-- Name: event_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('event_id_seq', 256, true);


--
-- TOC entry 3756 (class 0 OID 239943)
-- Dependencies: 193
-- Data for Name: geocode; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY geocode (id, api_name, geometry_id, reportitem_id, full_address, place_name, country_name, state_name, county_name, city_name, neighborhood_name, street_address, provided_location, postal_code, type, display_latlng, geocode_quality, meta_hstore, meta_json) FROM stdin;
\.


--
-- TOC entry 3863 (class 0 OID 0)
-- Dependencies: 194
-- Name: geocode_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('geocode_id_seq', 1, false);


--
-- TOC entry 3758 (class 0 OID 239958)
-- Dependencies: 195
-- Data for Name: geometry; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY geometry (id, reportitem_id, geom, wkt, srid, type, bbox, perimeter_meter, area_sqmeter, length, latitude, longitude) FROM stdin;
119	606	0101000020E61000007094BC3AC75F554066F9BA0CFFA13B40	POINT(85.496535 27.632798)	4326	POINT	\N	\N	\N	\N	\N	\N
120	607	0101000020E610000000000000004055400000000000003D40	POINT(85 29)	4326	POINT	\N	\N	\N	\N	\N	\N
121	608	0101000020E6100000CDCCCCCCCCCC55406666666666663C40	POINT(87.2 28.4)	4326	POINT	\N	\N	\N	\N	\N	\N
\.


--
-- TOC entry 3864 (class 0 OID 0)
-- Dependencies: 196
-- Name: geometry_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('geometry_id_seq', 121, true);


--
-- TOC entry 3760 (class 0 OID 239968)
-- Dependencies: 197
-- Data for Name: incident; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY incident (id, reportitem_id, timestamp_occurance, duration, status) FROM stdin;
\.


--
-- TOC entry 3865 (class 0 OID 0)
-- Dependencies: 198
-- Name: incident_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('incident_id_seq', 11, true);


--
-- TOC entry 3762 (class 0 OID 239974)
-- Dependencies: 199
-- Data for Name: item; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY item (id, name, tags, meta_hstore, meta_json, displayname) FROM stdin;
1	Emergency Situation	\N	\N	\N	\N
2	Earthquake	\N	\N	\N	\N
3	Fire	\N	\N	\N	\N
4	Building Damage	\N	\N	\N	\N
5	Infrastructure Damage	\N	\N	\N	\N
6	Public Utilities Damage	\N	\N	\N	\N
7	Death	\N	\N	\N	\N
9	Missing	\N	\N	\N	\N
11	Property Loss	\N	\N	\N	\N
13	Water	\N	\N	\N	\N
14	Food	\N	\N	\N	\N
15	Medicine	\N	\N	\N	\N
16	Cloth	\N	\N	\N	\N
17	Rescue Vehicle	\N	\N	\N	\N
18	Human Resource	\N	\N	\N	\N
19	Shelter	\N	\N	\N	\N
10	Displaced	\N	\N	\N	\N
21	Fuel	\N	\N	\N	\N
22	Event	\N	\N	\N	\N
23	Need	\N	\N	\N	\N
25	Incident	\N	\N	\N	\N
8	Injury	\N	\N	\N	\N
12	Stranded	\N	\N	\N	\N
20	Disconnected From Service	\N	\N	\N	\N
24	Damage	\N	\N	\N	\N
\.


--
-- TOC entry 3763 (class 0 OID 239980)
-- Dependencies: 200
-- Data for Name: item_child; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY item_child (id, parent_name, child_name, parent_type, child_type) FROM stdin;
1	Emergency Situation	Event	0	1
2	Emergency Situation	Incident	0	2
4	Emergency Situation	Damage	0	3
12	Emergency Situation	Need	0	4
13	Event	Incident	1	2
14	Event	Damage	1	3
15	Event	Need	1	4
16	Incident	Damage	2	3
17	Incident	Need	2	4
18	Damage	Need	3	4
19	Earthquake	Fire	1	2
20	Earthquake	Building Damage	1	2
21	Earthquake	Infrastructure Damage	1	2
24	Earthquake	Public Utilities Damage	1	2
25	Fire	Building Damage	1	2
26	Fire	Infrastructure Damage	1	2
30	Fire	Public Utilities Damage	1	2
31	Fire	Building Damage	2	3
32	Fire	Infrastructure Damage	2	3
33	Fire	Death	2	3
34	Fire	Injury	2	3
35	Fire	Missing	2	3
36	Fire	Displaced	2	3
37	Fire	Property Loss	2	3
38	Fire	Stranded	2	3
39	Building Damage	Infrastructure Damage	1	2
40	Building Damage	Public Utilities Damage	1	2
41	Building Damage	Infrastructure Damage	2	3
42	Building Damage	Public Utilities Damage	2	3
43	Building Damage	Death	2	3
44	Building Damage	Injury	2	3
46	Building Damage	Missing	2	3
47	Building Damage	Displaced	2	3
48	Building Damage	Property Loss	2	3
49	Building Damage	Stranded	2	3
50	Infrastructure Damage	Building Damage	1	2
52	Infrastructure Damage	Public Utilities Damage	1	2
53	Infrastructure Damage	Building Damage	2	3
54	Infrastructure Damage	Public Utilities Damage	2	3
55	Infrastructure Damage	Disconnected From Service	2	3
56	Infrastructure Damage	Death	2	3
57	Infrastructure Damage	Injury	2	3
58	Infrastructure Damage	Missing	2	3
59	Infrastructure Damage	Displaced	2	3
60	Infrastructure Damage	Property Loss	2	3
61	Infrastructure Damage	Stranded	2	3
63	Public Utilities Damage	Injury	2	3
64	Public Utilities Damage	Missing	2	3
65	Public Utilities Damage	Displaced	2	3
66	Public Utilities Damage	Property Loss	2	3
67	Public Utilities Damage	Stranded	2	3
62	Public Utilities Damage	Disconnected From Service	2	3
69	Public Utilities Damage	Death	2	3
\.


--
-- TOC entry 3866 (class 0 OID 0)
-- Dependencies: 201
-- Name: item_child_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('item_child_id_seq', 69, true);


--
-- TOC entry 3867 (class 0 OID 0)
-- Dependencies: 202
-- Name: item_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('item_id_seq', 25, true);


--
-- TOC entry 3766 (class 0 OID 239988)
-- Dependencies: 203
-- Data for Name: item_subtype; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY item_subtype (id, item_name, name, description) FROM stdin;
1	Emergency Situation	Regional	\N
2	Emergency Situation	National	\N
3	Emergency Situation	Local	\N
4	Earthquake	Great	\N
5	Earthquake	Major	\N
6	Earthquake	Strong	\N
7	Earthquake	Moderate	\N
8	Earthquake	Light	\N
9	Earthquake	Minor	\N
10	Fire	Forest Fire	\N
11	Fire	Residential Fire	\N
12	Fire	Industrial Fire	\N
13	Building Damage	Residential Partial	\N
14	Building Damage	Residential Complete	\N
15	Building Damage	Public Partial	\N
16	Building Damage	Public Complete	\N
17	Building Damage	Industrial Partial	\N
18	Building Damage	Industrial Complete	\N
19	Building Damage	School Partial	\N
24	Building Damage	School Complete	\N
25	Infrastructure Damage	Bridge	\N
26	Infrastructure Damage	Overpass Bridge	\N
27	Infrastructure Damage	Road	\N
28	Infrastructure Damage	Power Plant	\N
29	Infrastructure Damage	Railway Line	\N
30	Infrastructure Damage	Transmission Line	\N
31	Public Utilities Damage	Electricity	\N
32	Public Utilities Damage	Water	\N
33	Public Utilities Damage	Sewage	\N
34	Public Utilities Damage	Fuel	\N
35	Public Utilities Damage	Tele-Communication	\N
36	Death	On Spot	\N
38	Death	On First Aid Treatment	\N
37	Death	On Way To Hospital	\N
39	Death	On Recovery	\N
42	Injury	Head Major	\N
41	Injury	Head Minor	\N
43	Injury	Body Major	\N
44	Injury	Body Minor	\N
46	Injury	Limbs Major	\N
47	Injury	Limbs Minor	\N
48	Property Loss	Crop	\N
49	Property Loss	Agricultural Land	\N
50	Property Loss	Building	\N
51	Property Loss	Cash	\N
52	Property Loss	Valuable Metal	\N
53	Property Loss	Livestocks	\N
55	Water	Drinking Purpose	\N
56	Water	General Purpose	\N
57	Medicine	First Aid Kit	\N
59	Rescue Vehicle	Ambulance	\N
60	Rescue Vehicle	Helicopter	\N
61	Rescue Vehicle	Fire Extinguisher	\N
62	Human Resource	General Medical	\N
63	Human Resource	Rescue Volunteer	\N
64	Shelter	Tent	\N
69	Fuel	Kerosene	\N
72	Fuel	LPG Gas	\N
73	Fuel	Petrol	\N
75	Fuel	Disel	\N
76	Need	Immediate	\N
77	Need	Longterm	\N
\.


--
-- TOC entry 3868 (class 0 OID 0)
-- Dependencies: 204
-- Name: item_subtype_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('item_subtype_id_seq', 77, true);


--
-- TOC entry 3768 (class 0 OID 239993)
-- Dependencies: 205
-- Data for Name: item_symbol_icon; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY item_symbol_icon (id, item_name, symbol_id, is_default) FROM stdin;
\.


--
-- TOC entry 3869 (class 0 OID 0)
-- Dependencies: 206
-- Name: item_symbol_icon_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('item_symbol_icon_id_seq', 1, false);


--
-- TOC entry 3770 (class 0 OID 239999)
-- Dependencies: 207
-- Data for Name: item_type; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY item_type (id, item_name, type, description) FROM stdin;
6	Earthquake	1	Earthquake Event
7	Fire	1	Fire Event
8	Fire	2	Fire Incident
9	Building Damage	1	Building Damage Event
10	Building Damage	2	Building Damage Incident
15	Building Damage	3	Building Damage Impact
16	Infrastructure Damage	1	Infrastructure Damage Event
17	Infrastructure Damage	2	Infrastructure Damage Incident
18	Infrastructure Damage	3	Infrastructure Damage Impact
19	Public Utilities Damage	2	Public Utilities Damage Incident
20	Public Utilities Damage	3	Public Utilities Damage Impact
21	Death	3	Death Impact
22	Injury	3	Injury Impact
23	Missing	3	Missing Impact
24	Displaced	3	Displaced Impact
25	Property Loss	3	Property Loss Impact
26	Stranded	3	Stranded Incident
27	Water	4	Water Need
28	Food	4	Food Need
29	Medicine	4	Medicine Need
30	Cloth	4	Cloth Need
31	Rescue Vehicle	4	Rescue Vehicle Need
32	Human Resource	4	Human Resource  Need
33	Shelter	4	Shelter Need
34	Disconnected From Service	3	Disconnected From Service Impact
35	Fuel	4	Fuel Need
3	Incident	2	Incident that is caused by an Event and induces Damage
2	Event	1	Events that results in multiple Incidents
1	Emergency Situation	0	An Emergency-Situation which is caused by a Primary-Event and may result in a number of Secondary-Events and cause Damages with destructive Incidents
4	Damage	3	Damage or Impact caused by  Incident and can be quantified in terms of monetary-value, number-of-people, number-of-objects etc
5	Need	4	Need can be stated in terms of items and can be quantified
\.


--
-- TOC entry 3870 (class 0 OID 0)
-- Dependencies: 208
-- Name: item_type_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('item_type_id_seq', 37, true);


--
-- TOC entry 3772 (class 0 OID 240004)
-- Dependencies: 209
-- Data for Name: multimedia; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY multimedia (id, reportitem_id, type, title, extension, thumbnail_url, description, latitude, longitude, url, path, timestamp_taken, caption, resolution_x, resolution_y, size_bytes, is_verified, tags, meta_hstore, meta_json) FROM stdin;
\.


--
-- TOC entry 3871 (class 0 OID 0)
-- Dependencies: 210
-- Name: multimedia_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('multimedia_id_seq', 1, false);


--
-- TOC entry 3774 (class 0 OID 240012)
-- Dependencies: 211
-- Data for Name: need; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY need (id, reportitem_id, quantity, units_shortname, units_displayname, status) FROM stdin;
9	608	5000	litres	\N	0
\.


--
-- TOC entry 3872 (class 0 OID 0)
-- Dependencies: 212
-- Name: need_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('need_id_seq', 9, true);


--
-- TOC entry 3776 (class 0 OID 240018)
-- Dependencies: 213
-- Data for Name: rating; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY rating (id, reportitem_id, rating, comment, is_valid, user_id, timestamp_created, timestamp_updated) FROM stdin;
\.


--
-- TOC entry 3873 (class 0 OID 0)
-- Dependencies: 214
-- Name: rating_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('rating_id_seq', 1, false);


--
-- TOC entry 3778 (class 0 OID 240023)
-- Dependencies: 215
-- Data for Name: reportitem; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY reportitem (id, type, subtype_name, item_name, title, description, is_verified, timestamp_created, timestamp_updated, tags, meta_hstore, meta_json, user_id) FROM stdin;
606	1	Great	Earthquake	\N	\N	f	2015-02-15 15:39:15	2015-02-15 15:39:15	\N	\N	\N	2
607	3	Residential Complete	Building Damage	\N	\N	f	2015-02-15 15:40:42	2015-02-15 15:40:42	\N	\N	\N	2
608	4	Drinking Purpose	Water	\N	\N	f	2015-02-15 15:41:35	2015-02-15 15:41:35	\N	\N	\N	2
\.


--
-- TOC entry 3779 (class 0 OID 240035)
-- Dependencies: 216
-- Data for Name: reportitem_child; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY reportitem_child (id, parent_id, child_id, parent_type, child_type) FROM stdin;
\.


--
-- TOC entry 3874 (class 0 OID 0)
-- Dependencies: 217
-- Name: reportitem_child_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('reportitem_child_id_seq', 89, true);


--
-- TOC entry 3875 (class 0 OID 0)
-- Dependencies: 218
-- Name: reportitem_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('reportitem_id_seq', 608, true);


--
-- TOC entry 3782 (class 0 OID 240043)
-- Dependencies: 219
-- Data for Name: reportitem_user; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY reportitem_user (id, reportitem_id, user_id, action_type, "timestamp") FROM stdin;
\.


--
-- TOC entry 3876 (class 0 OID 0)
-- Dependencies: 220
-- Name: reportitem_user_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('reportitem_user_id_seq', 1, false);


--
-- TOC entry 3784 (class 0 OID 240048)
-- Dependencies: 221
-- Data for Name: symbol_icon; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY symbol_icon (id, type, name, format, extension, path, url, size, resolution_x, resolution_y, source, description, is_verified, tags, meta_hstore, meta_json) FROM stdin;
\.


--
-- TOC entry 3877 (class 0 OID 0)
-- Dependencies: 222
-- Name: symbol_icon_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('symbol_icon_id_seq', 1, false);


--
-- TOC entry 3786 (class 0 OID 240056)
-- Dependencies: 223
-- Data for Name: units; Type: TABLE DATA; Schema: reporting; Owner: postgres
--

COPY units (id, standard, category, shortname, displayname, timestamp_created, timestamp_updated, is_verified, tags, meta_hstore, meta_json) FROM stdin;
1	SI	length	m	meter	\N	\N	f	\N	\N	\N
2	SI	area	sq m	square meter	\N	\N	f	\N	\N	\N
3	SI	liquid	l	liter	\N	\N	f	\N	\N	\N
4	SI	weight	kg	kilogram	\N	\N	f	\N	\N	\N
5	CUSTOM	count	nos	number	\N	\N	f	\N	\N	\N
6	CUSTOM	count per person	person	number of person	\N	\N	f	\N	\N	\N
\.


--
-- TOC entry 3878 (class 0 OID 0)
-- Dependencies: 224
-- Name: units_id_seq; Type: SEQUENCE SET; Schema: reporting; Owner: postgres
--

SELECT pg_catalog.setval('units_id_seq', 6, true);


SET search_path = test_tabular_input, pg_catalog;

--
-- TOC entry 3788 (class 0 OID 240068)
-- Dependencies: 225
-- Data for Name: course; Type: TABLE DATA; Schema: test_tabular_input; Owner: postgres
--

COPY course (id, title, code_title, code_no) FROM stdin;
165	Differential Calculas	MATH	207
166	Introduction To Geomatics Engineering	GEOM	101
174	Analytic Geometry	MATH	308
175	Introduction to Python Programming	COMP	103
\.


--
-- TOC entry 3879 (class 0 OID 0)
-- Dependencies: 226
-- Name: course_id_seq; Type: SEQUENCE SET; Schema: test_tabular_input; Owner: postgres
--

SELECT pg_catalog.setval('course_id_seq', 175, true);


--
-- TOC entry 3790 (class 0 OID 240073)
-- Dependencies: 227
-- Data for Name: person; Type: TABLE DATA; Schema: test_tabular_input; Owner: postgres
--

COPY person (date_of_birth, address, gender, citizenship_no, id, nationality, full_name) FROM stdin;
2014-12-12	hjbhj	f	1234567	41	qwedfgh                                                                    	sita
2014-12-12	cc	m	3244345	40	n                                                                          	gopal
2014-12-12	jhgghasdfgh	m	1234569	42	fghg                                                                       	hari
\.


--
-- TOC entry 3791 (class 0 OID 240080)
-- Dependencies: 228
-- Data for Name: person_child; Type: TABLE DATA; Schema: test_tabular_input; Owner: postgres
--

COPY person_child (parentid, childid, type) FROM stdin;
40	41	1
40	42	2
\.


--
-- TOC entry 3880 (class 0 OID 0)
-- Dependencies: 229
-- Name: person_child_childid_seq; Type: SEQUENCE SET; Schema: test_tabular_input; Owner: postgres
--

SELECT pg_catalog.setval('person_child_childid_seq', 1, false);


--
-- TOC entry 3881 (class 0 OID 0)
-- Dependencies: 230
-- Name: person_child_parentid_seq; Type: SEQUENCE SET; Schema: test_tabular_input; Owner: postgres
--

SELECT pg_catalog.setval('person_child_parentid_seq', 1, false);


--
-- TOC entry 3882 (class 0 OID 0)
-- Dependencies: 231
-- Name: person_id_seq; Type: SEQUENCE SET; Schema: test_tabular_input; Owner: postgres
--

SELECT pg_catalog.setval('person_id_seq', 42, true);


--
-- TOC entry 3795 (class 0 OID 240089)
-- Dependencies: 232
-- Data for Name: student; Type: TABLE DATA; Schema: test_tabular_input; Owner: postgres
--

COPY student (id, registration_no, personid) FROM stdin;
44	ggggggg	42
45	gggggg8	41
46	gggggg0	40
\.


--
-- TOC entry 3796 (class 0 OID 240092)
-- Dependencies: 233
-- Data for Name: student_course; Type: TABLE DATA; Schema: test_tabular_input; Owner: postgres
--

COPY student_course (id, student_registration_no, course_code_title, course_code_no, enrollment_date, gpa, completion_date) FROM stdin;
\.


--
-- TOC entry 3883 (class 0 OID 0)
-- Dependencies: 234
-- Name: student_course_id_seq; Type: SEQUENCE SET; Schema: test_tabular_input; Owner: postgres
--

SELECT pg_catalog.setval('student_course_id_seq', 14, true);


--
-- TOC entry 3884 (class 0 OID 0)
-- Dependencies: 235
-- Name: student_id_seq; Type: SEQUENCE SET; Schema: test_tabular_input; Owner: postgres
--

SELECT pg_catalog.setval('student_id_seq', 46, true);


--
-- TOC entry 3885 (class 0 OID 0)
-- Dependencies: 236
-- Name: student_personid_seq; Type: SEQUENCE SET; Schema: test_tabular_input; Owner: postgres
--

SELECT pg_catalog.setval('student_personid_seq', 13, true);


SET search_path = "user", pg_catalog;

--
-- TOC entry 3800 (class 0 OID 240101)
-- Dependencies: 237
-- Data for Name: migration; Type: TABLE DATA; Schema: user; Owner: postgres
--

COPY migration (version, apply_time) FROM stdin;
\.


--
-- TOC entry 3801 (class 0 OID 240104)
-- Dependencies: 238
-- Data for Name: profile; Type: TABLE DATA; Schema: user; Owner: postgres
--

COPY profile (id, user_id, create_time, update_time, full_name) FROM stdin;
1	2	2015-01-25 08:39:35	\N	\N
2	3	2015-01-27 16:37:14	\N	\N
\.


--
-- TOC entry 3886 (class 0 OID 0)
-- Dependencies: 239
-- Name: profile_id_seq; Type: SEQUENCE SET; Schema: user; Owner: postgres
--

SELECT pg_catalog.setval('profile_id_seq', 2, true);


--
-- TOC entry 3803 (class 0 OID 240112)
-- Dependencies: 240
-- Data for Name: role; Type: TABLE DATA; Schema: user; Owner: postgres
--

COPY role (id, name, create_time, update_time, can_admin) FROM stdin;
1	Admin	\N	\N	1
2	User	\N	\N	0
\.


--
-- TOC entry 3887 (class 0 OID 0)
-- Dependencies: 241
-- Name: role_id_seq; Type: SEQUENCE SET; Schema: user; Owner: postgres
--

SELECT pg_catalog.setval('role_id_seq', 2, true);


--
-- TOC entry 3805 (class 0 OID 240120)
-- Dependencies: 242
-- Data for Name: user; Type: TABLE DATA; Schema: user; Owner: postgres
--

COPY "user" (id, role_id, status, email, new_email, username, password, auth_key, api_key, login_ip, login_time, create_ip, create_time, update_time, ban_time, ban_reason) FROM stdin;
3	2	1	sendmail4ram@gmail.com	\N	\N	$2y$13$RHQyIwM1hQnSGGeaCmzkbOFYzLH6Aso2NeCXgiZR8DlslAjcHVlju	SeiC9abvAK_5jH2U_nbqzZejrQCDPvWl	zALauhhbdfe_c12mvjo52CTER01pRVRm	127.0.0.1	2015-01-30 23:22:58	127.0.0.1	2015-01-27 16:37:13	2015-01-27 16:43:36	\N	\N
2	2	1	ram_shresh@hotmail.com	\N	\N	$2y$13$KyzpRNfoxnQM.3vbxsbj7.M7cVNsnw8p/7FSaTXKeNRE50Ok2Ie1.	X-tW6jgeJ5h0Iu0gaPyIoozrxiv_zBGA	u11L7tK7iAc11ISKrU6op5UCLvuxgvD0	127.0.0.1	2015-02-16 03:59:04	127.0.0.1	2015-01-25 08:39:35	\N	\N	\N
\.


--
-- TOC entry 3806 (class 0 OID 240139)
-- Dependencies: 243
-- Data for Name: user_auth; Type: TABLE DATA; Schema: user; Owner: postgres
--

COPY user_auth (id, user_id, provider, provider_id, provider_attributes, create_time, update_time) FROM stdin;
\.


--
-- TOC entry 3888 (class 0 OID 0)
-- Dependencies: 244
-- Name: user_auth_id_seq; Type: SEQUENCE SET; Schema: user; Owner: postgres
--

SELECT pg_catalog.setval('user_auth_id_seq', 1, false);


--
-- TOC entry 3889 (class 0 OID 0)
-- Dependencies: 245
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: user; Owner: postgres
--

SELECT pg_catalog.setval('user_id_seq', 3, true);


--
-- TOC entry 3809 (class 0 OID 240151)
-- Dependencies: 246
-- Data for Name: user_key; Type: TABLE DATA; Schema: user; Owner: postgres
--

COPY user_key (id, user_id, type, key, create_time, consume_time, expire_time) FROM stdin;
1	2	1	HzJNX_Erjkzks-RE3VfGL_zGoICfVHAB	2015-01-25 08:39:35	2015-01-25 09:11:36	\N
2	3	1	XyRTQ5boWjutfQJ7mHMuEuYhoqcOplbZ	2015-01-27 16:37:14	2015-01-27 16:39:38	\N
3	3	3	_swTxHfjItYFNNp1yv8JU2kBVfklzCfx	2015-01-27 16:42:49	2015-01-27 16:43:36	2015-01-29 16:42:49
\.


--
-- TOC entry 3890 (class 0 OID 0)
-- Dependencies: 247
-- Name: user_key_id_seq; Type: SEQUENCE SET; Schema: user; Owner: postgres
--

SELECT pg_catalog.setval('user_key_id_seq', 3, true);


SET search_path = user_management, pg_catalog;

--
-- TOC entry 3811 (class 0 OID 240159)
-- Dependencies: 248
-- Data for Name: user; Type: TABLE DATA; Schema: user_management; Owner: postgres
--

COPY "user" (id, username, password_hash, password_reset_token, email, auth_key, role, status, created_at, updated_at) FROM stdin;
2	demo	$2y$13$KG1o1M6qUxHe2Y5KX3Ba2ONuAvslqQ8ksxNTKwAtWOL030VDuM/ka	\N	ram_shresh@hotmail.com	clGoyZ5aVc3kmGzupUqLv8Dec6lx4YCE	10	10	1421525838	1421525838
\.


--
-- TOC entry 3891 (class 0 OID 0)
-- Dependencies: 249
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: user_management; Owner: postgres
--

SELECT pg_catalog.setval('user_id_seq', 2, true);


SET search_path = public, pg_catalog;

--
-- TOC entry 3596 (class 2606 OID 273421)
-- Name: migration_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- TOC entry 3598 (class 2606 OID 273433)
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


SET search_path = reporting, pg_catalog;

--
-- TOC entry 3494 (class 2606 OID 240200)
-- Name: damage_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY damage
    ADD CONSTRAINT damage_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3496 (class 2606 OID 240202)
-- Name: emergency_situation_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY emergency_situation
    ADD CONSTRAINT emergency_situation_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3498 (class 2606 OID 240204)
-- Name: event_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY event
    ADD CONSTRAINT event_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3500 (class 2606 OID 240206)
-- Name: geocode_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY geocode
    ADD CONSTRAINT geocode_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3502 (class 2606 OID 240208)
-- Name: geometry_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY geometry
    ADD CONSTRAINT geometry_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3504 (class 2606 OID 240210)
-- Name: geometry_has_reportitem_id_and_type_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY geometry
    ADD CONSTRAINT geometry_has_reportitem_id_and_type_as_unique UNIQUE (reportitem_id, type);


--
-- TOC entry 3506 (class 2606 OID 240212)
-- Name: incident_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY incident
    ADD CONSTRAINT incident_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3514 (class 2606 OID 240214)
-- Name: item_child_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY item_child
    ADD CONSTRAINT item_child_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3508 (class 2606 OID 240216)
-- Name: item_has_displayname_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY item
    ADD CONSTRAINT item_has_displayname_as_unique UNIQUE (displayname);


--
-- TOC entry 3510 (class 2606 OID 240218)
-- Name: item_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY item
    ADD CONSTRAINT item_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3512 (class 2606 OID 240220)
-- Name: item_has_name_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY item
    ADD CONSTRAINT item_has_name_as_unique UNIQUE (name);


--
-- TOC entry 3516 (class 2606 OID 240222)
-- Name: item_subtype_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY item_subtype
    ADD CONSTRAINT item_subtype_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3518 (class 2606 OID 240224)
-- Name: item_subtype_has_item_name_and_name_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY item_subtype
    ADD CONSTRAINT item_subtype_has_item_name_and_name_as_unique UNIQUE (item_name, name);


--
-- TOC entry 3520 (class 2606 OID 240226)
-- Name: item_symbol_icon_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY item_symbol_icon
    ADD CONSTRAINT item_symbol_icon_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3522 (class 2606 OID 240228)
-- Name: item_symbol_icon_has_item_name_and_symbol_id_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY item_symbol_icon
    ADD CONSTRAINT item_symbol_icon_has_item_name_and_symbol_id_as_unique UNIQUE (item_name, symbol_id);


--
-- TOC entry 3524 (class 2606 OID 240230)
-- Name: item_type_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY item_type
    ADD CONSTRAINT item_type_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3526 (class 2606 OID 240232)
-- Name: item_type_has_item_name_and_type_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY item_type
    ADD CONSTRAINT item_type_has_item_name_and_type_as_unique UNIQUE (item_name, type);


--
-- TOC entry 3528 (class 2606 OID 240234)
-- Name: multimedia_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY multimedia
    ADD CONSTRAINT multimedia_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3530 (class 2606 OID 240236)
-- Name: need_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY need
    ADD CONSTRAINT need_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3532 (class 2606 OID 240238)
-- Name: rating_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rating
    ADD CONSTRAINT rating_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3534 (class 2606 OID 240240)
-- Name: rating_has_reportitem_id_and_user_id_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rating
    ADD CONSTRAINT rating_has_reportitem_id_and_user_id_as_unique UNIQUE (reportitem_id, user_id);


--
-- TOC entry 3540 (class 2606 OID 240522)
-- Name: reportitem_child_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY reportitem_child
    ADD CONSTRAINT reportitem_child_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3536 (class 2606 OID 240244)
-- Name: reportitem_has_id_and_type_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY reportitem
    ADD CONSTRAINT reportitem_has_id_and_type_as_unique UNIQUE (id, type);


--
-- TOC entry 3538 (class 2606 OID 240246)
-- Name: reportitem_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY reportitem
    ADD CONSTRAINT reportitem_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3542 (class 2606 OID 240248)
-- Name: reportitem_user_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY reportitem_user
    ADD CONSTRAINT reportitem_user_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3544 (class 2606 OID 240250)
-- Name: reportitem_user_has_reportitem_id_and_user_id_and_action_type_a; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY reportitem_user
    ADD CONSTRAINT reportitem_user_has_reportitem_id_and_user_id_and_action_type_a UNIQUE (reportitem_id, user_id, action_type);


--
-- TOC entry 3546 (class 2606 OID 240252)
-- Name: symbol_icon_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY symbol_icon
    ADD CONSTRAINT symbol_icon_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3548 (class 2606 OID 240254)
-- Name: symbol_icon_has_path_and_url_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY symbol_icon
    ADD CONSTRAINT symbol_icon_has_path_and_url_as_unique UNIQUE (path, url);


--
-- TOC entry 3550 (class 2606 OID 240256)
-- Name: units_has_displayname_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY units
    ADD CONSTRAINT units_has_displayname_as_unique UNIQUE (displayname);


--
-- TOC entry 3552 (class 2606 OID 240258)
-- Name: units_has_id_as_pk; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY units
    ADD CONSTRAINT units_has_id_as_pk PRIMARY KEY (id);


--
-- TOC entry 3554 (class 2606 OID 240260)
-- Name: units_has_short_name_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY units
    ADD CONSTRAINT units_has_short_name_as_unique UNIQUE (shortname);


--
-- TOC entry 3556 (class 2606 OID 240262)
-- Name: units_has_shortname_and_displayname_as_unique; Type: CONSTRAINT; Schema: reporting; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY units
    ADD CONSTRAINT units_has_shortname_and_displayname_as_unique UNIQUE (shortname, displayname);


SET search_path = test_tabular_input, pg_catalog;

--
-- TOC entry 3558 (class 2606 OID 240264)
-- Name: course_course_code_course_no_pk; Type: CONSTRAINT; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY course
    ADD CONSTRAINT course_course_code_course_no_pk PRIMARY KEY (code_title, code_no);


--
-- TOC entry 3560 (class 2606 OID 240266)
-- Name: course_id_unique; Type: CONSTRAINT; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY course
    ADD CONSTRAINT course_id_unique UNIQUE (id);


--
-- TOC entry 3566 (class 2606 OID 240268)
-- Name: m; Type: CONSTRAINT; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY person_child
    ADD CONSTRAINT m PRIMARY KEY (parentid, childid);


--
-- TOC entry 3562 (class 2606 OID 240270)
-- Name: person_citizenship_no_unique; Type: CONSTRAINT; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY person
    ADD CONSTRAINT person_citizenship_no_unique UNIQUE (citizenship_no);


--
-- TOC entry 3564 (class 2606 OID 240272)
-- Name: person_id_pk; Type: CONSTRAINT; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY person
    ADD CONSTRAINT person_id_pk PRIMARY KEY (id);


--
-- TOC entry 3572 (class 2606 OID 240274)
-- Name: student_course_id_unique; Type: CONSTRAINT; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY student_course
    ADD CONSTRAINT student_course_id_unique UNIQUE (id);


--
-- TOC entry 3574 (class 2606 OID 240276)
-- Name: student_course_pk; Type: CONSTRAINT; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY student_course
    ADD CONSTRAINT student_course_pk PRIMARY KEY (course_code_no, course_code_title, student_registration_no);


--
-- TOC entry 3576 (class 2606 OID 240278)
-- Name: student_course_unique_pk; Type: CONSTRAINT; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY student_course
    ADD CONSTRAINT student_course_unique_pk UNIQUE (student_registration_no, course_code_title, course_code_no);


--
-- TOC entry 3568 (class 2606 OID 240280)
-- Name: student_id_unique; Type: CONSTRAINT; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY student
    ADD CONSTRAINT student_id_unique UNIQUE (id);


--
-- TOC entry 3570 (class 2606 OID 240282)
-- Name: student_registration_no_pk; Type: CONSTRAINT; Schema: test_tabular_input; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY student
    ADD CONSTRAINT student_registration_no_pk PRIMARY KEY (registration_no);


SET search_path = "user", pg_catalog;

--
-- TOC entry 3578 (class 2606 OID 240284)
-- Name: migration_pkey; Type: CONSTRAINT; Schema: user; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- TOC entry 3580 (class 2606 OID 240286)
-- Name: profile_pkey; Type: CONSTRAINT; Schema: user; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY profile
    ADD CONSTRAINT profile_pkey PRIMARY KEY (id);


--
-- TOC entry 3582 (class 2606 OID 240288)
-- Name: role_pkey; Type: CONSTRAINT; Schema: user; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id);


--
-- TOC entry 3588 (class 2606 OID 240290)
-- Name: user_auth_pkey; Type: CONSTRAINT; Schema: user; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY user_auth
    ADD CONSTRAINT user_auth_pkey PRIMARY KEY (id);


--
-- TOC entry 3592 (class 2606 OID 240292)
-- Name: user_key_pkey; Type: CONSTRAINT; Schema: user; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY user_key
    ADD CONSTRAINT user_key_pkey PRIMARY KEY (id);


--
-- TOC entry 3585 (class 2606 OID 240294)
-- Name: user_pkey; Type: CONSTRAINT; Schema: user; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


SET search_path = user_management, pg_catalog;

--
-- TOC entry 3594 (class 2606 OID 240296)
-- Name: user_id_pk; Type: CONSTRAINT; Schema: user_management; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_id_pk PRIMARY KEY (id);


SET search_path = "user", pg_catalog;

--
-- TOC entry 3589 (class 1259 OID 240297)
-- Name: user_auth_provider_id; Type: INDEX; Schema: user; Owner: postgres; Tablespace: 
--

CREATE INDEX user_auth_provider_id ON user_auth USING btree (provider_id);


--
-- TOC entry 3583 (class 1259 OID 240298)
-- Name: user_email; Type: INDEX; Schema: user; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX user_email ON "user" USING btree (email);


--
-- TOC entry 3590 (class 1259 OID 240299)
-- Name: user_key_key; Type: INDEX; Schema: user; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX user_key_key ON user_key USING btree (key);


--
-- TOC entry 3586 (class 1259 OID 240300)
-- Name: user_username; Type: INDEX; Schema: user; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX user_username ON "user" USING btree (username);


SET search_path = reporting, pg_catalog;

--
-- TOC entry 3599 (class 2606 OID 240301)
-- Name: damage_has_reportitem_id_from_reportitem_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY damage
    ADD CONSTRAINT damage_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id) REFERENCES reportitem(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3600 (class 2606 OID 240311)
-- Name: emergency_situation_has_primary_event_id_from_event_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY emergency_situation
    ADD CONSTRAINT emergency_situation_has_primary_event_id_from_event_as_fk FOREIGN KEY (primary_event_id) REFERENCES event(id);


--
-- TOC entry 3601 (class 2606 OID 240316)
-- Name: emergency_situation_has_reportitem_id_from_reportitem_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY emergency_situation
    ADD CONSTRAINT emergency_situation_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id) REFERENCES reportitem(id);


--
-- TOC entry 3602 (class 2606 OID 240321)
-- Name: event_has_reportitem_id_from_reportitem_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY event
    ADD CONSTRAINT event_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id) REFERENCES reportitem(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3603 (class 2606 OID 240326)
-- Name: geocode_has_geometry_id_from_geometry_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY geocode
    ADD CONSTRAINT geocode_has_geometry_id_from_geometry_as_fk FOREIGN KEY (geometry_id) REFERENCES geometry(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3604 (class 2606 OID 240331)
-- Name: geocode_has_reportitem_id_from_reportitem_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY geocode
    ADD CONSTRAINT geocode_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id) REFERENCES reportitem(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3605 (class 2606 OID 240336)
-- Name: geometry_has_reportitem_id_from_reportitem_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY geometry
    ADD CONSTRAINT geometry_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id) REFERENCES reportitem(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3606 (class 2606 OID 240341)
-- Name: incident_has_reportitem_id_from_reportitem_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY incident
    ADD CONSTRAINT incident_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id) REFERENCES reportitem(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3607 (class 2606 OID 240346)
-- Name: item_child_has_child_name_and_child_type_from_item_type_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_child
    ADD CONSTRAINT item_child_has_child_name_and_child_type_from_item_type_as_fk FOREIGN KEY (child_name, child_type) REFERENCES item_type(item_name, type) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3608 (class 2606 OID 240351)
-- Name: item_child_has_child_name_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_child
    ADD CONSTRAINT item_child_has_child_name_as_fk FOREIGN KEY (child_name) REFERENCES item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3609 (class 2606 OID 240356)
-- Name: item_child_has_parent_name_and_parent_type_from_item_type_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_child
    ADD CONSTRAINT item_child_has_parent_name_and_parent_type_from_item_type_as_fk FOREIGN KEY (parent_name, parent_type) REFERENCES item_type(item_name, type) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3610 (class 2606 OID 240361)
-- Name: item_child_has_parent_name_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_child
    ADD CONSTRAINT item_child_has_parent_name_as_fk FOREIGN KEY (parent_name) REFERENCES item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3611 (class 2606 OID 240366)
-- Name: item_subtype_has_item_name_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_subtype
    ADD CONSTRAINT item_subtype_has_item_name_as_fk FOREIGN KEY (item_name) REFERENCES item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3612 (class 2606 OID 240371)
-- Name: item_symbol_icon_has_item_name_from_item_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_symbol_icon
    ADD CONSTRAINT item_symbol_icon_has_item_name_from_item_as_fk FOREIGN KEY (item_name) REFERENCES item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3613 (class 2606 OID 240376)
-- Name: item_symbol_icon_has_symbol_id_from_symbol_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_symbol_icon
    ADD CONSTRAINT item_symbol_icon_has_symbol_id_from_symbol_as_fk FOREIGN KEY (symbol_id) REFERENCES symbol_icon(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3614 (class 2606 OID 240381)
-- Name: item_type_has_item_name_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY item_type
    ADD CONSTRAINT item_type_has_item_name_as_fk FOREIGN KEY (item_name) REFERENCES item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3615 (class 2606 OID 240386)
-- Name: multimedia_has_reportitem_id_from_reportitem_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY multimedia
    ADD CONSTRAINT multimedia_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id) REFERENCES reportitem(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3616 (class 2606 OID 240391)
-- Name: need_has_reportitem_id_from_reportitem_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY need
    ADD CONSTRAINT need_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id) REFERENCES reportitem(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3617 (class 2606 OID 240396)
-- Name: need_has_units_shortname_and_units_displayname_from_units_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY need
    ADD CONSTRAINT need_has_units_shortname_and_units_displayname_from_units_as_fk FOREIGN KEY (units_shortname, units_displayname) REFERENCES units(shortname, displayname) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3618 (class 2606 OID 240401)
-- Name: rating_has_reportitem_id_from_reportitem_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY rating
    ADD CONSTRAINT rating_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id) REFERENCES reportitem(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3619 (class 2606 OID 240406)
-- Name: rating_has_user_id_from_user_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY rating
    ADD CONSTRAINT rating_has_user_id_from_user_as_fk FOREIGN KEY (user_id) REFERENCES "user"."user"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3624 (class 2606 OID 240516)
-- Name: reportitem_child_has_child_id_and_child_type_from_reportitem_as; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY reportitem_child
    ADD CONSTRAINT reportitem_child_has_child_id_and_child_type_from_reportitem_as FOREIGN KEY (child_id, child_type) REFERENCES reportitem(id, type) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3623 (class 2606 OID 240511)
-- Name: reportitem_child_has_parent_id_and_parent_type_from_reportitem_; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY reportitem_child
    ADD CONSTRAINT reportitem_child_has_parent_id_and_parent_type_from_reportitem_ FOREIGN KEY (parent_id, parent_type) REFERENCES reportitem(id, type) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3620 (class 2606 OID 240421)
-- Name: reportitem_has_item_name_from_item_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY reportitem
    ADD CONSTRAINT reportitem_has_item_name_from_item_as_fk FOREIGN KEY (item_name) REFERENCES item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3621 (class 2606 OID 240426)
-- Name: reportitem_has_subtype_name_and_item_name_from_item_subtype_as_; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY reportitem
    ADD CONSTRAINT reportitem_has_subtype_name_and_item_name_from_item_subtype_as_ FOREIGN KEY (subtype_name, item_name) REFERENCES item_subtype(name, item_name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3622 (class 2606 OID 297992)
-- Name: reportitem_has_user_id_from_user_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY reportitem
    ADD CONSTRAINT reportitem_has_user_id_from_user_as_fk FOREIGN KEY (user_id) REFERENCES "user"."user"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3625 (class 2606 OID 240431)
-- Name: reportitem_user_has_reportitem_id_from_reportitem_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY reportitem_user
    ADD CONSTRAINT reportitem_user_has_reportitem_id_from_reportitem_as_fk FOREIGN KEY (reportitem_id) REFERENCES reportitem(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3626 (class 2606 OID 240436)
-- Name: reportitem_user_has_user_id_from_user_as_fk; Type: FK CONSTRAINT; Schema: reporting; Owner: postgres
--

ALTER TABLE ONLY reportitem_user
    ADD CONSTRAINT reportitem_user_has_user_id_from_user_as_fk FOREIGN KEY (user_id) REFERENCES "user"."user"(id) ON UPDATE CASCADE ON DELETE CASCADE;


SET search_path = test_tabular_input, pg_catalog;

--
-- TOC entry 3627 (class 2606 OID 240441)
-- Name: jj; Type: FK CONSTRAINT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY person_child
    ADD CONSTRAINT jj FOREIGN KEY (parentid) REFERENCES person(id);


--
-- TOC entry 3628 (class 2606 OID 240446)
-- Name: kjh; Type: FK CONSTRAINT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY person_child
    ADD CONSTRAINT kjh FOREIGN KEY (childid) REFERENCES person(id);


--
-- TOC entry 3630 (class 2606 OID 240451)
-- Name: student_course_course_fk; Type: FK CONSTRAINT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY student_course
    ADD CONSTRAINT student_course_course_fk FOREIGN KEY (course_code_title, course_code_no) REFERENCES course(code_title, code_no) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 3631 (class 2606 OID 240456)
-- Name: student_course_student_fk; Type: FK CONSTRAINT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY student_course
    ADD CONSTRAINT student_course_student_fk FOREIGN KEY (student_registration_no) REFERENCES student(registration_no);


--
-- TOC entry 3629 (class 2606 OID 240461)
-- Name: student_personid_fk; Type: FK CONSTRAINT; Schema: test_tabular_input; Owner: postgres
--

ALTER TABLE ONLY student
    ADD CONSTRAINT student_personid_fk FOREIGN KEY (personid) REFERENCES person(id);


SET search_path = "user", pg_catalog;

--
-- TOC entry 3632 (class 2606 OID 240466)
-- Name: profile_user_id; Type: FK CONSTRAINT; Schema: user; Owner: postgres
--

ALTER TABLE ONLY profile
    ADD CONSTRAINT profile_user_id FOREIGN KEY (user_id) REFERENCES "user"(id);


--
-- TOC entry 3634 (class 2606 OID 240471)
-- Name: user_auth_user_id; Type: FK CONSTRAINT; Schema: user; Owner: postgres
--

ALTER TABLE ONLY user_auth
    ADD CONSTRAINT user_auth_user_id FOREIGN KEY (user_id) REFERENCES "user"(id);


--
-- TOC entry 3635 (class 2606 OID 240476)
-- Name: user_key_user_id; Type: FK CONSTRAINT; Schema: user; Owner: postgres
--

ALTER TABLE ONLY user_key
    ADD CONSTRAINT user_key_user_id FOREIGN KEY (user_id) REFERENCES "user"(id);


--
-- TOC entry 3633 (class 2606 OID 240481)
-- Name: user_role_id; Type: FK CONSTRAINT; Schema: user; Owner: postgres
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_role_id FOREIGN KEY (role_id) REFERENCES role(id);


--
-- TOC entry 3822 (class 0 OID 0)
-- Dependencies: 10
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2015-02-16 09:47:55 NPT

--
-- PostgreSQL database dump complete
--

