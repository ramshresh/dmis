<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\EmergencySituation */
/* @var $form yii\widgets\ActiveForm */
$dropDownItemName = $model::getDropDownItemName();
?>
<div id="<?=$widgetId?>" class="event-form hidden" title="Add New Emergency Situation">
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
                'options' => ['placeholder' => '--Select Emergency Situation Type--'],
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
                    'placeholder' => '--Select Emergency Situation Sub-Type--',
                    'url' => \yii\helpers\Url::to(['/reporting/event-report/item-sub-type'])
                ]
            ]);
        ?>


        <?= $form->field($model, 'timestamp_declared')->widget(
            \kartik\widgets\DateTimePicker::className(),
            [
                'options' => ['placeholder' => 'When was Emergency Situation declared?'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                    'format' => 'yyyy-MM-dd h:i:s',
                    'autoclose' => true,
                ]
            ]);
        ?>

        <?= $form->field($model, 'declared_by')->textInput(['maxlength' => 75]) ?>

<?php
echo common\modules\reporting\widgets\event\TabularInput::widget([
   'model'=>$model
]);
?>

        <!--{{{ Tabular Input -->
        <table class="tabular table-striped">
            <thead>
            <th class="col-lg-4">type</th>
            <th class="col-lg-4">wkt</th>
            <th class="col-lg-4">
                <a id="add-row-es-g" title="Add" href="#"><span class="glyphicon glyphicon-add">Add</span></a>
            </th>
            </thead>
            <?=
            \mdm\widgets\TabularInput::widget([
                'id' => 'emergency-situation-geometry-detail-grid',
                'allModels' => $model->geometries,
                'modelClass' => \common\modules\reporting\models\Geometry::className(),
                'options' => ['tag' => 'tbody'],
                'itemOptions' => ['tag' => 'tr'],
                'itemView' => '_geometry_detail',
                'clientOptions' => [
                    'btnAddSelector' => '#add-row-es-g',
                ]
            ])
            ?>
        </table>
        <!--{{{ ./Tabular Input -->
        <?php
        /*  echo \common\modules\reporting\widgets\MultipleDamages::widget([
                'parentReportItem'=>$model->reportitem,
                'parentFormContext'=>$form,
            ]);
            */
        ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
