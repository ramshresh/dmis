CREATE TABLE "social_media".tweet (
    id BIGSERIAL,
    tweets TEXT,
    geom GEOMETRY ,
    status_json TEXT,
    date character varying,
    hashtags character varying[],

    tweet_location character varying,
    screen_name character varying,
    user_id bigint,
    date_utc character varying,
    verified boolean,
    user_address character varying,
    tweet_long character varying,
    tweet_lat character varying,
    user_long character varying,
    user_lat character varying,
    user_geom geometry,
    media_url character varying[]
);


ALTER TABLE "social_media".tweet OWNER TO postgres;

ALTER TABLE ONLY "social_media".tweet
    ADD CONSTRAINT pk_socialmedia_tweet PRIMARY KEY (id);
