<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\search\ReportItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'subtype_name') ?>

    <?= $form->field($model, 'item_name') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'is_verified')->checkbox() ?>

    <?php // echo $form->field($model, 'timestamp_created') ?>

    <?php // echo $form->field($model, 'timestamp_updated') ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'meta_hstore') ?>

    <?php // echo $form->field($model, 'meta_json') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
