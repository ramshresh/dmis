<?php

use yii\db\Schema;
use yii\db\Migration;

class m150517_081429_add_columns_rapid_assessment_report_item_income_level_income_source extends Migration
{
    public function safeUp()
    {
        $sql=<<<SQL
ALTER TABLE "rapid_assessment".report_item
  ADD COLUMN income_source character varying(100);
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql=<<<SQL
ALTER TABLE "rapid_assessment".report_item
  ADD COLUMN income_level character varying(100);
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function safeDown()
    {
        $sql=<<<SQL
ALTER TABLE "rapid_assessment".report_item
  DROP COLUMN income_source CASCADE;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql=<<<SQL
ALTER TABLE "rapid_assessment".report_item
  DROP COLUMN income_level CASCADE;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        return true;
    }
}
