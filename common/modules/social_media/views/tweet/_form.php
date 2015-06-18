<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\social_media\models\Tweet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tweet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo  $form->field($model, 'tweets')->textarea(['rows' => 6]) ?>

    <?php //echo  $form->field($model, 'geom')->textInput() ?>

    <?php //echo  $form->field($model, 'status_json')->textarea(['rows' => 6]) ?>

    <?php //echo  $form->field($model, 'date')->textInput() ?>

    <?php //echo  $form->field($model, 'hashtags')->textInput() ?>

    <?php echo  $form->field($model, 'tweet_location')->textInput() ?>

    <?php echo  $form->field($model, 'screen_name')->textInput() ?>

    <?php //echo  $form->field($model, 'user_id')->textInput() ?>

    <?php //echo  $form->field($model, 'date_utc')->textInput() ?>

    <?php //echo  $form->field($model, 'verified')->checkbox() ?>

    <?php //echo  $form->field($model, 'user_address')->textInput() ?>

    <?php echo  $form->field($model, 'tweet_long')->textInput() ?>

    <?php echo  $form->field($model, 'tweet_lat')->textInput() ?>

    <div class="row">
        <button id="btn-pointpicker-<?php echo $form->id?>" type="button" class="btn btn-xs btn-danger" style="width: 100%">
            <span class="glyphicon glyphicon-globe"></span>&nbsp;Locate on map
        </button>
    </div>
    <?php
    echo \common\widgets\pointpicker_ol2\PointPickerWidget::widget(
        [
            'latitudeId' => Html::getInputId($model,'tweet_lat'),
            'longitudeId' => Html::getInputId($model,'tweet_long'),
            'placenameId' => Html::getInputId($model,'tweet_location'),
            //'openlayersPackName' => 'openlayers', //'openlayerslPack' //,
            'triggerId'=>"btn-pointpicker-".$form->id,
            //'externalMapDivId'=>'map',
            //'wktId'=>'wkt'
        ]);
    ?>

    <?php //echo  $form->field($model, 'user_long')->textInput() ?>

    <?php //echo  $form->field($model, 'user_lat')->textInput() ?>

    <?php //echo  $form->field($model, 'user_geom')->textInput() ?>

    <?php //echo  $form->field($model, 'media_url')->textInput() ?>

    <div class="form-group">
        <?php echo  Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
