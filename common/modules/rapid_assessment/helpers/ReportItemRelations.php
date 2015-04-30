<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/25/2015
 * Time: 7:19 AM
 */

namespace modules\rapid_assessment\helpers;


use common\modules\rapid_assessment\models\ReportItemNeed;

class ReportItemRelations {
    /**
     * @param $model
     * @param $items_posted \common\modules\rapid_assessment\models\ReportItemNeed[]
     * @return array
     */
    public static function findMultipleReportItemNeeds($model,$items_posted)
    {
        $needs = [];
        foreach ($items_posted as $item_post) {
            $need = null;
            if (!empty($item_post['id'])) {
                $need = self::findReportItemNeed($model, $item_post['id']);
            }
            if (is_null($need)) {
                $need = new ReportItemNeed();
            }
            unset($item_post['id']);
            // Remove primary key
            $need->attributes = $item_post;
            array_push($needs, $need);
        }
        return $needs;
    }


    public static function findReportItemNeed($model, $id)
    {
        $need = null;
        foreach ($model->needs as $s) {
            if ($s->id == $id) {
                $need = $s;
            }
        }
        return $need;
    }
}