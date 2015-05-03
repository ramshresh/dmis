<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ItemType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'type')->textInput() ?>
<!--
    <?/*= $form->field($model, 'description')->textInput(['maxlength' => 255]) */?>

    <?/*= $form->field($model, 'is_verified')->checkbox() */?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
