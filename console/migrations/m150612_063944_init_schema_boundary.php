<?php

use yii\db\Schema;
use yii\db\Migration;

class m150612_063944_init_schema_boundary extends Migration
{
    public function safeUp()
    {
$this->createSchemaBoundary();
    }

    public function safeDown()
    {
        $this->dropSchemaBoundary();
        return true;
    }

    public function createSchemaBoundary(){
        $sql = <<<SQL
CREATE SCHEMA "boundary";
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function dropSchemaBoundary(){
        $sql = <<<SQL
DROP SCHEMA IF EXISTS "boundary";
SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }
}
