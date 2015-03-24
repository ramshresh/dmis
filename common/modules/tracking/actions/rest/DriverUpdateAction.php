<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2015
 * Time: 6:17 AM
 */

namespace common\modules\tracking\actions\rest;



use common\components\MyBaseAction;
use Yii;
use yii\base\Exception;

class DriverUpdateAction extends MyBaseAction
{
    public $findModel; //callable function($id,$action){}

    public function init()
    {
        //@todo implement
    }

    public function run($id)
    {
        /* @var $model ActiveRecord */
        $model = $this->findModel($id);

        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save() === false ) {
            if($model->hasErrors()){
                $this->sendErrorResponseOnAjaxFormSubmit([$model]);
            }else{
                $this->sendExceptionErrorOnAjaxFormSubmit();
            }
        }

        return $model;

        /**
         * @var $model \common\modules\tracking\models\Driver
         */

        $model = $this->findModel($id);
       /* // obtaining related models dada via POST request
        if (Yii::$app->request->post('Geometry', [])) {
            //Loading $_POST data of related models
            $model->geometries = Yii::$app->request->post('Geometry', []);
        }*/
        try {
            if ($model->load(Yii::$app->getRequest()->getBodyParams()) && $model->save()) {
                $this->sendSuccessResponseOnAjaxFormSubmit('saved');
            } else {
                if($model->load(Yii::$app->getRequest()->getBodyParams())){
                    return 'loaded';
                }else{
                    return $model;
                }
                return $model->getErrors();
                $this->sendErrorResponseOnAjaxFormSubmit([$model]);
            }
        }catch (Exception $e){
            $this->sendExceptionErrorOnAjaxFormSubmit($e);
        }
        return $model;
    }
}



