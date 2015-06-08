<?php

use yii\db\Schema;
use yii\db\Migration;

class m150608_041341_rename extends Migration
{

    
    public function safeUp()
    {
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  RENAME COLUMN items_to_be_preserved TO items_to_be_preserved_before ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();


        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  RENAME COLUMN surveyor_opinion TO surveyor_opinion_before ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }
    
    public function safeDown()
    {
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  RENAME COLUMN items_to_be_preserved_before TO items_to_be_preserved ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();


        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  RENAME COLUMN surveyor_opinion_before TO surveyor_opinion ;
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    return true;
    }
}
