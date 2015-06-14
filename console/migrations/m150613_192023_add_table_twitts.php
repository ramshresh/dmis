<?php

use yii\db\Schema;
use yii\db\Migration;

class m150613_192023_add_table_twitts extends Migration
{
    public function safeUp()
    {
$sql = <<<SQL
CREATE TABLE twitts(
tweet_id text,
code text,
is_processed INTEGER ,
created_at text,
CONSTRAINT pk_twitts_tweet_id PRIMARY KEY (tweet_id)
)
SQL;
        Yii::$app->db->createCommand($sql)->execute();

    }

    public function safeDown()
    {
        $sql = <<<SQL
DROP TABLE IF EXISTS  twitts;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        return true;
    }
}
