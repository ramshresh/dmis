<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2015
 * Time: 6:17 AM
 */

namespace common\modules\reporting\actions;



use common\components\MyBaseAction;
use common\modules\reporting\models\search\Need;
use Yii;
use yii\base\Exception;

class NeedCreateAction extends MyBaseAction
{
    public $findModel; //callable function($id,$action){}

    public function init()
    {
        //@todo implement
    }

    public function run()
    {
        $model = new Need();
        // obtaining related models dada via POST request
        if (Yii::$app->request->post('Geometry', [])) {
            //Loading $_POST data of related models
            $model->geometries = Yii::$app->request->post('Geometry', []);
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



