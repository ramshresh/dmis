<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/13/15
 * Time: 2:20 AM
 */

namespace common\modules\rapid_assessment\models;

use common\modules\rapid_assessment\models\query\ReportItemQuery;
use yii\base\Exception;
use yii\helpers\Json;

/**
 * Class ReportItemEmergencySituation
 * @package common\modules\rapid_assessment\models
 *
 * @property ReportItemEvent[] $events
 * @property ReportItemIncident[] $incidents
 * @property ReportItemImpact[] $impacts
 * @property ReportItemNeed[] $needs
 */
class ReportItemEmergencySituation extends ReportItem{
    const TYPE = ReportItem::TYPE_EMERGENCY_SITUATION;
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->type=self::TYPE;
    }

    public static function find()
    {
        return new ReportItemQuery(get_called_class(), ['type' => self::TYPE]);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getEvents() {
        return $this->hasMany(ReportItemEvent::className(), ['id' => 'child_id','type' => 'child_type'])
            //->onCondition(['type'=>ReportItem::TYPE_EVENT])
            //->viaTable(ReportItemChild::tableName(), ['parent_id' => 'id','parent_type' => 'type']);
            ->via('reportItemChildren');
    }
    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getIncidents() {
        return $this->hasMany(ReportItemIncident::className(), ['id' => 'child_id','type' => 'child_type'])
            //->onCondition(['type'=>ReportItem::TYPE_INCIDENT])
            //->viaTable(ReportItemChild::tableName(), ['parent_id' => 'id','parent_type' => 'type']);
            ->via('reportItemChildren');
    }
    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getImpacts() {
        return $this->hasMany(ReportItemImpact::className(), ['id' => 'child_id','type' => 'child_type'])
            //->onCondition(['type'=>ReportItem::TYPE_IMPACT])
            //->viaTable(ReportItemChild::tableName(),
            // ['parent_id' => 'id','parent_type' => 'type']);
            ->via('reportItemChildren');
    }
    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getNeeds() {
        return $this->hasMany(ReportItemNeed::className(), ['id' => 'child_id','type' => 'child_type'])
            //->onCondition(['type'=>ReportItem::TYPE_NEED])
            //viaTable(ReportItemChild::tableName(), ['parent_id' => 'id','parent_type' => 'type']);
            ->via('reportItemChildren');
    }



    /**
     *
     * @param $items_posted \common\modules\rapid_assessment\models\ReportItemNeed[]
     * @return array
     */
    public function loadMultipleNeeds($items_posted)
    {
        $needs = [];
        foreach ($items_posted as $item_post) {
            $need = null;
            if (!empty($item_post['id'])) {
                $need = $this->findNeed($item_post['id']);
            }
            if (is_null($need)) {
                $need = new ReportItemNeed();
            }
            unset($item_post['id']);
            // Remove primary key
            $need->attributes = $item_post;
            //    if($need->save()){
                    array_push($needs, $need);
             //   }
        }
        return $needs;
    }

    /**
     *
     * @param $items_posted \common\modules\rapid_assessment\models\ReportItemNeed[]
     * @return array
     */
    public function loadMultipleIncidents($items_posted)
    {
        $incidents = [];
        foreach ($items_posted as $item_post) {
            $incident = null;
            if (!empty($item_post['id'])) {
                $incident = $this->findIncident($item_post['id']);
            }
            if (is_null($incident)) {
                $incident = new ReportItemIncident();
            }
            unset($item_post['id']);
            // Remove primary key
            $incident->attributes = $item_post;
            //    if($need->save()){
            array_push($incidents, $incident);
            //   }
        }
        return $incidents;
    }

    public function createNeeds($items_posted){
        $needs = [];
        foreach ($items_posted as $item_post) {
            $need = null;
            if (!empty($item_post['id'])) {
                $need = $this->findNeed($item_post['id']);
            }
            if (is_null($need)) {
                $need = new ReportItemNeed();
            }
            unset($item_post['id']);
            // Remove primary key
            $need->attributes = $item_post;
            $need->save();
            $this->link('needs',$need);

            array_push($needs, $need);
        }
        return $needs;
    }

    public function findNeed($id)
    {
        $need = null;
        foreach ($this->needs as $s) {
            if ($s->id == $id) {
                $need = $s;
            }
        }
        return $need;
    }

    public function findIncident($id)
    {
        $incident = null;
        foreach ($this->incidents as $s) {
            if ($s->id == $id) {
                $incident = $s;
            }
        }
        return $incident;
    }
}