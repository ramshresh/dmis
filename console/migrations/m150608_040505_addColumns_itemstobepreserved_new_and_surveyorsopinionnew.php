<?php

use yii\db\Schema;
use yii\db\Migration;

class m150608_040505_addColumns_itemstobepreserved_new_and_surveyorsopinionnew extends Migration
{
    public function safeUp()
    {
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN items_to_be_preserved_after TEXT;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN surveyor_opinion_after TEXT ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

    }

    public function safeDown()
    {

        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  DROP COLUMN items_to_be_preserved_after CASCADE ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $sql=<<<SQL
ALTER TABLE heritage_assessment.heritage
  DROP COLUMN surveyor_opinion_after CASCADE;
SQL;

        Yii::$app->db->createCommand($sql)->execute();

        return true;
    }

}
