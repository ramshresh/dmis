<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\tracking\models\search\Coordinate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coordinate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'device_id') ?>

    <?= $form->field($model, 'longitude') ?>

    <?= $form->field($model, 'latitude') ?>

    <?= $form->field($model, 'speed') ?>

    <?= $form->field($model, 'id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
