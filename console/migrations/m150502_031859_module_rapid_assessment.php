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
        //$this->populateTables();
    }


    public function safeDown()
    {
        Yii::$app->db->createCommand('DROP SCHEMA IF EXISTS "rapid_assessment" CASCADE')->execute();
        return true;
    }
}
