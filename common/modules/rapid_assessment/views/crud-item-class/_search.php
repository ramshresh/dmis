<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\search\ItemClassSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-class-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'item_name') ?>

    <?= $form->field($model, 'basis') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'display_name') ?>

    <?php // echo $form->field($model, 'range') ?>

    <?php // echo $form->field($model, 'range_units') ?>

    <?php // echo $form->field($model, 'standard') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'is_verified')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
