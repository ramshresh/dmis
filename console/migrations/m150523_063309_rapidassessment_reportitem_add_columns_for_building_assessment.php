<?php

use yii\db\Schema;
use yii\db\Migration;

class m150523_063309_rapidassessment_reportitem_add_columns_for_building_assessment extends Migration
{
    public function safeUp()
    {//'current_condition','construction_type','occupancy_type','current_income_status'
        $sql = <<<SQL
ALTER TABLE rapid_assessment.report_item
  ADD COLUMN current_condition text DEFAULT '';
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql = <<<SQL
ALTER TABLE rapid_assessment.report_item
  ADD COLUMN construction_type text DEFAULT '';
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE rapid_assessment.report_item
  ADD COLUMN occupancy_type text DEFAULT  '';
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE rapid_assessment.report_item
  ADD COLUMN current_income_status text DEFAULT '';
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function safeDown()
    {
        /*
         ALTER TABLE rapid_assessment.report_item
  DROP COLUMN current_condition;
ALTER TABLE rapid_assessment.report_item
  DROP COLUMN construction_type;
ALTER TABLE rapid_assessment.report_item
  DROP COLUMN occupancy_type;
ALTER TABLE rapid_assessment.report_item
  DROP COLUMN current_income_status;
         */

        $sql=<<<SQL
ALTER TABLE rapid_assessment.report_item
  DROP COLUMN current_condition CASCADE ;
SQL;

        Yii::$app->db->createCommand($sql)->execute();

        $sql=<<<SQL
ALTER TABLE rapid_assessment.report_item
  DROP COLUMN construction_type CASCADE ;
SQL;

        Yii::$app->db->createCommand($sql)->execute();

        $sql=<<<SQL
ALTER TABLE rapid_assessment.report_item
  DROP COLUMN occupancy_type CASCADE ;
SQL;

        Yii::$app->db->createCommand($sql)->execute();

        $sql=<<<SQL
ALTER TABLE rapid_assessment.report_item
  DROP COLUMN current_income_status CASCADE ;
SQL;

        Yii::$app->db->createCommand($sql)->execute();


        return true;
    }
}
