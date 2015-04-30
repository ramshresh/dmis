<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2015
 * Time: 6:17 AM
 */

namespace common\modules\rapid_assessment\actions;

use common\components\MyBaseAction;
use common\modules\rapid_assessment\models\ReportItemEmergencySituation;
use Yii;
use yii\base\Exception;

class ReportItemEmergencySituationCreateAction extends MyBaseAction
{
    public $findModel; //callable function($id,$action){}

    public function init()
    {
        //@todo implement
    }

    public function run()
    {
        $model = new ReportItemEmergencySituation();
        // obtaining related models dada via POST request
        if (Yii::$app->request->post('ReportItemNeed', [])) {
            //Loading $_POST data of related models
            $model->needs = $model->findNeeds(Yii::$app->request->post('ReportItemNeed', []));
        }

        try {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $this->sendSuccessResponseOnAjaxFormSubmit('saved');
            } else {
                $this->sendErrorResponseOnAjaxFormSubmit([$model]);
            }
        }catch (Exception $e){
            return $e;
            $this->sendExceptionErrorOnAjaxFormSubmit($e);
        }
        return $model;
    }


}



