<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\search\EmergencySituation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emergency-situation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reportitem_id') ?>

    <?= $form->field($model, 'primary_event_id') ?>

    <?= $form->field($model, 'timestamp_declared') ?>

    <?= $form->field($model, 'declared_by') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
