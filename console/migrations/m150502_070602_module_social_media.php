<?php

use yii\db\Schema;
use yii\db\Migration;

class m150502_070602_module_social_media extends Migration
{
    public function safeUp()
    {
        Yii::$app->db->createCommand('CREATE SCHEMA IF NOT EXISTS "social_media";')->execute();
        Yii::$app->db->createCommand($this->createTableTweet())->execute();
    }

    public function safeDown()
    {
        Yii::$app->db->createCommand('DROP SCHEMA IF EXISTS "social_media" CASCADE;')->execute();
        return true;
    }

    public function createTableTweet(){
    $sql=<<<SQL
CREATE TABLE social_media.tweet
(
  id bigserial NOT NULL,
  tweets text,
  geom geometry,
  status_json text,
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
  media_url character varying[],
  CONSTRAINT pk_socialmedia_tweet PRIMARY KEY (id)
);
SQL;

return $sql;
    }


}
