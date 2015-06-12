<?php

use yii\db\Schema;
use yii\db\Migration;

class m150609_034007_add_column_photo_before1_photo_after1_upto_3_heritage extends Migration
{
    public function safeUp()
    {
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN photo_before1 TEXT;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN photo_before2 TEXT;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN photo_before3 TEXT;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN photo_after1 TEXT;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN photo_after2 TEXT;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN photo_after3 TEXT;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

    }

    public function safeDown()
    {

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  DROP COLUMN photo_before1 CASCADE ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  DROP COLUMN photo_before2 CASCADE ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  DROP COLUMN photo_before3 CASCADE ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  DROP COLUMN photo_after1 CASCADE ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  DROP COLUMN photo_after2 CASCADE ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  DROP COLUMN photo_after3 CASCADE ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        return true;
    }

}
