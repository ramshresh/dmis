<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\search\ReportItemRatingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-rating-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'report_item_id') ?>

    <?= $form->field($model, 'rating') ?>

    <?= $form->field($model, 'comment') ?>

    <?= $form->field($model, 'is_valid')->checkbox() ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'timestamp_created_at') ?>

    <?php // echo $form->field($model, 'timestamp_updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
