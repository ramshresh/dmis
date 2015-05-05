<?php

use yii\db\Exception;
use yii\db\Schema;
use yii\db\Migration;

class m150505_085527_alter_add_column_rapid_assessment_report_item extends Migration
{
    public function safeUp()
    {
        $sql = <<<SQL
ALTER TABLE rapid_assessment.report_item
  ADD COLUMN owner_name character varying(100);
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql = <<<SQL
ALTER TABLE rapid_assessment.report_item
  ADD COLUMN owner_contact character varying(100);
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE rapid_assessment.report_item
  ADD COLUMN supplied_per_person integer;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

    }

    public function safeDown()
    {

        $sql = <<<SQL
ALTER TABLE rapid_assessment.report_item
  DELETE  COLUMN owner_name CASCADE;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql=<<<SQL
ALTER TABLE rapid_assessment.report_item
  DELETE  COLUMN owner_contact CASCADE ;
SQL;

        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE rapid_assessment.report_item
  DELETE  COLUMN supplied_per_person CASCADE ;
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
