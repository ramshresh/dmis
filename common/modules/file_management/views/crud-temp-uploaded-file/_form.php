<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\file_management\models\TempUploadedFile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temp-uploaded-file-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'base_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'error')->textInput() ?>

    <?= $form->field($model, 'extension')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'has_error')->checkbox() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'size')->textInput() ?>

    <?= $form->field($model, 'temp_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'file')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
