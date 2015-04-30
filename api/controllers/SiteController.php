<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/31/15
 * Time: 7:45 AM
 */

namespace api\controllers;

use common\components\AppHelper;
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
        /**
         * @var $urlManagerFrontEnd \yii\web\UrlManager
         * @var $urlManagerBackEnd \yii\web\UrlManager
         */
        $urlManagerFrontEnd=Yii::$app->urlManagerFrontEnd;
        $urlManagerBackendEnd=Yii::$app->urlManagerBackEnd;


        //return preg_replace("/[^\/]\w+\/$/","","http://www.google.com/page/223/");


return AppHelper::getAppBaseUrl();

        /*$appAbsoluteBaseUrl = str_replace(Yii::$app->request->getPathInfo(),'',Yii::$app->request->getAbsoluteUrl());
        $frontendAppAbsoluteBaseUrl =preg_replace("/[^\/]\w+\/$/","",$appAbsoluteBaseUrl);
        $backendAppAbsoluteBaseUrl =preg_replace("/[^\/]\w+\/$/","",$appAbsoluteBaseUrl).'/admin';
        $apiAppAbsoluteBaseUrl =preg_replace("/[^\/]\w+\/$/","",$appAbsoluteBaseUrl).'/api';

        return [Yii::$app->request->getPathInfo(),Yii::$app->request->absoluteUrl,$appAbsoluteBaseUrl, $frontendAppAbsoluteBaseUrl];*/


      /*  function clean($url) {
            $link = substr(strrchr($url, '/'), 1);
            return substr($url, 0, - strlen($link));
        }*/
      /*  preg_match("/[^\/]\w+\/$/", "http://www.google.com/page/223/", $matches);
       return preg_replace("/[^\/]\w+\/$/","","http://www.google.com/page/223/");
        $last_word = $matches[0]; // 223
        return $matches;*/

        return Json::encode([
            Yii::$app->urlManager->baseUrl,

        ]);
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
}