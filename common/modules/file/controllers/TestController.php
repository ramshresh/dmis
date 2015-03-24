<?php

namespace common\modules\file\controllers;

use common\modules\file\models\UploadFileSingleForm;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

class TestController extends Controller
{
    public function actionIndex()
    {
        $links=[];
        $links[]=['url'=>Url::to('single-file-upload'),'title'=>'Single File Upload'];
        return $this->render('index',['links'=>$links]);
    }
    public function actionSingleFileUpload(){
        $model = new UploadFileSingleForm();

        if (\Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
            }
        }


        return $this->render('single-file-upload/upload',[
                'model'=>$model,
            ]);
    }
}
