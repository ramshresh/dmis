<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\Incident */
/* @var $form yii\widgets\ActiveForm */
$dropDownItemName = $model::getDropDownItemName();
?>

<div class="incident-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'reportitem_id')->textInput() ?>
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


    <?= $form->field($model, 'timestamp_occurance')->widget(\kartik\widgets\DateTimePicker::className(),
        [
            'options' => ['placeholder' => 'Enter event time ...'],
            'convertFormat' => true,
            'pluginOptions' => [
                'todayHighlight' => true,
                'todayBtn' => true,
                'format' => 'yyyy-MM-dd h:i:s',
                'autoclose' => true,
            ]
        ]);
    ?>

    <?php //echo $form->field($model, 'duration')->textInput() ?>

    <?php //echo $form->field($model, 'status')->textInput() ?>

    <!--{{{ Tabular Input -->
    <table class="tabular table-striped">
        <thead>
        <th class="col-lg-4">type</th>
        <th class="col-lg-4">wkt</th>
        <th class="col-lg-4">
            <a id="add-row" title="Add" href="#"><span class="glyphicon glyphicon-add">Add</span></a>
        </th>
        </thead>

        <?=
        \mdm\widgets\TabularInput::widget([
            'id' => 'detail-grid',
            'allModels' => $model->geometries,
            'modelClass' => \common\modules\reporting\models\Geometry::className(),
            'options' => ['tag' => 'tbody'],
            'itemOptions' => ['tag' => 'tr'],
            'itemView' => '_geometry_detail',
            'clientOptions'=>[
                'btnAddSelector'=>'#add-row',
            ]
        ])
        ?>
    </table>
    <!--{{{ ./Tabular Input -->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
