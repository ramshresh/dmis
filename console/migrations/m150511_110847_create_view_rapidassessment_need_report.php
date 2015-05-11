<?php

use yii\db\Schema;
use yii\db\Migration;

class m150511_110847_create_view_rapidassessment_need_report extends Migration
{
    public function safeUp()
    {
        $sql=<<<SQL
CREATE VIEW "rapid_assessment".need AS SELECT  *  FROM (WITH need AS (
SELECT
n.id as need_report_id,
n.type   AS need_type,
n.item_name   AS need_name,
n.class_name   AS need_category,
n.magnitude   AS need_in_person,
n.supplied_per_person AS need_supplied_in_person,
n.geom as geometry

FROM "rapid_assessment".report_item as n WHERE type='need'),

 incident AS (SELECT
inc.id as incident_report_id,
inc.owner_name as owner_name,
inc.owner_contact as owner_contact,
inc.event as event,
inc.event_name as event_name,
inc.item_name as incident_name,
inc.class_name as incident_category,
inc.magnitude as incident_count,
inc.timestamp_occurance as incident_timestamp,
inc.latitude as latitude,
inc.longitude as longitude,
inc.address as address

FROM "rapid_assessment".report_item as inc WHERE type='incident')
SELECT * FROM incident
 inner join "rapid_assessment".report_item_child  rel on incident.incident_report_id = rel.parent_id
 inner join  need on need.need_report_id = rel.child_id
) as report
inner join nepal_vdc vdc on ST_Intersects(report.geometry, vdc.geom) = TRUE
SQL;

        Yii::$app->db->createCommand($sql)->execute();

    }

    public function safeDown()
    {
        $sql=<<<SQL
DROP VIEW "rapid_assessment".need CASCADE
SQL;
Yii::$app->db->createCommand($sql)->execute();

        return true;
    }

}
