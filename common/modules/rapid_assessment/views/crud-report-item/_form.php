<?php

use common\modules\rapid_assessment\widgets\tabular_input\report_item_multimedia\Create;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'item_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'class_basis')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'class_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_verified')->checkbox() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'timestamp_occurance')->textInput() ?>

    <?= $form->field($model, 'timestamp_created_at')->textInput() ?>

    <?= $form->field($model, 'timestamp_updated_at')->textInput() ?>

    <?= $form->field($model, 'tags')->textInput() ?>

    <?= $form->field($model, 'meta_hstore')->textInput() ?>

    <?= $form->field($model, 'meta_json')->textInput() ?>

    <?= $form->field($model, 'declared_by')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'timestamp_declared_at')->textInput() ?>

    <?= $form->field($model, 'magnitude')->textInput() ?>

    <?= $form->field($model, 'units')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'wkt')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'geom')->textInput() ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>
    <?php
   echo Create::widget(['form'=>$form]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
