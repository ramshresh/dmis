<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\search\ReportItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'item_name') ?>

    <?= $form->field($model, 'class_basis') ?>

    <?= $form->field($model, 'class_name') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'is_verified')->checkbox() ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'timestamp_occurance') ?>

    <?php // echo $form->field($model, 'timestamp_created_at') ?>

    <?php // echo $form->field($model, 'timestamp_updated_at') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'meta_hstore') ?>

    <?php // echo $form->field($model, 'meta_json') ?>

    <?php // echo $form->field($model, 'declared_by') ?>

    <?php // echo $form->field($model, 'timestamp_declared_at') ?>

    <?php // echo $form->field($model, 'magnitude') ?>

    <?php // echo $form->field($model, 'units') ?>

    <?php // echo $form->field($model, 'wkt') ?>

    <?php // echo $form->field($model, 'geom') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
