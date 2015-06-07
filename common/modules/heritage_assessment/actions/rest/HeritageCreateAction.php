<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2015
 * Time: 6:17 AM
 */

namespace common\modules\heritage_assessment\actions\rest;

use common\components\MyBaseAction;
use common\modules\building_assessment\models\BuildingHousehold;
use common\modules\heritage_assessment\models\Heritage;
use common\modules\rapid_assessment\models\ReportItemIncident;
use Yii;
use yii\base\Exception;
use yii\helpers\Json;

class HeritageCreateAction extends MyBaseAction
{
    public $findModel; //callable function($id,$action){}
    public $modelLoaded;
    public $scenario;

    public function init()
    {
        //@todo implement
    }

    public function run()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new Heritage();
            if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {
                if (Yii::$app->request->post('photo')) {
                    $photo = Json::decode(Yii::$app->request->post('photo'));//Yii::$app->request->post('photo');
                    if (isset($photo['id']))
                        $model->getBehavior('galleryBehavior')->addTempUploadedImage($photo['id']);
                }
                $transaction->commit();
                $this->sendSuccessResponseOnAjaxFormSubmit('saved', $model->attributes);
            }else {
                $transaction->rollBack();
                $this->sendErrorResponseOnAjaxFormSubmit([$model]);
            }
        }catch (Exception $e) {
            $transaction->rollBack();
            $this->sendExceptionErrorOnAjaxFormSubmit($e);
        }
    }
}



