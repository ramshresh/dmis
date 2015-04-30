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

class ReportItemMultimediaCreateAction extends MyBaseAction
{
    public $findModel; //callable function($id,$action){}
    public $modelLoaded;
    public function init()
    {
        //@todo implement
    }

    public function run()
    {
        $model= new ReportItemMultimedia();

        if(Yii::$app->request->isPost){
           $model->file= (UploadedFile::getInstance($model,'file'))?UploadedFile::getInstance($model,'file'):UploadedFile::getInstanceByName('file');


            if ($model->file && $model->validate()) {
                $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
            }
            if ($model->load(Yii::$app->getRequest()->getBodyParams()) && $model->save()) {
                $this->sendSuccessResponseOnAjaxFormSubmit('saved',$model->attributes);
            } else {
                $this->sendErrorResponseOnAjaxFormSubmit([$model]);
            }
        }
    }
}



