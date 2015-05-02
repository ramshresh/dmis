<?php

use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use ramshresh\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemMultimedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-multimedia-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php
    // Ajax uploads with drag and drop feature. Enable AJAX uploads by setting the `uploadUrl` property
    // in pluginOptions. You can also pass extra data to your upload URL via `uploadExtraData`. Refer
    // [plugin documentation and demos](http://plugins.krajee.com/file-input/demo) for more details
    // and options on using AJAX uploads.

   /*echo $form->field($model, 'file[]')->widget(FileInput::classname(), [
       'name' => 'file[]',
       'options'=>[
           'multiple'=>true
       ],
       'pluginOptions' => [
           'uploadUrl' => Url::to(['/site/rapid_assessment-file-upload']),
           'uploadExtraData' => [
               'album_id' => 20,
               'cat_id' => 'Nature'
           ],
           'maxFileCount' => 10
       ]
   ]);*/
   /* echo $form->field($model, 'file')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]);*/
    ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <!--
    <?/*= $form->field($model, 'report_item_id')->textInput() */?>

    <?/*= $form->field($model, 'type')->textInput(['maxlength' => 255]) */?>

    <?/*= $form->field($model, 'title')->textInput(['maxlength' => 255]) */?>

    <?/*= $form->field($model, 'extension')->textInput(['maxlength' => 255]) */?>

    <?/*= $form->field($model, 'thumbnail_url')->textarea(['rows' => 6]) */?>

    <?/*= $form->field($model, 'description')->textInput(['maxlength' => 255]) */?>

    <?/*= $form->field($model, 'latitude')->textInput() */?>

    <?/*= $form->field($model, 'longitude')->textInput() */?>

    <?/*= $form->field($model, 'url')->textarea(['rows' => 6]) */?>

    <?/*= $form->field($model, 'path')->textarea(['rows' => 6]) */?>

    <?/*= $form->field($model, 'timestamp_taken_at')->textInput() */?>

    <?/*= $form->field($model, 'caption')->textInput(['maxlength' => 255]) */?>

    <?/*= $form->field($model, 'resolution_x')->textInput() */?>

    <?/*= $form->field($model, 'resolution_y')->textInput() */?>

    <?/*= $form->field($model, 'size_bytes')->textInput() */?>

    <?/*= $form->field($model, 'is_verified')->checkbox() */?>

    <?/*= $form->field($model, 'tags')->textInput() */?>

    <?/*= $form->field($model, 'meta_hstore')->textInput() */?>

    <?/*= $form->field($model, 'meta_json')->textInput() */?>-->
    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'file')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]);
    } else {
        echo GalleryManager::widget(
            [
                'model' => $model,
                'behaviorName' => 'galleryBehavior',
                'apiRoute' => 'galleryApi'
            ]
        );
    }
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
