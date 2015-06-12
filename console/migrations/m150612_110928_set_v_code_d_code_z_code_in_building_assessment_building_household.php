<?php

use yii\db\Schema;
use yii\db\Migration;

class m150612_110928_set_v_code_d_code_z_code_in_building_assessment_building_household extends Migration
{
    public function safeUp()
    {
        $sql = <<<SQL
update
	"building_assessment".building_household  points_table
set
	(z_code,d_code,v_code) = (polygon_table.zcode,polygon_table.dcode,polygon_table.vcode)
FROM
	"boundary".nepal_vdc polygon_table
WHERE
	ST_Intersects(points_table.geom, polygon_table.geom) = TRUE
SQL;

        Yii::$app->db->createCommand($sql)->execute();
    }

    public function safeDown()
    {
        echo "m150612_110928_set_v_code_d_code_z_code_in_building_assessment_building_household cannot be reverted.\n";

        return false;
    }

}
