<?php

use yii\db\Schema;
use yii\db\Migration;

class m150520_144211_add_column_no_of_occupants_in_rapid_assessment_report_item extends Migration
{
    public function safeUp()
    {
        $sql=<<<SQL
ALTER TABLE "rapid_assessment".report_item
  ADD COLUMN no_of_occupants integer;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
      }

    public function safeDown()
    {
        $sql=<<<SQL
ALTER TABLE "rapid_assessment".report_item
  DROP COLUMN no_of_occupants CASCADE;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        return true;
    }
}
