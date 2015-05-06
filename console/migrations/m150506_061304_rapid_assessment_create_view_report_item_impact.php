<?php

use yii\db\Schema;
use yii\db\Migration;

class m150506_061304_rapid_assessment_create_view_report_item_impact extends Migration
{
    public function safeUp()
    {
        $sql = <<<SQL
CREATE VIEW "rapid_assessment".report_item_impact AS SELECT * FROM "rapid_assessment".report_item WHERE type='impact'
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function safeDown()
    {
        $sql=<<<SQL
DROP VIEW "rapid_assessment".report_item_impact CASCADE ;
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
