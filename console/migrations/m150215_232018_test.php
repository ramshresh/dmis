<?php

use yii\db\Migration;

class m150215_232018_test extends Migration
{

    public function up()

    {
        $ddl = file_get_contents(__DIR__ . '/dmis.ddl');
        $this->db->createCommand($ddl)->execute();
    }

    public function down()
    {
        echo "m150215_232018_test cannot be reverted.\n";

        return false;
    }
}
