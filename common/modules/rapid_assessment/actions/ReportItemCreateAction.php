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
use common\modules\rapid_assessment\models\ReportItemNeed;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\Json;
use yii\web\UploadedFile;

class ReportItemCreateAction extends MyBaseAction
{
    public $findModel; //callable function($id,$action){}
    public $modelLoaded;
    public function init()
    {
        //@todo implement
    }

    public function run()
    {
        if(isset($_GET['model'])){
        /**
         * possible $models : [
         *                      ReportItemEmergencySituation,
         *                      ReportItemEvent,
         *                      ReportItemIncident,
         *                      ReportItemImpact,
         *                      ReportItemNeed
         *                  ]
         */

        switch($_GET['model']){
            case ('ReportItemEmergencySituation'):
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model = new ReportItemEmergencySituation();
                    if (Yii::$app->request->post('ReportItemEvent', [])) {
                        //Loading $_POST data of related models
                        $model->events = Yii::$app->request->post('ReportItemEvent', []);
                    }
                    if (Yii::$app->request->post('ReportItemIncident', [])) {
                        //Loading $_POST data of related models
                        $model->incidents = Yii::$app->request->post('ReportItemIncident', []);
                    }
                    if (Yii::$app->request->post('ReportItemImpact', [])) {
                        //Loading $_POST data of related models
                        $model->impacts = Yii::$app->request->post('ReportItemImpact', []);
                    }
                    if (Yii::$app->request->post('ReportItemNeed', [])) {
                        //Loading $_POST data of related models
                        $model->needs = Yii::$app->request->post('ReportItemNeed', []);
                    }
                    if (Yii::$app->request->post('ReportItemNeed', [])) {
                        //Loading $_POST data of related models
                        $model->needs = Yii::$app->request->post('ReportItemNeed', []);
                    }

                    if($model->load(Yii::$app->getRequest()->getBodyParams()) && $model->save() ){
                        $transaction->commit();
                        $this->sendSuccessResponseOnAjaxFormSubmit('saved',$model->attributes);
                    }else{
                        $transaction->rollBack();
                        $this->sendErrorResponseOnAjaxFormSubmit([$model]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $this->sendExceptionErrorOnAjaxFormSubmit($e);
                }
                break;
            case ('ReportItemEvent'):
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model = new ReportItemEvent();

                    if (Yii::$app->request->post('ReportItemIncident', [])) {
                        //Loading $_POST data of related models
                        $model->incidents = Yii::$app->request->post('ReportItemIncident', []);
                    }
                    if (Yii::$app->request->post('ReportItemImpact', [])) {
                        //Loading $_POST data of related models
                        $model->impacts = Yii::$app->request->post('ReportItemImpact', []);
                    }
                    if (Yii::$app->request->post('ReportItemNeed', [])) {
                        //Loading $_POST data of related models
                        $model->needs = Yii::$app->request->post('ReportItemNeed', []);
                    }

                    if($model->load(Yii::$app->getRequest()->getBodyParams()) && $model->save() ){
                        $transaction->commit();
                        $this->sendSuccessResponseOnAjaxFormSubmit('saved',$model->attributes);
                    }else{
                        $transaction->rollBack();
                        $this->sendErrorResponseOnAjaxFormSubmit([$model]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $this->sendExceptionErrorOnAjaxFormSubmit($e);
                }
                break;
            case ('ReportItemIncident'):

               /* $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
                //$txt = "Mickey Mouse\n";
                $uf=Yii::$app->request->getBodyParam('ReportItemMultimedia');

                $txt = Json::encode($uf);

                fwrite($myfile, $txt);
                fclose($myfile);*/

                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model = new ReportItemIncident();
                    if (Yii::$app->request->getBodyParam('ReportItemEvent', [])) {
                        //Loading $_POST data of related models
                        $model->event = Yii::$app->request->post('ReportItemEvent', []);
                    }
                    if (Yii::$app->request->post('ReportItemImpact', [])) {
                        //Loading $_POST data of related models
                        $model->impacts = Yii::$app->request->post('ReportItemImpact', []);
                    }
                    if (Yii::$app->request->post('ReportItemNeed', [])) {
                        //Loading $_POST data of related models
                        $model->needs = Yii::$app->request->post('ReportItemNeed', []);
                    }
                    if (Yii::$app->request->post('ReportItemMultimedia', [])) {
                        //Loading $_POST data of related models
                        //$model->getReportItemMultimedia = Yii::$app->request->post('ReportItemMultimedia', []);
                    }
/*
                    $id='37';
                    $savedTemp=TempUploadedFile::find()
                        ->where('id > :id', [':id' => $id])
                        ->all();*/

                    if($model->load(Yii::$app->getRequest()->getBodyParams()) && $model->save() ){

                        if(Yii::$app->request->post('photo')){
                            $photo = Json::decode(Yii::$app->request->post('photo'));//Yii::$app->request->post('photo');
                            if(isset($photo['id']))
                                $model->getBehavior('galleryBehavior')->addTempUploadedImage($photo['id']);
                        }

                        $transaction->commit();
                        /*
                        return Yii::$app->request->post();
                        Yii::$app->end();*/
                        $this->sendSuccessResponseOnAjaxFormSubmit('saved',$model->attributes);
                    }else{
                        $transaction->rollBack();
                        $this->sendErrorResponseOnAjaxFormSubmit([$model]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $this->sendExceptionErrorOnAjaxFormSubmit($e);
                }
                break;
            case ('ReportItemImpact'):
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model = new ReportItemImpact();

                    if (Yii::$app->request->post('ReportItemNeed', [])) {
                        //Loading $_POST data of related models
                        $model->needs = Yii::$app->request->post('ReportItemNeed', []);
                    }

                    if($model->load(Yii::$app->getRequest()->getBodyParams()) && $model->save() ){
                        $transaction->commit();
                        $this->sendSuccessResponseOnAjaxFormSubmit('saved',$model->attributes);
                    }else{
                        $transaction->rollBack();
                        $this->sendErrorResponseOnAjaxFormSubmit([$model]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $this->sendExceptionErrorOnAjaxFormSubmit($e);
                }
                break;
            case ('ReportItemNeed'):
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model = new ReportItemNeed();

                    if($model->load(Yii::$app->getRequest()->getBodyParams()) && $model->save() ){
                        $transaction->commit();
                        $this->sendSuccessResponseOnAjaxFormSubmit('saved',$model->attributes);
                    }else{
                        $transaction->rollBack();
                        $this->sendErrorResponseOnAjaxFormSubmit([$model]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    $this->sendExceptionErrorOnAjaxFormSubmit($e);
                }
                break;
            case (new ReportItem())->load(Yii::$app->getRequest()->getBodyParams()):
                $model = new ReportItem();
                break;
            default:
               $this->sendExceptionErrorOnAjaxFormSubmit(new Exception('could not load Form Data'));
        }
        }else{
            $this->sendExceptionErrorOnAjaxFormSubmit(new Exception('Not Yet Implemented! And tor the time being, model parameter was not sent via url: HINT: submit to url http://116.90.239.21/girc/dmis/api/rapid_assessment/report-items/<model>/create  where <model> in the url must be replaced by one of : [ReportItemEmergencySituation, ReportItemEvent, ReportItemIncident, ReportItemImpact, ReportItemNeed]'));
        }
    }
}



