<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\file_management\models\search\TempUploadedFileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="temp-uploaded-file-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'base_name') ?>

    <?= $form->field($model, 'error') ?>

    <?= $form->field($model, 'extension') ?>

    <?= $form->field($model, 'has_error')->checkbox() ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'temp_name') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'file') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
