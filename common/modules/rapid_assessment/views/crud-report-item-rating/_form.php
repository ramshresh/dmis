<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemRating */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-rating-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'report_item_id')->textInput() ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => 225]) ?>

    <?= $form->field($model, 'is_valid')->checkbox() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'timestamp_created_at')->textInput() ?>

    <?= $form->field($model, 'timestamp_updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
