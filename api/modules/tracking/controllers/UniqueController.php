<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/31/15
 * Time: 7:45 AM
 */

namespace api\modules\tracking\controllers;

use common\modules\reporting\models\ItemChild;
use common\modules\reporting\models\ItemSubType;
use common\modules\reporting\models\ItemType;
use common\modules\tracking\models\Status;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Query;

class UniqueController extends \yii\rest\Controller
{
    public function actionIndex()
    {
        $property = $_GET['property'];
        $value = $_GET['value'];
        return [$property,$value];
        /*SELECT COUNT(*), "status" FROM  "tracking"."status" GROUP BY "status" ORDER BY "status" DESC*/
        $query = new Query();
        $query->select(['COUNT(*)','value'=>'status']);
        $query->from([Status::tableName()]);
        $query->groupBy('value');
        $query->orderBy(['count'=>SORT_ASC]);
        return $query->all();
       // return $query->createCommand()->sql;
    }

    public function actionTestGet(){
        $property = $_GET['property'];
        return [$property];
    }
}