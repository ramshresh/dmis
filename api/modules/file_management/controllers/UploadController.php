<?php

namespace api\modules\file_management\controllers;

use common\modules\file_management\models\TempUploadedFile;
use yii\base\Exception;
use yii\debug\models\search\Base;
use yii\helpers\BaseFileHelper;
use yii\rest\Controller;
use yii\web\UploadedFile;
use Yii;
class UploadController extends Controller
{
    public function actionFile()
    {
//        return ['ok'];
        $response=[];
        if(UploadedFile::getInstanceByName('file')){
            $temp = new TempUploadedFile([
                'uploadedFile'=>UploadedFile::getInstanceByName('file'),
                'data'=>Yii::$app->request->post(),
            ]);
            //$temp->setUploadedFile(UploadedFile::getInstanceByName('file'),Yii::$app->request->getBodyParams());
            try{
                $temp->save();

                //$path=$savedTemp->temp_name;
                //$file=Image::getImagine()->open($path);
                return $temp;
            }catch (Exception $e){
                return ['*****ERROR**************************'=>$e,'file'=>$temp,'data'=>Yii::$app->request->post(),'type'=>gettype(Yii::$app->request->post())];
            }

        }else{
            return ['status'=>'error', 'msg'=>'file not received!'];
        }
    }
}
