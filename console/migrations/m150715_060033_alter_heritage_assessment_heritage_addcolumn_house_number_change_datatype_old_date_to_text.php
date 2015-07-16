<?php

use yii\db\Schema;
use yii\db\Migration;

class m150715_060033_alter_heritage_assessment_heritage_addcolumn_house_number_change_datatype_old_date_to_text extends Migration
{

    public function safeUp()
    {
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage
  ADD COLUMN house_no text
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        $sql = <<<SQL
ALTER TABLE "heritage_assessment".heritage ALTER COLUMN old_date TYPE TEXT
SQL;
        Yii::$app->db->createCommand($sql)->execute();

    }
    
    public function safeDown()
    {
        $sql = <<<SQL
ALTER TABLE heritage_assessment.heritage DROP COLUMN house_no;
SQL;
        Yii::$app->db->createCommand($sql)->execute();

    }
}
