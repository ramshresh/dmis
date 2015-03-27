<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\social_media\models\searchTweetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tweet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tweets') ?>

    <?= $form->field($model, 'geom') ?>

    <?= $form->field($model, 'status_json') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'hashtags') ?>

    <?php // echo $form->field($model, 'tweet_location') ?>

    <?php // echo $form->field($model, 'screen_name') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'date_utc') ?>

    <?php // echo $form->field($model, 'verified')->checkbox() ?>

    <?php // echo $form->field($model, 'user_address') ?>

    <?php // echo $form->field($model, 'tweet_long') ?>

    <?php // echo $form->field($model, 'tweet_lat') ?>

    <?php // echo $form->field($model, 'user_long') ?>

    <?php // echo $form->field($model, 'user_lat') ?>

    <?php // echo $form->field($model, 'user_geom') ?>

    <?php // echo $form->field($model, 'media_url') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
