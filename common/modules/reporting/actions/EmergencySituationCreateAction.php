<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2015
 * Time: 6:17 AM
 */

namespace common\modules\reporting\actions;

use common\components\MyBaseAction;
use common\modules\reporting\models\EmergencySituation;
use Yii;
use yii\base\Exception;

class EmergencySituationCreateAction extends MyBaseAction
{
    public $findModel; //callable function($id,$action){}

    public function init()
    {
        //@todo implement
    }

    public function run()
    {
        $model = new EmergencySituation();
        // obtaining related models dada via POST request
        if (Yii::$app->request->post('Geometry', [])) {
            //Loading $_POST data of related models
            $model->geometries = Yii::$app->request->post('Geometry', []);
        }
        if (Yii::$app->request->post('Event', [])) {
            //Loading $_POST data of related models
            $model->events = Yii::$app->request->post('Event', []);
        }
        try {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $this->sendSuccessResponseOnAjaxFormSubmit('saved');
            } else {
                $this->sendErrorResponseOnAjaxFormSubmit([$model]);
            }
        }catch (Exception $e){
            $this->sendExceptionErrorOnAjaxFormSubmit($e);
        }
        return $model;
    }
}



