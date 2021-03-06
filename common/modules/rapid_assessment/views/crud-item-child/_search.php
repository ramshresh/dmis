<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\search\ItemChildSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-child-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parent_name') ?>

    <?= $form->field($model, 'child_name') ?>

    <?= $form->field($model, 'parent_type') ?>

    <?= $form->field($model, 'child_type') ?>

    <?php // echo $form->field($model, 'is_verified')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
