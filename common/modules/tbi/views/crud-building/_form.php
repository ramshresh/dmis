<?php

use kartik\file\FileInput;
use ramshresh\yii2\galleryManager\GalleryManager;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\tbi\models\Building */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="building-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'user_id')->textInput() ?>

    <?php echo $form->field($model, 'surveyor')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'surveyed_by')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'survey_date')->textInput() ?>

    <?php //echo $form->field($model, 'owner_name')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'owner_contact')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'owner_comment')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'building_name')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'year_of_construction')->textInput() ?>

    <?php //echo $form->field($model, 'no_of_storey')->textInput() ?>

    <?php //echo $form->field($model, 'current_use')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'special_features')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'type')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'type_other')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'style')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'style_other')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'physical_condition')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'physical_condition_comment')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'street')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'settlement')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'ward_no')->textInput() ?>

    <?php //echo $form->field($model, 'v_code')->textInput() ?>

    <?php //echo $form->field($model, 'd_code')->textInput() ?>

    <?php //echo $form->field($model, 'z_code')->textInput() ?>

    <?php //echo $form->field($model, 'latitude')->textInput() ?>

    <?php //echo $form->field($model, 'longitude')->textInput() ?>

    <?php //echo $form->field($model, 'surveyed_at')->textInput() ?>

    <?php //echo $form->field($model, 'timestamp_created_at')->textInput() ?>

    <?php //echo $form->field($model, 'timestamp_updated_at')->textInput() ?>

    <?php //echo $form->field($model, 'geom')->textInput() ?>

    <?php //echo $form->field($model, 'wkt')->textarea(['rows' => 6]) ?>

    <?php
    if ($model->isNewRecord) {
        echo FileInput::widget([
            'name'=>'photo[]',
            'options'=>[
                'enctype'=>'multipart/form-data',
                'accept'=>'image/*',
                'multiple'=>true
            ]]);
    } else {
        echo '<h5>Photo</h5>';
        echo GalleryManager::widget(
            [
                'model' => $model,
                'behaviorName' => 'buildingPhotoGalleryBehavior',
                'apiRoute' => '/tbi/crud-building/galleryApi'
            ]
        );
        echo '<br>';
        echo '<h5>Sketch</h5>';
        echo GalleryManager::widget(
            [
                'model' => $model,
                'behaviorName' => 'buildingSketchGalleryBehavior',
                'apiRoute' => '/tbi/crud-building/galleryApi'
            ]
        );
    }
    ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
