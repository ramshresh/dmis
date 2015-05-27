<?php

use yii\db\Schema;
use yii\db\Migration;

class m150525_051725_create_view_rapidassessment_reportitem_incident_need extends Migration
{
    public function safeUp()
    {
        $sql=<<<SQL
CREATE VIEW "rapid_assessment".incident_need AS
SELECT
	ri.id AS report_item_id,
	ri.event_name AS report_item_event_name,
	ri.event AS report_item_event,
	ri.type AS report_item_type,
	ri.item_name as report_item_item_name,
	ri.class_basis as  report_item_class_basis,
	ri.class_name as  report_item_class_name,
	ri.magnitude as report_item_count,
	ri.title as report_item_title,
	ri.description as report_item_description,
	ri.is_verified as report_item_is_verified,
	ri.status as report_item_status,
	ri.tags as report_item_tags,
	ri.latitude as report_item_latitude,
	ri.longitude as report_item_longitude,
	ri.address as report_item_address,
	ri.owner_name as report_item_owner_name,
	ri.owner_contact as report_item_owner_contact,
	ri.income_source as owner_income_source,
	ri.income_level as owner_income_level,
	ri.user_id as report_item_user_id,

	nd.id,
	nd.type,
	nd.item_name,
	nd.class_basis,
	nd.class_name,
	nd.magnitude,
	nd.title,
	nd.description,
	nd.is_verified,
	nd.status,
	nd.tags,
	nd.longitude,
	nd.latitude,
	nd.user_id,
	nd.supplied_per_person
FROM
	"rapid_assessment".report_item as ri
	JOIN
		"rapid_assessment".report_item_child as ri_ch
	ON
		ri_ch.parent_id = ri.id
	JOIN
		"rapid_assessment".report_item as nd
	ON
		nd.id = ri_ch.child_id
		AND
		nd.type = 'need'

SQL;

        Yii::$app->db->createCommand($sql)->execute();

    }

    public function safeDown()
    {
        $sql=<<<SQL
DROP VIEW "rapid_assessment".incident_need CASCADE
SQL;
        Yii::$app->db->createCommand($sql)->execute();

        return true;
    }

}
