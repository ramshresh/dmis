<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemMultimedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-multimedia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'report_item_id')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'extension')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'thumbnail_url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'url')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'path')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'timestamp_taken_at')->textInput() ?>

    <?= $form->field($model, 'caption')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'resolution_x')->textInput() ?>

    <?= $form->field($model, 'resolution_y')->textInput() ?>

    <?= $form->field($model, 'size_bytes')->textInput() ?>

    <?= $form->field($model, 'is_verified')->checkbox() ?>

    <?= $form->field($model, 'tags')->textInput() ?>

    <?= $form->field($model, 'meta_hstore')->textInput() ?>

    <?= $form->field($model, 'meta_json')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
