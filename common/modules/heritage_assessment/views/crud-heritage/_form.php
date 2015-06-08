<?php

use kartik\widgets\FileInput;
use ramshresh\yii2\galleryManager\GalleryManager;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\heritage_assessment\models\Heritage */
/* @var $galleryImage ramshresh\yii2\galleryManager\GalleryImageAr */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="heritage-form">

    <?php $form = ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data'
        ]
    ]); ?>

    <?php echo $form->field($model, 'kitta_no')->textInput() ?>

    <?php echo $form->field($model, 'inventory_id')->textInput() ?>

    <?php echo $form->field($model, 'damage_type')->textInput() ?>

    <?php echo $form->field($model, 'present_physical_conditions')->textInput() ?>

    <?php echo $form->field($model, 'historical_socio_cultural_significance')->textInput() ?>

    <?php echo $form->field($model, 'important_features')->textInput() ?>

    <?php echo $form->field($model, 'items_to_be_preserved_before')->textInput() ?>
    <?php echo $form->field($model, 'items_to_be_preserved_after')->textInput() ?>

    <?php echo $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?php echo $form->field($model, 'recorded_by')->textInput() ?>

    <?php echo $form->field($model, 'surveyor_opinion_before')->textInput() ?>
    <?php echo $form->field($model, 'surveyor_opinion_after')->textInput() ?>

    <?php //echo $form->field($model, 'old_date')->textInput() ?>

    <?php //echo $form->field($model, 'new_date')->textInput() ?>

    <?php //echo $form->field($model, 'timestamp_created_at')->textInput() ?>

    <?php //echo $form->field($model, 'timestamp_updated_at')->textInput() ?>

    <?php echo $form->field($model, 'latitude')->textInput() ?>

    <?php echo $form->field($model, 'longitude')->textInput() ?>

    <div class="row">
        <button id="btn-pointpicker-<?=$form->id?>" type="button" class="btn btn-xs btn-danger" style="width: 100%">
            <span class="glyphicon glyphicon-globe"></span>&nbsp;Locate on map
        </button>
    </div>
    <?php
    echo \common\widgets\pointpicker_ol2\PointPickerWidget::widget(
        [
            'latitudeId' => Html::getInputId($model,'latitude'),
            'longitudeId' => Html::getInputId($model,'longitude'),
           // 'placenameId' => Html::getInputId($model,'address'),
            //'openlayersPackName' => 'openlayers', //'openlayerslPack' //,
            'triggerId'=>"btn-pointpicker-".$form->id,
            //'externalMapDivId'=>'map',
            //'wktId'=>'wkt'
        ]);
    ?>

    <?php //echo $form->field($model, 'geom')->textInput() ?>

    <?php //echo $form->field($model, 'wkt')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'd_code')->textInput() ?>

    <?php //echo $form->field($model, 'v_code')->textInput() ?>

    <?php //echo $form->field($model, 'ward_no')->textInput() ?>

    <?php //echo $form->field($model, 'user_id')->textInput() ?>

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
        echo GalleryManager::widget(
            [
                'model' => $model,
                'behaviorName' => 'galleryBehavior',
                'apiRoute' => '/heritage_assessment/crud-heritage/galleryApi'
            ]
        );
    }
    ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
