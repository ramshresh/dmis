<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\search\SymbolIconSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="symbol-icon-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'format') ?>

    <?= $form->field($model, 'extension') ?>

    <?php // echo $form->field($model, 'path') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'size') ?>

    <?php // echo $form->field($model, 'resolution_x') ?>

    <?php // echo $form->field($model, 'resolution_y') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'description') ?>

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
