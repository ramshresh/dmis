<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\social_media\models\Tweet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tweet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tweets')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'geom')->textInput() ?>

    <?= $form->field($model, 'status_json')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'hashtags')->textInput() ?>

    <?= $form->field($model, 'tweet_location')->textInput() ?>

    <?= $form->field($model, 'screen_name')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'date_utc')->textInput() ?>

    <?= $form->field($model, 'verified')->checkbox() ?>

    <?= $form->field($model, 'user_address')->textInput() ?>

    <?= $form->field($model, 'tweet_long')->textInput() ?>

    <?= $form->field($model, 'tweet_lat')->textInput() ?>

    <?= $form->field($model, 'user_long')->textInput() ?>

    <?= $form->field($model, 'user_lat')->textInput() ?>

    <?= $form->field($model, 'user_geom')->textInput() ?>

    <?= $form->field($model, 'media_url')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
