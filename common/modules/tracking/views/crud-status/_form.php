<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\tracking\models\Status */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'IMEI')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
