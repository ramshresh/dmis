<?php

use yii\db\Schema;
use yii\db\Migration;

class m150506_052618_rapid_assessment_create_view_report_item_incident extends Migration
{
    public function safeUp()
    {
$sql = <<<SQL
CREATE VIEW "rapid_assessment".report_item_incident AS SELECT * FROM "rapid_assessment".report_item WHERE type='incident'
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function safeDown()
    {
$sql=<<<SQL
DELETE VIEW "rapid_assessment".report_item_incident CASCADE ;
SQL;

        Yii::$app->db->createCommand($sql)->execute();
        //echo "m150506_052618_rapid_assessment_create_view_report_item_incident cannot be reverted.\n";
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
