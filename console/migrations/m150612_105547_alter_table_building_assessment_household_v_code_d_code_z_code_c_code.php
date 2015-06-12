<?php

use yii\db\Schema;
use yii\db\Migration;

class m150612_105547_alter_table_building_assessment_household_v_code_d_code_z_code_c_code extends Migration
{
    public function up()
    {
        $sql = <<<SQL
ALTER TABLE "building_assessment".building_household ALTER COLUMN c_code TYPE INTEGER ;
SQL;
Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE "building_assessment".building_household ALTER COLUMN z_code TYPE INTEGER ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE "building_assessment".building_household ALTER COLUMN d_code TYPE INTEGER ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql = <<<SQL
ALTER TABLE "building_assessment".building_household ALTER COLUMN v_code TYPE INTEGER ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function down()
    {
        $sql = <<<SQL
ALTER TABLE "building_assessment".building_household ALTER COLUMN c_code TYPE SMALLINT ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE "building_assessment".building_household ALTER COLUMN z_code TYPE SMALLINT ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE "building_assessment".building_household ALTER COLUMN d_code TYPE SMALLINT ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql = <<<SQL
ALTER TABLE "building_assessment".building_household ALTER COLUMN v_code TYPE SMALLINT ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        return true;
    }

}
