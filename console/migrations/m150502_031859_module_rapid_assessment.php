<?php

use yii\db\Schema;
use yii\db\Migration;

class m150502_031859_module_rapid_assessment extends Migration
{
    public function safeUp()
    {
        Yii::$app->db->createCommand('CREATE SCHEMA IF NOT EXISTS "rapid_assessment"')->execute();
        Yii::$app->db->createCommand('CREATE EXTENSION IF NOT EXISTS postgis;')->execute();
        Yii::$app->db->createCommand('CREATE EXTENSION IF NOT EXISTS hstore;')->execute();
        $this->createTables();
    }

    public function safeDown()
    {
        Yii::$app->db->createCommand('DROP SCHEMA IF EXISTS "rapid_assessment" CASCADE')->execute();
             /*echo "m150502_005701_rapid_assessment_create_schema cannot be reverted.\n";
        return false;*/
        return true;
    }

    public function createTables(){
        $sql ='';
        Yii::$app->db->createCommand($sql)->execute();


    }
}
