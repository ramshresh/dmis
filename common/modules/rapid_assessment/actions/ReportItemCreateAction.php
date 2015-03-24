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
use yii\helpers\Json;

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
        switch(true){
            case (new ReportItemEmergencySituation())->load(Yii::$app->getRequest()->getBodyParams()):

                $transaction = Yii::$app->db->beginTransaction();

                try {

                    $model = new ReportItemEmergencySituation();
                    $model->load(Yii::$app->getRequest()->getBodyParams());
                    $model->save();

                    $needsData=Yii::$app->getRequest()->getBodyParam('ReportItemNeed',[]);
                    //$multimediaData = Yii::$app->request->getBodyParam('ReportItemMultimedia', []);

                    $model->assignNeeds($needsData);

                    $check=ReportItemNeed::loadMultiple($model->needs,Yii::$app->getRequest()->getBodyParams(),'ReportItemNeed');


                    $transaction->commit();

                } catch (Exception $e) {

                    $transaction->rollBack();

                }







                Yii::$app->end();
                //////////////////////////////////////////////////

                $model = new ReportItemEmergencySituation();
                $model->load(Yii::$app->getRequest()->getBodyParams());
                $needs=[];
                $needsData=Yii::$app->getRequest()->getBodyParam('ReportItemNeed',[]);
                $multimediaData = Yii::$app->request->getBodyParam('ReportItemMultimedia', []);

                //echo Json::encode(ReportItemNeed::loadMultiple($model->needs,Yii::$app->getRequest()->getBodyParams(),'ReportItemNeed'));
                //$model->needs=$needsData;
                //$model->reportItemMultimedia=$multimediaData;
                $model->save();
                try {
                    if ( $model->save()) {
                        $this->sendSuccessResponseOnAjaxFormSubmit('saved');
                    } else {
                        $this->sendErrorResponseOnAjaxFormSubmit([$model]);
                    }
                }catch (Exception $e){
                    return $e;
                    $this->sendExceptionErrorOnAjaxFormSubmit($e);
                }
                //echo '<br>';

                echo Json::encode($multimediaData);



                // obtaining related models dada via POST request
                if (Yii::$app->request->post('ReportItemNeed', [])) {
                    //Loading $_POST data of related models
                    $needs= Yii::$app->request->post('ReportItemNeed', []);
                    /*$needs = Yii::$app->request->post('ReportItemNeed', []);
                    foreach($needs as $need){
                        $model->link('needs',$need);
                    }*/

                }



                break;
            case (new ReportItemEvent())->load(Yii::$app->getRequest()->getBodyParams()):
                $model = new ReportItemEvent();
                break;
            case (new ReportItemIncident())->load(Yii::$app->getRequest()->getBodyParams()):
                $model = new ReportItemIncident();
                break;
            case (new ReportItemImpact())->load(Yii::$app->getRequest()->getBodyParams()):
                $model = new ReportItemImpact();
                break;
            case (new ReportItemNeed())->load(Yii::$app->getRequest()->getBodyParams()):
                $model = new ReportItemNeed();
                break;
            case (new ReportItem())->load(Yii::$app->getRequest()->getBodyParams()):
                $model = new ReportItem();
                break;
            default:
               $this->sendExceptionErrorOnAjaxFormSubmit(new Exception('could not load Form Data'));
        }

        // obtaining related models dada via POST request
        if (Yii::$app->request->post('ReportItemMultimedia', [])) {
            //Loading $_POST data of related models
            $model->reportItemMultimedia = Yii::$app->request->post('ReportItemMultimedia', []);
        }
        try {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $this->sendSuccessResponseOnAjaxFormSubmit('saved');
            } else {
                $this->sendErrorResponseOnAjaxFormSubmit([$model]);
            }
        }catch (Exception $e){
            return $e;
            $this->sendExceptionErrorOnAjaxFormSubmit($e);
        }

        echo Json::encode($needs);
        echo 'kk';
        Yii::$app->end();

        return $model;
    }
}



