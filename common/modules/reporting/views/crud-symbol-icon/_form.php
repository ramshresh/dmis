<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\SymbolIcon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="symbol-icon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 75]) ?>

    <?= $form->field($model, 'format')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'extension')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'path')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'size')->textInput() ?>

    <?= $form->field($model, 'resolution_x')->textInput() ?>

    <?= $form->field($model, 'resolution_y')->textInput() ?>

    <?= $form->field($model, 'source')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_verified')->checkbox() ?>

    <?= $form->field($model, 'tags')->textInput() ?>

    <?= $form->field($model, 'meta_hstore')->textInput() ?>

    <?= $form->field($model, 'meta_json')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
