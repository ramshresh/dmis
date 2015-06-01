<?php

use kartik\widgets\FileInput;
use ramshresh\yii2\galleryManager\GalleryManager;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\building_assessment\models\BuildingHousehold */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="building-household-form">

    <?php $form = ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data',
        ]
    ]); ?>

    <?php echo $form->field($model, 'owner_name')->textInput(['maxlength' => 128]) ?>

    <?php echo $form->field($model, 'owner_contact')->textInput(['maxlength' => 128]) ?>

    <?php echo $form->field($model, 'occupancy_type')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'current_condition')->textInput(['maxlength' => 64]) ?>

    <?php echo $form->field($model, 'income_source')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'income_level')->textInput(['maxlength' => 64]) ?>

    <?php echo $form->field($model, 'construction_type')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'current_income_status')->textInput(['maxlength' => 32]) ?>

    <?php echo $form->field($model, 'damage_type')->textInput(['maxlength' => 32]) ?>

    <?php //echo $form->field($model, 'user_id')->textInput() ?>

    <?php echo $form->field($model, 'no_of_occupants')->textInput() ?>

    <?php echo $form->field($model, 'event_name')->textInput(['maxlength' => 64]) ?>

    <?php //echo $form->field($model, 'timestamp_created_at')->textInput() ?>

    <?php //echo $form->field($model, 'timestamp_updated_at')->textInput() ?>

    <?php echo $form->field($model, 'timestamp_occurance')->textInput() ?>

    <?php echo $form->field($model, 'longitude')->textInput() ?>

    <?php echo $form->field($model, 'latitude')->textInput() ?>

    <?php //echo $form->field($model, 'geom')->textInput() ?>

    <?php //echo $form->field($model, 'wkt')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'address')->textInput(['maxlength' => 128]) ?>

    <?php //echo $form->field($model, 'c_code')->textInput() ?>

    <?php //echo $form->field($model, 'z_code')->textInput() ?>

    <?php //echo $form->field($model, 'd_code')->textInput() ?>

    <?php //echo $form->field($model, 'v_code')->textInput() ?>

    <?php //echo $form->field($model, 'ward_no')->textInput() ?>

    <?php echo $form->field($model, 'impact_death')->textInput() ?>

    <?php echo $form->field($model, 'impact_injured')->textInput() ?>

    <?php echo $form->field($model, 'impact_missing')->textInput() ?>

    <?php echo $form->field($model, 'impact_displaced')->textInput() ?>

    <?php echo $form->field($model, 'impact_orphaned')->textInput() ?>

    <?php //echo $form->field($model, 'tags')->textInput() ?>

    <?php
    if ($model->isNewRecord) {
        echo FileInput::widget(['name'=>'photo','options'=>['accept'=>'image/*']]);
    } else {
        echo GalleryManager::widget(
            [
                'model' => $model,
                'behaviorName' => 'galleryBehavior',
                'apiRoute' => '/building_assessment/crud-building-household/galleryApi'
            ]
        );
    }
    ?>
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
