<?php

use yii\db\Schema;
use yii\db\Migration;

class m150618_034909_create_table_social_media_twitter_status extends Migration
{
    public function safeUp()
    {
$sql = <<<SQL
CREATE TABLE "social_media".twitter_status(
    id bigserial,
    user_id bigint,
    location text,
    latitude DOUBLE PRECISION ,
    longitude DOUBLE PRECISION ,
    in_reply_to text,
    status      text NOT NULL,--The text of your status update, typically up to 140 characters. URL encode as necessary
    in_reply_to_status_id text, --The ID of an existing status that the update is in reply to. example: @username
    possibly_sensitive boolean DEFAULT FALSE ,--If you upload Tweet media that might be considered sensitive content such as nudity, violence, or medical procedures, you should set this value to true
    lat DOUBLE PRECISION DEFAULT NULL , --The latitude of the location this tweet refers to. This parameter will be ignored unless it is inside the range -90.0 to +90.0 (North is positive) inclusive. It will also be ignored if there isn’t a corresponding long parameter. example 37.7821120598956
    long DOUBLE PRECISION DEFAULT NULL , --The longitude of the location this tweet refers to. This parameter will be ignored unless it is inside the range --180.0 to +180.0 (East is positive) inclusive. It will also be ignored if there isn’t a  if geo_enabled is disabled or corresponding  lat parameter. example 87.2323443234423
    place_id text, -- A place in the world example df51dec6f4ee2b2c
    display_coordinates boolean DEFAULT true, --default true
    media_ids CHARACTER  VARYING [], -- @see https://dev.twitter.com/rest/public/uploading-media
    is_verified  boolean,
    CONSTRAINT pk_twitter_status_id PRIMARY KEY (id)
)
SQL;
Yii::$app->db->createCommand($sql)->execute();
    }

    public function safeDown()
    {
        $sql = <<<SQL
DROP TABLE "social_media".twitter_status
SQL;
Yii::$app->db->createCommand($sql)->execute();
      return true;
    }
}
