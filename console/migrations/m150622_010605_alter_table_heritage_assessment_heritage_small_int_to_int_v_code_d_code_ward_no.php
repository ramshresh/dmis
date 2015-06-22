<?php

use yii\db\Schema;
use yii\db\Migration;

class m150622_010605_alter_table_heritage_assessment_heritage_small_int_to_int_v_code_d_code_ward_no extends Migration
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
ALTER TABLE "heritage_assessment".heritage ALTER COLUMN d_code TYPE SMALLINT
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE "heritage_assessment".heritage ALTER COLUMN v_code TYPE SMALLINT
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE "heritage_assessment".heritage ALTER COLUMN ward_no TYPE SMALLINT
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        return true;
    }
}
