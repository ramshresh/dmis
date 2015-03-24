<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2015
 * Time: 6:17 AM
 */

namespace common\modules\tracking\actions\rest;



use common\components\MyBaseAction;
use common\modules\rapid_assessment\models\Item;
use Yii;
use yii\base\Exception;

class ItemCreateAction extends MyBaseAction
{
    public $findModel; //callable function($id,$action){}

    public function init()
    {
        //@todo implement
    }

    public function run()
    {

        $model = new Item();
        // obtaining related models dada via POST request
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



