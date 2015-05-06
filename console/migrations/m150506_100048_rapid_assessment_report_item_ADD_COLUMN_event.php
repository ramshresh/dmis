<?php

use yii\db\Schema;
use yii\db\Migration;

class m150506_100048_rapid_assessment_report_item_ADD_COLUMN_event extends Migration
{
    public function safeUp()
    {
$sql=<<<SQL
ALTER TABLE "rapid_assessment".report_item
  ADD COLUMN event character varying(100);
SQL;
Yii::$app->db->createCommand($sql)->execute();

    }

    public function safeDown()
    {
        $sql=<<<SQL
ALTER TABLE "rapid_assessment".report_item
  DROP COLUMN event CASCADE;
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
