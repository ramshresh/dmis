<?php

use common\modules\file_management\models\TempUploadedFile;
use kartik\datetime\DateTimePicker;
use kartik\widgets\FileInput;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-form" xmlns="http://www.w3.org/1999/html">

    <?php $form = ActiveForm::begin([
        "options" => [
            "style" => "margin:25px 0 !important;",
            'enctype'=>'multipart/form-data',
        ],
    ]); ?>
    <div class="col-md-12">
        <?= $form->field($model, 'event_name')->dropDownList(
            [''=>'Select Event','Earthquake'=>'Earthquake', 'Fire'=>'Fire', 'Landslide'=>'Landslide'],
            [

            ])->label(false) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'item_name')->dropDownList(
            [''=>'Select Incident','Building Damage'=>'Building Damage', 'Fire'=>'Fire', 'Landslide'=>'Landslide'],
            [

            ])->label(false) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'class_name')->dropDownList(
            [''=>'Select Type','Destroyed'=>'Destroyed', 'Moderate Damage'=>'Moderate Damage', 'Severe Damage'=>'Severe Damage'],
            [

            ])->label(false) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'class_basis')->hiddenInput(['value'=>'Damage Type'])->label(false) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'timestamp_occurance')
        ->widget(DateTimePicker::classname(), [
            'options' => ['placeholder' => 'Enter event time ...'],
            'pluginOptions' => [
                'autoclose' => true
            ]
        ])->label(false);
        ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'address')->textInput(['maxlength' => 255,'placeholder'=>'Address'])->label(false) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'latitude')->textInput(['placeholder'=>'latitude'])->label(false) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'longitude')->textInput(['placeholder'=>'longitude'])->label(false) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'description')->textarea(['rows' => 3,'placeholder'=>'Short description...'])->label(false) ?>
    </div>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
</div>

<?php
Modal::begin([
    'header'=>'File Input inside Modal',
    'toggleButton' => [
        'label'=>'Upload Photo', 'class'=>'btn btn-orange'
    ],
]);
?>
<div id="photo-upload">

    <form
        id="photo-upload-form"
        enctype="multipart/form-data"
        method="post"
        target="upload_target"
        action="/girc/dmis/api/file_management/upload/file"
        >
        <div class="col-md-12">
            <?php
            echo FileInput::widget([
                'name' => 'file',
                'options'=>[
                    'multiple'=>false
                ],
                'pluginOptions' => [
                    'uploadUrl' => '/girc/dmis/api/file_management/upload/file',
                    'uploadExtraData' => [
                        'latitude' => 27,
                        'longitude' => '81'
                    ],
                    'maxFileCount' => 1
                ]
            ]);
            ?>
        </div>
        <iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
        <div class="col-md-12">
            <?=Html::textInput('latitude')?>
        </div>
        <div class="col-md-12">
            <?=Html::textInput('longitude')?>
        </div>
        <div class="col-md-12">
            <?= Html::button('Upload',['type'=>'button','class'=>'btn-primary','id'=>'btn_upload'])?>
        </div>
    </form
</div>
<?php Modal::end(); ?>

<script>

    <?php $this->beginBlock('scriptPosReady')?>

    $('#btn_upload').click(function(){
        $form = $("#photo-upload-form");
        $form.submit();
    });


    <?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['scriptPosReady'], $this::POS_READY); ?>


