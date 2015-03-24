<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\tracking\models\Coordinate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coordinate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'device_id')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'speed')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
