<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\ReportItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'subtype_name')->textInput(['maxlength' => 25]) ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => 75]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 75]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_verified')->checkbox() ?>

    <?= $form->field($model, 'timestamp_created')->textInput() ?>

    <?= $form->field($model, 'timestamp_updated')->textInput() ?>

    <?= $form->field($model, 'tags')->textInput() ?>

    <?= $form->field($model, 'meta_hstore')->textInput() ?>

    <?= $form->field($model, 'meta_json')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
