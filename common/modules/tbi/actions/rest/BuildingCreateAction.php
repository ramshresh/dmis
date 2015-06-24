<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2015
 * Time: 6:17 AM
 */

namespace common\modules\tbi\actions\rest;

use common\components\MyBaseAction;
use common\modules\tbi\models\Building;
use Yii;
use yii\base\Exception;
use yii\helpers\Json;

class BuildingCreateAction extends MyBaseAction
{
    public $findModel; //callable function($id,$action){}
    public $modelLoaded;
    public $scenario;

    public function init()
    {
        //@todo implement
    }

    public function run()
    {
        //@todo building sketch and before photo
        // to be specified buildingSketchGalleryBehavior,buildingPhotoGalleryBehavior in api request
        // may be with separate table and separate model
        // DEFAULT is buildingPhotoGalleryBehavior
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new Building();
            if ($model->load(Yii::$app->getRequest()->post()) && $model->save()) {

                // Try for single uploaded photo
                if (Yii::$app->request->post('photo')) {
                    $photo = Json::decode(Yii::$app->request->post('photo'));//Yii::$app->request->post('photo');
                    if (isset($photo['id']))
                        $model->getBehavior('buildingPhotoGalleryBehavior')->addTempUploadedImage($photo['id']);
                }

                // Try for multiple uploaded photos it is the array of photo
                if (Yii::$app->request->post('photos')) {
                    try {
                        $photos = Yii::$app->request->post('photos');//Yii::$app->request->post('photo');
                    }catch (Exception $e){
                        echo Json::encode(['status'=>'error','photos'=>Yii::$app->request->post('photos'),'exception'=>$e]);
                        Yii::$app->end();
                    }

                    foreach($photos as $photo){
                        $photo = Json::decode($photo);
                        if (isset($photo['id']))
                            $model->getBehavior('buildingPhotoGalleryBehavior')->addTempUploadedImage($photo['id']);
                    }
                }

                $transaction->commit();
                $this->sendSuccessResponseOnAjaxFormSubmit('saved', $model->attributes);
            }else {
                $transaction->rollBack();
                $this->sendErrorResponseOnAjaxFormSubmit([$model]);
            }
        }catch (Exception $e) {
            $transaction->rollBack();
            $this->sendExceptionErrorOnAjaxFormSubmit($e);
        }
    }
}



