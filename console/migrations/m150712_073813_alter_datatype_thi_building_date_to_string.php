<?php

use yii\db\Schema;
use yii\db\Migration;

class m150712_073813_alter_datatype_thi_building_date_to_string extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $sql = <<<SQL
ALTER TABLE "heritage_assessment".heritage ALTER COLUMN d_code TYPE INTEGER
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE "heritage_assessment".heritage ALTER COLUMN v_code TYPE INTEGER
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE "heritage_assessment".heritage ALTER COLUMN ward_no TYPE INTEGER
SQL;
        Yii::$app->db->createCommand($sql)->execute();

    }

    public function safeDown()
    {
        $sql = <<<SQL
ALTER TABLE "tbi".building ALTER COLUMN year_of_construction TYPE CHARACTER  VARYING (225)
SQL;
        Yii::$app->db->createCommand($sql)->execute();

     }
}
