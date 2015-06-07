<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2015
 * Time: 10:17 AM
 */

namespace common\components;

use \Yii;


use yii\rest\Action;
use yii\web\ServerErrorHttpException;

class MyBaseAction extends Action implements MyYiiActiveFormJsAjaxFormInterface{
    const STATUS_ERROR = 'error';
    const STATUS_SUCCESS = 'success';
    const STATUS_EXCEPTION = 'exception';
    const MESSAGE_ERROR = 'Model validation error';

    /**
     * @param $model
     *
     * @return string
     */
    public function getErrorResponseOnAjaxFormSubmit($models)
    {
        /* @var $model  \yii\db\ActiveRecord */
        $errors = [];
        /* @var $model Model */
        foreach ($models as $model) {
            $err = ['model_name'=>$model::className(),'detail'=>$model->getErrors()];
            array_push($errors, $err);
        }
        return json_encode(['status' => $this::STATUS_ERROR, 'msg' => $this::MESSAGE_ERROR, 'errors' => $errors]);
    }

    /**
     * @param $model
     *
     * @throws \yii\base\ExitException
     */
    public function sendErrorResponseOnAjaxFormSubmit($models)
    {
        $errors = [];
        /* @var $model Model */
        foreach ($models as $model) {
            $err = $model->getErrors();
            array_push($errors, $err);
        }

        echo json_encode(['status' => $this::STATUS_ERROR, 'msg' => $this::MESSAGE_ERROR, 'errors' => $errors]);
        Yii::$app->end(0);
    }



    /**
     * @param $message string
     *
     */
    public function sendSuccessResponseOnAjaxFormSubmit($message,$object=null)
    {
        echo json_encode(['status' => $this::STATUS_SUCCESS, 'msg' => $message,'object'=>$object]);
        Yii::$app->end(0);
    }

    /**
     * @param $e \yii\base\Exception
     */
    public function sendExceptionErrorOnAjaxFormSubmit($e=null)
    {
        if(!$e){// implemented in rest action
            $e=new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        echo json_encode(['status' => $this::STATUS_EXCEPTION, 'msg' => $e->getMessage()]);
        Yii::$app->end(0);
    }
}