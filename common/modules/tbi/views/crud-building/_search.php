<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\tbi\models\search\BuildingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="building-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'surveyor') ?>

    <?= $form->field($model, 'surveyed_by') ?>

    <?= $form->field($model, 'survey_date') ?>

    <?php // echo $form->field($model, 'owner_name') ?>

    <?php // echo $form->field($model, 'owner_contact') ?>

    <?php // echo $form->field($model, 'owner_comment') ?>

    <?php // echo $form->field($model, 'building_name') ?>

    <?php // echo $form->field($model, 'year_of_construction') ?>

    <?php // echo $form->field($model, 'no_of_storey') ?>

    <?php // echo $form->field($model, 'current_use') ?>

    <?php // echo $form->field($model, 'special_features') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'type_other') ?>

    <?php // echo $form->field($model, 'style') ?>

    <?php // echo $form->field($model, 'style_other') ?>

    <?php // echo $form->field($model, 'physical_condition') ?>

    <?php // echo $form->field($model, 'physical_condition_comment') ?>

    <?php // echo $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'settlement') ?>

    <?php // echo $form->field($model, 'ward_no') ?>

    <?php // echo $form->field($model, 'v_code') ?>

    <?php // echo $form->field($model, 'd_code') ?>

    <?php // echo $form->field($model, 'z_code') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'surveyed_at') ?>

    <?php // echo $form->field($model, 'timestamp_created_at') ?>

    <?php // echo $form->field($model, 'timestamp_updated_at') ?>

    <?php // echo $form->field($model, 'geom') ?>

    <?php // echo $form->field($model, 'wkt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
