<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\heritage_assessment\models\search\HeritageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="heritage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kitta_no') ?>

    <?= $form->field($model, 'damage_type') ?>

    <?= $form->field($model, 'present_physical_conditions') ?>

    <?= $form->field($model, 'historical_socio_cultural_significance') ?>

    <?php // echo $form->field($model, 'important_features') ?>

    <?php // echo $form->field($model, 'items_to_be_preserved') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'recorded_by') ?>

    <?php // echo $form->field($model, 'surveyor_opinion') ?>

    <?php // echo $form->field($model, 'old_date') ?>

    <?php // echo $form->field($model, 'new_date') ?>

    <?php // echo $form->field($model, 'timestamp_created_at') ?>

    <?php // echo $form->field($model, 'timestamp_updated_at') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'geom') ?>

    <?php // echo $form->field($model, 'wkt') ?>

    <?php // echo $form->field($model, 'd_code') ?>

    <?php // echo $form->field($model, 'v_code') ?>

    <?php // echo $form->field($model, 'ward_no') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
