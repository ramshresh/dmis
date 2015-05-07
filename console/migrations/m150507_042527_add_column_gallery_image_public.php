<?php

use yii\db\Schema;
use yii\db\Migration;

class m150507_042527_add_column_gallery_image_public extends Migration
{
    public function up()
    {
 $sql = <<<SQL
ALTER TABLE "public".gallery_image ADD COLUMN  latitude DOUBLE PRECISION;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql = <<<SQL
ALTER TABLE "public".gallery_image ADD COLUMN  longitude DOUBLE PRECISION;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql = <<<SQL
ALTER TABLE "public".gallery_image ADD COLUMN  versions JSON;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE "public".gallery_image ADD COLUMN  route CHARACTER VARYING (255);
SQL;
        Yii::$app->db->createCommand($sql)->execute();


        $sql = <<<SQL
ALTER TABLE "public".gallery_image ADD COLUMN  extension CHARACTER VARYING (255);
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }



    public function down()
    {
        echo "m150507_042527_add_column_gallery_image_public cannot be reverted.\n";

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
