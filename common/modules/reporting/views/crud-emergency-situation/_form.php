<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\EmergencySituation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emergency-situation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reportitem_id')->textInput() ?>

    <?= $form->field($model, 'primary_event_id')->textInput() ?>

    <?= $form->field($model, 'timestamp_declared')->textInput() ?>

    <?= $form->field($model, 'declared_by')->textInput(['maxlength' => 75]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
