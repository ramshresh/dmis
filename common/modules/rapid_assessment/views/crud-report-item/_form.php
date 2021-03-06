<?php

use common\modules\rapid_assessment\widgets\tabular_input\report_item_multimedia\Create;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use ramshresh\yii2\galleryManager\GalleryManager;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-form">

    <?php $form = ActiveForm::begin(['options' => [
        'enctype' => 'multipart/form-data'
    ]]); ?>

    <?php //echo $form->field($model, 'type')->textInput() ?>

    <?php echo $form->field($model, 'item_name')->textInput(['maxlength' => 255]) ?>

    <?php //echo $form->field($model, 'class_basis')->textInput(['maxlength' => 255]) ?>

    <?php //echo $form->field($model, 'class_name')->textInput(['maxlength' => 255]) ?>

    <?php //echo $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?php //echo $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'is_verified')->checkbox() ?>

    <?php //echo $form->field($model, 'status')->textInput(['maxlength' => 255]) ?>

    <?php //echo $form->field($model, 'timestamp_occurance')->textInput() ?>

    <?php //echo $form->field($model, 'timestamp_created_at')->textInput() ?>

    <?php //echo $form->field($model, 'timestamp_updated_at')->textInput() ?>

    <?php //echo $form->field($model, 'tags')->textInput() ?>

    <?php //echo $form->field($model, 'meta_hstore')->textInput() ?>

    <?php //echo $form->field($model, 'meta_json')->textInput() ?>

    <?php //echo $form->field($model, 'declared_by')->textInput(['maxlength' => 255]) ?>

    <?php //echo $form->field($model, 'timestamp_declared_at')->textInput() ?>

    <?php //echo $form->field($model, 'magnitude')->textInput() ?>

    <?php //echo $form->field($model, 'units')->textInput(['maxlength' => 255]) ?>

    <?php //echo $form->field($model, 'wkt')->textarea(['rows' => 6]) ?>

    <?php // echo $form->field($model, 'geom')->textInput() ?>

    <?php // echo $form->field($model, 'latitude')->textInput() ?>

    <?php // echo $form->field($model, 'longitude')->textInput() ?>

    <?php //echo $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?php //echo $form->field($model, 'user_id')->textInput() ?>

    <?php
    if ($model->isNewRecord) {
        echo 'Can not upload images for new record';
    } else {
        echo GalleryManager::widget(
            [
                'model' => $model,
                'behaviorName' => 'galleryBehavior',
                'apiRoute' => '/rapid_assessment/crud-report-item/galleryApi'
            ]
        );
    }
    ?>
    <?php
   echo Create::widget(['form'=>$form]);
    ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
