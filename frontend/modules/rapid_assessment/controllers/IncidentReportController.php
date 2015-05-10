<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/10/2015
 * Time: 4:36 AM
 */

namespace frontend\modules\rapid_assessment\controllers;


use common\modules\rapid_assessment\models\ReportItem;
use common\modules\rapid_assessment\models\ReportItemIncident;
use yii\helpers\Json;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;

class IncidentReportController extends Controller {
    public function actionCreate(){
        $model = new ReportItemIncident();

        $transaction = Yii::$app->db->beginTransaction();
        try {

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
                if(UploadedFile::getInstancesByName('file')){
                    $model->getBehavior('galleryBehavior')->addImage(UploadedFile::getInstanceByName('file')->tempName);
                    $model->save();
                }

                if(Yii::$app->request->post('photo')){
                    $photo = Json::decode(Yii::$app->request->post('photo'));//Yii::$app->request->post('photo');
                    if(isset($photo['id']))
                        $model->getBehavior('galleryBehavior')->addTempUploadedImage($photo['id']);
                }

                $transaction->commit();
                /*
                return Yii::$app->request->post();
                Yii::$app->end();*/
               // $this->sendSuccessResponseOnAjaxFormSubmit('saved',$model->attributes);
            }else{
                $transaction->rollBack();
               // $this->sendErrorResponseOnAjaxFormSubmit([$model]);
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            //$this->sendExceptionErrorOnAjaxFormSubmit($e);
        }

        return $this->render('create',['model'=>$model]);
    }
}