<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\Damage */
/* @var $form yii\widgets\ActiveForm */
$dropDownItemName = $model::getDropDownItemName();
?>

<div class="damage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    // Parent

    echo $form->field($model, 'item_name')
        ->widget(\kartik\widgets\Select2::classname(), [
            'data' => array_merge(["" => ""], $dropDownItemName),
            'options' => ['placeholder' => '--Select Event Type--'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <?php
    // Child # 1
    echo $form->field($model, 'subtype_name')
        ->widget(\kartik\depdrop\DepDrop::classname(), [
            'options' => ['id' => 'subtype_name'],
            'pluginOptions' => [
                'depends' => [Html::getInputId($model,'item_name')],
                'placeholder' => '--Select Event Sub-Type--',
                'url' => \yii\helpers\Url::to(['/reporting/event-report/item-sub-type'])
            ]
        ]);
    ?>


    <?php //echo $form->field($model, 'reportitem_id')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'units_shortname')->textInput(['maxlength' => 25]) ?>

    <?php //echo $form->field($model, 'units_displayname')->textInput(['maxlength' => 25]) ?>

    <?php //echo $form->field($model, 'status')->textInput() ?>

	<!--- {{{ Geometry-->
	<button id="triggerpointpicker-modalmap" type="button">Locate on map</button>
    <?php echo $form->field($geometry, 'type')->textInput(); ?>
    <?php echo $form->field($geometry, 'latitude')->textInput(); ?>
    <?php echo $form->field($geometry, 'longitude')->textInput(); ?>
    <?php echo $form->field($geometry, 'wkt')->textInput(); ?>
    <?php
        echo \common\modules\reporting\widgets\pointpicker\PointPickerWidget::widget([
             'latitudeId'=>Html::getInputId($geometry,'latitude'),
             'longitudeId'=>Html::getInputId($geometry,'longitude'),
             'placenameId' => 'placename',
             'wktFieldId'=>Html::getInputId($geometry,'wkt'),
             'triggerId'=>'triggerpointpicker-modalmap',
             //'externalMapDivId'=>'map',
            ]);
    ?>
	<!--- }}} /.Geometry  -->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
