<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\search\ReportItemMultimediaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-multimedia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'report_item_id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'extension') ?>

    <?php // echo $form->field($model, 'thumbnail_url') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'path') ?>

    <?php // echo $form->field($model, 'timestamp_taken_at') ?>

    <?php // echo $form->field($model, 'caption') ?>

    <?php // echo $form->field($model, 'resolution_x') ?>

    <?php // echo $form->field($model, 'resolution_y') ?>

    <?php // echo $form->field($model, 'size_bytes') ?>

    <?php // echo $form->field($model, 'is_verified')->checkbox() ?>

    <?php // echo $form->field($model, 'tags') ?>

    <?php // echo $form->field($model, 'meta_hstore') ?>

    <?php // echo $form->field($model, 'meta_json') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
