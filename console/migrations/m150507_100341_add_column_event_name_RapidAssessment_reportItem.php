<?php

use yii\db\Schema;
use yii\db\Migration;

class m150507_100341_add_column_event_name_RapidAssessment_reportItem extends Migration
{
    public function up()
    {
        $sql = <<<SQL
ALTER TABLE "rapid_assessment".report_item ADD COLUMN event_name CHARACTER VARYING (255);
SQL;
Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        $sql = <<<SQL
ALTER TABLE "rapid_assessment".report_item DROP COLUMN event_name;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        return true;
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
