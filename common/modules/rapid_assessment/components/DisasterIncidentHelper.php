<?php
/**
 *Author: Ram Shrestha
 *
 */
?>
<?php

class DisasterIncidentHelper
{
    /**
     *
     */
    public static function assignImpacts($model, $items_posted)
    {
        $impacts = array();
        foreach ($items_posted as $item_post) {
            $impact = null;
            if (!empty($item_post['id'])) {
                $impact = DisasterIncidentHelper::findImpact($model, $item_post['id']);
            }
            if (is_null($impact)) {
                $impact = new Impact();
            }
            unset($item_post['id']);
            // Remove primary key
            $impact->attributes = $item_post;
            array_push($impacts, $impact);
        }
        return $impacts;
    }

    public static function findImpact($model, $id)
    {
        $impact = null;
        foreach ($model->impacts as $s) {
            if ($s->id == $id) {
                $impact = $s;
            }
        }
        return $impact;
    }

    public static function assignNeeds($model, $items_posted)
    {

        //		if($model->needs != null){
        //			$postFK=array();
        //			foreach($items_posted as $item_post){
        //				array_push($postID, $item_post['id_rna_disaster_incident']);
        //			}
        //			$modelFK
        //			foreach ($model->needs as $need ){
        //
        //			}
        //		}

        $needs = array();
        foreach ($items_posted as $item_post) {
            $need = null;
            if (!empty($item_post['id'])) {
                $need = DisasterIncidentHelper::findNeed($model, $item_post['id']);
            }
            if (is_null($need)) {
                $need = new Need();
            }
            unset($item_post['id']);
            // Remove primary key
            $need->attributes = $item_post;
            array_push($needs, $need);
        }
        return $needs;
    }

    public static function findNeed($model, $id)
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