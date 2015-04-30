<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2015
 * Time: 6:17 AM
 */

namespace common\modules\rapid_assessment\actions;

use common\components\MyBaseAction;
use common\modules\rapid_assessment\models\ReportItem;
use common\modules\rapid_assessment\models\ReportItemEmergencySituation;
use common\modules\rapid_assessment\models\ReportItemEvent;
use common\modules\rapid_assessment\models\ReportItemImpact;
use common\modules\rapid_assessment\models\ReportItemIncident;
use common\modules\rapid_assessment\models\ReportItemMultimedia;
use common\modules\rapid_assessment\models\ReportItemNeed;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\Json;
use yii\web\Response;
use yii\web\UploadedFile;

class FileUploadAction extends MyBaseAction
{
    public function init()
    {
        //@todo implement
    }

    public function run()
    {
        $model= new ReportItemMultimedia();
        if(Yii::$app->request->isPost){
            $model->file= UploadedFile::getInstance($model,'file');
            if ($model->file && $model->validate()) {
               var_dump($model->file);
                Yii::$app->end();
                $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
            }

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->response->format=Response::FORMAT_JSON;
                return ['saved'=>$model];
            } else {
                echo Json::encode($model->errors);
                Yii::$app->end();
                //$this->sendErrorResponseOnAjaxFormSubmit([$model]);
            }
        }


    }
}



