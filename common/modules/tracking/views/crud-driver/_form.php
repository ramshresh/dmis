<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\tracking\models\Driver */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="driver-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Firstname')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'Lastname')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'Address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'Phonr')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'IMEI')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'Gender')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'Ambulance_Number')->textInput(['maxlength' => 25]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
