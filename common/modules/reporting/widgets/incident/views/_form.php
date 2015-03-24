<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\Event */
/* @var $form yii\widgets\ActiveForm */
$dropDownItemName = $model::getDropDownItemName();
?>
    <div id="<?=$widgetId?>" class="incident-form hidden" title="Add new Incident">
        <?php $form = ActiveForm::begin([
                'id' => $formId,
                'action' => $actionRoute]
        ); ?>

        <?php // echo $form->field($model, 'reportitem_id')->textInput() ?>

        <?php
        // Parent
        echo $form->field($model, 'item_name')
            ->widget(\kartik\widgets\Select2::classname(), [
                'data' => $dropDownItemName,
                'options' => ['placeholder' => '--Select Incident Type--'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>

        <?php
        // Child # 1
        echo $form->field($model, 'subtype_name')
            ->widget(\kartik\depdrop\DepDrop::classname(), [
                'options' => ['id' => Html::getInputId($model,'subtype_name')],
                'pluginOptions' => [
                    'depends' => [Html::getInputId($model, 'item_name')],
                    'placeholder' => '--Select Incident Sub-Type--',
                    'url' => \yii\helpers\Url::to(['/reporting/event-report/item-sub-type'])
                ]
            ]);
        ?>

        <?= $form->field($model, 'timestamp_occurance')->widget(\kartik\widgets\DateTimePicker::className(),
            [
                'options' => ['placeholder' => 'When did the incident happen?'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                    'format' => 'yyyy-MM-dd h:i:s',
                    'autoclose' => true,
                ]
            ]);
        ?>
        <!--{{{ Tabular Input -->
        <table class="tabular table-striped">
            <thead>
            <th class="col-lg-4">type</th>
            <th class="col-lg-4">wkt</th>
            <th class="col-lg-4">
                <a id="add-row-incident-geom" title="Add" href="#"><span class="glyphicon glyphicon-add">Add</span></a>
            </th>
            </thead>
            <?=
            \mdm\widgets\TabularInput::widget([
                'id' => 'incident-geometry-detail-grid',
                'allModels' => $model->geometries,
                'modelClass' => \common\modules\reporting\models\Geometry::className(),
                'options' => ['tag' => 'tbody'],
                'itemOptions' => ['tag' => 'tr'],
                'itemView' => '_geometry_detail',
                'clientOptions' => [
                    'btnAddSelector' => '#add-row-incident-geom',
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
