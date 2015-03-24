<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ItemClass */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-class-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'basis')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'display_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'range')->textInput() ?>

    <?= $form->field($model, 'range_units')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'standard')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'is_verified')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
