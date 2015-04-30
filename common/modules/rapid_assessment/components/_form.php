<?php
/**
 * @var $this    DisasterincidentController
 * @var $model   Disasterincident
 * @var $form    CActiveForm
 * @var $photos  xupload.models.XUploadForm
 * @var $gallery Gallery
 */
?>
<?php
$cs = Yii::app()->clientScript;
$cs->registerCoreScript('bootstrap-datetimepicker');
?>

<div id='disasterincident_create_form'>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'disasterincident-form',
        'enableAjaxValidation' => false,
        //This is very important when uploading files
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
    <div
        class="row buttons"><?php echo CHtml::ajaxSubmitButton('AjaxSubmit', $this->createUrl('create'), array('update' => '#disasterincident_create_form')) ?>
    </div>
    <!--    <div class="row buttons">-->
    <?php //echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save'); ?><!--</div>-->

    <?php $this->endWidget(); ?>
</div>

    <!-- Form Fields -->
    <label class="message">Fields with * are required.</label>
    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->labelEx($model, 'id_emergency_situation', array('class' => 'control-label')); ?>
        </div>
    </div>
    <?php
    $opts = CHtml::listData(EmergencySituation::model()->findAll(), 'id', 'search');
    echo $form->dropDownList($model, 'id_emergency_situation', $opts);
    ?>
    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->labelEx($model, 'type', array('class' => 'control-label')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->textField($model, 'type', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control focus')); ?>
        </div>
    </div>
    <?php echo $form->error($model, 'type'); ?>

    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->labelEx($model, 'description', array('class' => 'control-label')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 57, 'class' => 'form-control focus')); ?>
        </div>
    </div>
    <?php echo $form->error($model, 'description'); ?>
    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->labelEx($model, 'incident_timestamp'); ?>
        </div>
    </div>

    <?php
    //    Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
    //    $this->widget('CJuiDateTimePicker', array(
    //        'model' => $model, //Model object
    //        'attribute' => 'incident_timestamp', //attribute name
    //        'mode' => 'datetime', //use "time","date" or "datetime" (default)
    //        'options' => array("dateFormat" => 'dd/mm/yy'), // jquery plugin options
    //        'htmlOptions' => array('class' => 'control-label'),
    //        'language' => ''
    //    ));
    //
    //
    ?>

    <div class="row">
        <div class='col-sm-6'>
            <?php echo $form->textField($model, 'incident_timestamp', array('class' => 'form-control focus')); ?>
        </div>
        <script type="text/javascript">
            $(function () {
                var $id = $("#<?php echo CHtml::activeId($model,'incident_timestamp') ?>");
                $id.datetimepicker();
            });
        </script>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <?php //echo $form->textField($model,'type',array('size'=>60,'maxlength'=>100)); ?>
        </div>
    </div>
    <?php echo $form->error($model, 'incident_timestamp'); ?>
    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->labelEx($model, 'latitude', array('class' => 'control-label')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->textField($model, 'latitude', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control focus')); ?>
        </div>
    </div>
    <?php echo $form->error($model, 'latitude'); ?>
    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->labelEx($model, 'longitude', array('class' => 'control-label')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->textField($model, 'longitude', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control focus')); ?>
        </div>
    </div>
    </br>
    <?php echo $form->error($model, 'longitude'); ?>

    <?php
    $this->widget('application.components.Map.Widgets.Pointpicker.Pointpicker',
        array(
            'latitudeId' => 'DisasterIncident_latitude',
            'longitudeId' => 'DisasterIncident_longitude',
            'openlayersPackName' => 'openlayerslPack'
        )
    );?>
    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->labelEx($model, 'placename', array('class' => 'control-label')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php echo $form->textField($model, 'placename', array('size' => 60, 'maxlength' => 100, 'class' => 'form-control focus')); ?>
        </div>
    </div>
    <?php echo $form->error($model, 'placename'); ?>



<button id="toggle-im">Add Impact</button>
<div id="dialog-im" title="Add Impact">
    <h1>Impacts</h1>
    <?php
    Yii::import('application.extensions.multipleImpacts.MultipleImpacts');

    if (isset($model)) {
        $this->widget('MultipleImpacts', array('disasterIncident' => $model, 'parentFormContext' => $form, 'parentControllerContext' => $this));
    } else {
        $this->widget('MultipleImpacts', array('parentFormContext' => $form, 'parentControllerContext' => $this));
    }
    ?>

</div>

<button id="toggle-nd">Add Need</button>
<div id="dialog-nd" title="Add Need">
    <h1>Need</h1>
    <?php
    Yii::import('application.extensions.multipleNeeds.MultipleNeeds');
    if (isset($model)) {
        $this->widget('MultipleNeeds', array('disasterIncident' => $model, 'parentFormContext' => $form, 'parentControllerContext' => $this));
    } else {
        $this->widget('MultipleNeeds', array('parentFormContext' => $form, 'parentControllerContext' => $this));
    }
    ?>

</div>

<button id="toggle-ph">Add Photo</button>
<div id="dialog-ph" title="Add Photo">
    <h1>Photo</h1>
    <div id="galleryform">
        <?php $this->renderPartial('_galleryphoto', array('gallery' => $gallery, 'photos' => $photos, 'form' => $form)); ?>
    </div>

</div>

