<?php


use common\modules\rapid_assessment\models\ReportItem;
use common\modules\rapid_assessment\models\ReportItemNeed;
use common\modules\rapid_assessment\widgets\tabular_input\report_item_need\_Create;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemEvent */
/* @var $form yii\widgets\ActiveForm */
$dropDownItemName = $model::getDropDownItemName($model->type);
?>

<div id="<?=$widgetId?>" class="hidden" title="Add new Event">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin([
                'id' => $formId,
                'action' => $actionRoute
            ]
        ); ?>

        <?php // echo $form->field($model, 'reportitem_id')->textInput() ?>
        <div class="row">
            <?php
            // Parent
            echo $form->field($model, 'item_name')
                ->widget(\kartik\widgets\Select2::classname(), [
                    'data' => $dropDownItemName,
                    'options' => ['placeholder' => '--Select Event Name--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
        </div>
        <div class="row">
            <?php
            // Child # 1
            echo $form->field($model, 'class_name')
                ->widget(\kartik\depdrop\DepDrop::classname(), [
                    'options' => ['id' => Html::getInputId($model,'class_name')],
                    'pluginOptions' => [
                        'depends' => [Html::getInputId($model, 'item_name')],
                        'placeholder' => '--Select Event Category--',
                        'url' => \yii\helpers\Url::to(['/api/rapid_assessment/report-items/item-class'])
                    ]
                ]);
            ?>
        </div>
        <div class="row">
            <?= Html::activeHiddenInput($model, 'type') ?>
        </div>

        <div class="row">
            <button id="btn-pointpicker-<?=$widgetId?>" type="button" class="btn btn-xs btn-danger" style="width: 100%">
                <span class="glyphicon glyphicon-globe"></span>&nbsp;Locate on map
            </button>
        </div>
        <div class="row">
            <?= Html::activeHiddenInput($model, 'address') ?>
        </div>
        <div class="row">
            <div class="col-md-6">

                <?= Html::activeHiddenInput($model, 'latitude') ?>

            </div>
            <div class="col-md-6">

                <?= Html::activeHiddenInput($model, 'longitude') ?>

            </div>
        </div>

        <?php
        echo \common\widgets\pointpicker_ol2\PointPickerWidget::widget(
            [
                'latitudeId' => Html::getInputId($model,'latitude'),
                'longitudeId' => Html::getInputId($model,'longitude'),
                'placenameId' => Html::getInputId($model,'address'),
                //'openlayersPackName' => 'openlayers', //'openlayerslPack' //,
                'triggerId'=>"btn-pointpicker-".$widgetId,
                //'externalMapDivId'=>'map',
                //'wktId'=>'wkt'
            ]);
        ?>
<!--<button id="btn_add_new_needs-<?/*= $widgetId*/?>" type="button">Add Need</button>
        --><?php
/*        echo \common\modules\rapid_assessment\widgets\report_item\Create::widget([
            'jqToggleBtnSelector' => "#btn_add_new_needs-".$widgetId,
            // 'widgetId' => 'ebbvent-form-widget',
            // 'formId' => 'evehnt-form',
            'actionRoute' => 'site/report-item-create',
            'reportItemType' => ReportItem::TYPE_NEED,
        ]);
        */?>

        <?php
            echo _Create::widget([
                'form'=>$form,
                'allModels'=>$model->needs,
                'modelClass'=>ReportItemNeed::className(),
            ]);
        ?>


        <div class="row">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
