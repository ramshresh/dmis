<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\social_media\models\TwitterStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="twitter-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo  $form->field($model, 'user_id')->textInput() ?>

    <?php echo  $form->field($model, 'location')->textInput() ?>

    <?php //echo  $form->field($model, 'latitude')->textInput() ?>

    <?php //echo  $form->field($model, 'longitude')->textInput() ?>

    <?php //echo  $form->field($model, 'in_reply_to')->textInput() ?>

    <?php echo  $form->field($model, 'status')->textarea(['rows' => 6]) ?>

    <?php echo  $form->field($model, 'in_reply_to_status_id')->textInput() ?>

    <?php //echo  $form->field($model, 'possibly_sensitive')->checkbox() ?>

    <?php echo  $form->field($model, 'lat')->textInput() ?>

    <?php echo  $form->field($model, 'long')->textInput() ?>

    <div class="row">
        <button id="btn-pointpicker-<?=$form->id?>" type="button" class="btn btn-xs btn-danger" style="width: 100%">
            <span class="glyphicon glyphicon-globe"></span>&nbsp;Locate on map
        </button>
    </div>
    <?php
    echo \common\widgets\pointpicker_ol2\PointPickerWidget::widget(
        [
            'latitudeId' => Html::getInputId($model,'lat'),
            'longitudeId' => Html::getInputId($model,'long'),
             'placenameId' => Html::getInputId($model,'location'),
            //'openlayersPackName' => 'openlayers', //'openlayerslPack' //,
            'triggerId'=>"btn-pointpicker-".$form->id,
            //'externalMapDivId'=>'map',
            //'wktId'=>'wkt'
        ]);
    ?>

    <?php echo  $form->field($model, 'place_id')->textInput() ?>

    <?php //echo  $form->field($model, 'display_coordinates')->checkbox() ?>

    <?php //echo  $form->field($model, 'media_ids')->textInput() ?>

    <?php //echo  $form->field($model, 'is_verified')->checkbox() ?>

    <div class="form-group">
        <?php echo  Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
