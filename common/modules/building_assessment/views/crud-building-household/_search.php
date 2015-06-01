<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\building_assessment\models\search\BuildingHouseholdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="building-household-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'owner_name') ?>

    <?= $form->field($model, 'owner_contact') ?>

    <?= $form->field($model, 'occupancy_type') ?>

    <?= $form->field($model, 'current_condition') ?>

    <?php // echo $form->field($model, 'income_source') ?>

    <?php // echo $form->field($model, 'income_level') ?>

    <?php // echo $form->field($model, 'construction_type') ?>

    <?php // echo $form->field($model, 'current_income_status') ?>

    <?php // echo $form->field($model, 'damage_type') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'no_of_occupants') ?>

    <?php // echo $form->field($model, 'event_name') ?>

    <?php // echo $form->field($model, 'timestamp_created_at') ?>

    <?php // echo $form->field($model, 'timestamp_updated_at') ?>

    <?php // echo $form->field($model, 'timestamp_occurance') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'geom') ?>

    <?php // echo $form->field($model, 'wkt') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'c_code') ?>

    <?php // echo $form->field($model, 'z_code') ?>

    <?php // echo $form->field($model, 'd_code') ?>

    <?php // echo $form->field($model, 'v_code') ?>

    <?php // echo $form->field($model, 'ward_no') ?>

    <?php // echo $form->field($model, 'impact_death') ?>

    <?php // echo $form->field($model, 'impact_injured') ?>

    <?php // echo $form->field($model, 'impact_missing') ?>

    <?php // echo $form->field($model, 'impact_displaced') ?>

    <?php // echo $form->field($model, 'impact_orphaned') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
