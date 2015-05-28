<?php

use common\modules\rapid_assessment\models\ReportItem;
use kartik\builder\TabularForm;
use kartik\file\FileInput;
use kartik\grid\GridView;
use ramshresh\yii2\galleryManager\GalleryManager;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemIncident */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-incident-form">

    <?php $form = \kartik\form\ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data',
        ]
    ]); ?>


    <?php //$form->field($model, 'type')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'item_name')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'class_basis')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'class_name')->textInput(['maxlength' => 255]) ?>

    <?php //$form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?php //$form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'is_verified')->checkbox() ?>

    <?php //$form->field($model, 'status')->textInput(['maxlength' => 255]) ?>

    <?php //$form->field($model, 'timestamp_occurance')->textInput() ?>

    <?php //$form->field($model, 'timestamp_created_at')->textInput() ?>

    <?php //$form->field($model, 'timestamp_updated_at')->textInput() ?>

    <?php //$form->field($model, 'tags')->textInput() ?>

    <?php //$form->field($model, 'meta_hstore')->textInput() ?>

    <?php //$form->field($model, 'meta_json')->textInput() ?>

    <?php //$form->field($model, 'declared_by')->textInput(['maxlength' => 255]) ?>

    <?php //$form->field($model, 'timestamp_declared_at')->textInput() ?>

    <?php echo $form->field($model, 'magnitude')->textInput() ?>

    <?php //$form->field($model, 'units')->textInput(['maxlength' => 255]) ?>

    <?php //$form->field($model, 'wkt')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'geom')->textInput() ?>

    <?php echo $form->field($model, 'latitude')->textInput() ?>

    <?php echo $form->field($model, 'longitude')->textInput() ?>

    <?php echo $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <button id="triggerpointpicker-modalmap" type="button">Locate on map</button>
    <?php
    echo \common\modules\reporting\widgets\pointpicker\PointPickerWidget::widget(
        [
            'latitudeId' => yii\helpers\Html::getInputId($model,'latitude'),
            'longitudeId' => yii\helpers\Html::getInputId($model,'longitude'),
            //'wktId'=>yii\helpers\Html::getInputId($model,"[$key]wkt"),
            'placenameId' => yii\helpers\Html::getInputId($model,'address'),
            //'openlayersPackName' => 'openlayers', //'openlayerslPack' //,
            'triggerId'=>'triggerpointpicker-modalmap',
            //'externalMapDivId'=>'map',
        ]);
    ?>

    <?php //$form->field($model, 'user_id')->textInput() ?>

    <?php //$form->field($model, 'owner_name')->textInput(['maxlength' => 100]) ?>

    <?php //$form->field($model, 'owner_contact')->textInput(['maxlength' => 100]) ?>

    <?php //$form->field($model, 'supplied_per_person')->textInput() ?>

    <?php //$form->field($model, 'event')->textInput(['maxlength' => 100]) ?>

    <?php //$form->field($model, 'event_name')->textInput(['maxlength' => 255]) ?>

    <?php //$form->field($model, 'income_source')->textInput(['maxlength' => 100]) ?>

    <?php //$form->field($model, 'income_level')->textInput(['maxlength' => 100]) ?>

    <?php //$form->field($model, 'no_of_occupants')->textInput() ?>

    <?php //$form->field($model, 'current_condition')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'construction_type')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'occupancy_type')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'current_income_status')->textarea(['rows' => 6]) ?>

    <?php echo Html::label('Upload Photo') ?>
    <?php
    if ($model->isNewRecord) {
        echo FileInput::widget(['name'=>'photo','options'=>['accept'=>'image/*']]);
    } else {
        echo GalleryManager::widget(
            [
                'model' => $model,
                'behaviorName' => 'galleryBehavior',
                'apiRoute' => '/rapid_assessment/crud-report-item/galleryApi'
            ]
        );
    }
    ?>
    <?php
    /*echo TabularForm::widget([
        'form' => $form,
        'dataProvider' => new ActiveDataProvider(['query' => $model->getImpacts()->indexBy('id')]),
        'attributes' => [
            'item_name' => ['type' => TabularForm::INPUT_TEXT],
            'magnitude' => [
                'label'=>'Count',
                'type' => TabularForm::INPUT_TEXT
            ],

        ],
        'gridSettings' => [
            'floatHeader' => true,
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-ok-circle"></i> Impacts</h3>',
                'type' => GridView::TYPE_PRIMARY,
                'after'=>'<div class="pull-right">'.
                    Html::a(
                        '<i class="glyphicon glyphicon-plus"></i>',
                        Url::to(['/rapid_assessment/crud-report-item-impact/create']),
                        ['class'=>'btn btn-success']
                    ) . '&nbsp;' .
                    Html::a(
                        '<i class="glyphicon glyphicon-remove"></i>',
                        '$deleteUrl',
                        ['class'=>'btn btn-danger']
                    ).'</div>'
            ]
        ]
    ]);*/
    ?>

    <?php
    /*echo TabularForm::widget([
        'form' => $form,
        'dataProvider' => new ActiveDataProvider(['query' => $model->getNeeds()->indexBy('id')]),
        'attributes' => [
            'item_name' => ['type' => TabularForm::INPUT_TEXT],
            'magnitude' => [
                'label'=>'Count',
                'type' => TabularForm::INPUT_TEXT
            ],

        ],
        'gridSettings' => [
            'floatHeader' => true,
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-ok-circle"></i> Needs</h3>',
                'type' => GridView::TYPE_PRIMARY,
                'after'=>'<div class="pull-right">'.
                    Html::a(
                        '<i class="glyphicon glyphicon-plus"></i>',
                        Url::to(['/rapid_assessment/crud-report-item-need/create']),
                        ['class'=>'btn btn-success']
                    ) . '&nbsp;' .
                    Html::a(
                        '<i class="glyphicon glyphicon-remove"></i>',
                        '$deleteUrl',
                        ['class'=>'btn btn-danger']
                    ).'</div>'
            ]
        ]
    ]);*/
    ?>


    <!--<button id="btn_add_new_needs" type="button">Add Need</button>
    --><?php
/*            echo \common\modules\rapid_assessment\widgets\report_item\Create::widget([
                'jqToggleBtnSelector' => "#btn_add_new_needs",
                // 'widgetId' => 'ebbvent-form-widget',
                // 'formId' => 'evehnt-form',
                'actionRoute' => Yii::$app->urlManager->createUrl(['/site/report-item-create']),
                'reportItemType' => ReportItem::TYPE_NEED,
            ]);
            */?>

    <!--<button id="btn_add_new_impacts" type="button">Add impact</button>

    --><?php
/*      echo \common\modules\rapid_assessment\widgets\report_item\Create::widget([
        'jqToggleBtnSelector' => "#btn_add_new_impacts",
        // 'widgetId' => 'ebbvent-form-widget',
        // 'formId' => 'evehnt-form',
        'actionRoute' => Yii::$app->urlManager->createUrl(['/site/report-item-create']),
        'reportItemType' => ReportItem::TYPE_IMPACT,
    ]);
    */?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php \kartik\form\ActiveForm::end(); ?>

</div>
