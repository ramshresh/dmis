<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/31/15
 * Time: 7:45 AM
 */

namespace api\controllers;

use common\components\AppHelper;
use common\components\response\formatter\geojson\GeoJson;
use common\components\response\formatter\geojson\models\Point;
use common\components\response\formatter\kml\Kml;
use common\modules\heritage_assessment\models\Heritage;
use common\modules\heritage_assessment\models\search\HeritageSearch;
use common\modules\reporting\models\ItemChild;
use common\modules\reporting\models\ItemSubType;
use common\modules\reporting\models\ItemType;
use common\modules\tracking\models\Status;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Query;
use Yii;
use yii\helpers\Json;
use yii\web\Request;
use yii\web\Response;

class SiteController extends \yii\rest\Controller
{
    public function actionIndex()
    {

        /*SELECT COUNT(*), "status" FROM  "tracking"."status" GROUP BY "status" ORDER BY "status" DESC*/
        $query = new Query();
        $query->select(['COUNT(*)','value'=>'status']);
        $query->from([Status::tableName()]);
        $query->groupBy('value');
        $query->orderBy(['count'=>SORT_ASC]);
        return $query->all();
       // return $query->createCommand()->sql;
    }
    public function actionTest()
    {
        return ['no-test'];
    }

    public function actionTestGeoJson(){

        /*$document = new GeoJson(); //change to "new Geojson" to generate this file
        //$document->id = 'district';

        $models=Heritage::find()->all();

        foreach($models as $model){
            $point= new Point();
            $point->value=[$model->longitude, $model->latitude];
            $point->extendedData = $model->getAttributes();
            $document->add($point);
        }
        return $document->output();*/

       \Yii::$app->response->format = 'geo_json';
        $searchModel = new HeritageSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->pagination=false;
        return $dataProvider;
        //  return Heritage::find()->all();

    }
    public function actionItems()
    {
        $eventItems = ItemType::find()->where('type=:type', [':type' => ItemType::TYPE_EVENT])->all();
        $incidentItems = ItemType::find()->where('type=:type', [':type' => ItemType::TYPE_INCIDENT])->all();
        $damageItems = ItemType::find()->where('type=:type', [':type' => ItemType::TYPE_DAMAGE])->all();
        $needItems = ItemType::find()->where('type=:type', [':type' => ItemType::TYPE_NEED])->all();

        $lookupItemChild = ItemChild::find()->all();
        $lookupItemSubtype = ItemSubType::find()->all();

        $data = [
            'eventItems' => $eventItems,
            'incidentItems' => $incidentItems,
            'damageItems' => $damageItems,
            'needItems' => $needItems,
            'llokupItemChild' => $lookupItemChild,
            'lookupItemSubType' => $lookupItemSubtype,

        ];
        return [$data];
    }

    public function actionTestUrl(){
        return [
            Yii::$app->urlManagerBackEnd->createAbsoluteUrl(["/user/registration/confirm",  "key" => '34234']),
            Yii::$app->urlManagerFrontEnd->createAbsoluteUrl(["/user/registration/confirm",  "key" => '34234']),
        ];
    }
}