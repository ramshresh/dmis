<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/19/15
 * Time: 6:20 AM
 */

namespace common\components;
use Yii;
use \yii\web\Controller;
use yii\widgets\ActiveForm;
use \common\components\MyYiiActiveFormJsAjaxFormInterface;


class MyBaseContoller extends Controller implements MyYiiActiveFormJsAjaxFormInterface{
    const STATUS_ERROR_MODEL_VALIDATION='error';
    const STATUS_SUCCESS='success';
    const STATUS_EXCEPTION = 'exception';
    const MESSAGE_ERROR_MODEL_VALIDATION='Model validation error';

    /**
     * @param $model
     *
     * @return string
     */
    public function getErrorResponseOnAjaxFormSubmit($models)
    {
        $errors=[];
        /* @var $model Model */
        foreach ($models as $model) {
            $err=$model->getErrors();
            array_push($errors,$err);
        }
        return json_encode(['status'=>$this::STATUS_ERROR_MODEL_VALIDATION,'msg'=>$this::MESSAGE_ERROR_MODEL_VALIDATION,'errors'=>$errors]);
    }

    /**
     * @param $model
     *
     * @throws \yii\base\ExitException
     */
    public function sendErrorResponseOnAjaxFormSubmit($models)
    {
        $errors=[];
        /* @var $model Model */
        foreach ($models as $model) {
            $err=$model->getErrors();
            array_push($errors,$err);
        }

        echo json_encode(['status'=>$this::STATUS_ERROR_MODEL_VALIDATION,'msg'=>$this::MESSAGE_ERROR_MODEL_VALIDATION,'errors'=>$errors]);
        Yii::$app->end(0);
    }


    /**
     * @param $message string
     *
     */
    public function sendSuccessResponseOnAjaxFormSubmit($message)
    {
        echo json_encode(['status'=>$this::STATUS_SUCCESS,'msg'=>$message]);
        Yii::$app->end(0);
    }

    /**
     * @param $e \yii\base\Exception
     */
    public  function sendExceptionErrorOnAjaxFormSubmit($e){
        echo json_encode(['status'=>$this::STATUS_EXCEPTION,'msg'=>$e->getMessage()]);
        Yii::$app->end(0);
    }
}