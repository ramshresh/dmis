<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/31/15
 * Time: 7:45 AM
 */

namespace api\controllers;

use common\modules\reporting\models\Item;
use common\modules\reporting\models\ItemChild;
use common\modules\reporting\models\ItemSubType;
use common\modules\reporting\models\ItemType;

class SiteController extends \yii\rest\Controller{
    public function actionIndex(){
        return [1,2,3];
    }

    public function actionItems(){
        $eventItems= ItemType::find()->where('type=:type',[':type'=>ItemType::TYPE_EVENT])->all();
        $incidentItems= ItemType::find()->where('type=:type',[':type'=>ItemType::TYPE_INCIDENT])->all();
        $damageItems= ItemType::find()->where('type=:type',[':type'=>ItemType::TYPE_DAMAGE])->all();
        $needItems= ItemType::find()->where('type=:type',[':type'=>ItemType::TYPE_NEED])->all();

        $lookupItemChild =ItemChild::find()->all();
        $lookupItemSubtype=ItemSubType::find()->all();

        $data=[
            'eventItems'=>$eventItems,
            'incidentItems'=>$incidentItems,
            'damageItems'=>$damageItems,
            'needItems'=>$needItems,
            'llokupItemChild'=>$lookupItemChild,
            'lookupItemSubType'=>$lookupItemSubtype,

        ];
        return [$data];
    }
}