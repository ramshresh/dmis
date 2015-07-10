<?php

use yii\db\Schema;
use yii\db\Migration;

class m150709_233602_add_columns_to_heritage_assessment_heritage extends Migration
{
    /*
     ALTER TABLE heritage_assessment.heritage
  ADD COLUMN owner_name character varying(255);
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN contact_no character varying(255);
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN present_use text;
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN construction_date_age character varying(255);
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN renovation_history text;
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN architectural_style character varying(255);

     */
    public function safeUp()
    {
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN owner_name character varying(255);
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN contact_no character varying(255);
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN present_use text;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN construction_date_age character varying(255);
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN renovation_history text;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN architectural_style character varying(255);
SQL;
        Yii::$app->db->createCommand($sql)->execute();

    }

    public function safeDown()
    {
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage DROP COLUMN owner_name;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage DROP COLUMN contact_no;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage DROP COLUMN present_use;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage DROP COLUMN construction_date_age;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage DROP COLUMN renovation_history;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage DROP COLUMN architectural_style;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        return true;
    }

}
