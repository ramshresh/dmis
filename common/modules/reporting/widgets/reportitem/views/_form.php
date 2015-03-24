<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\Event */
/* @var $form yii\widgets\ActiveForm */
$dropDownItemName = $model::getDropDownItemName();

?>

<div class="event-form">
    <?php $form = ActiveForm::begin([
            'id' => 'formEventCreate',
        'action'=>$urlToCreateAction]
    ); ?>

    <?php // echo $form->field($model, 'reportitem_id')->textInput() ?>

    <?php
    // Parent
    echo $form->field($model, 'item_name')
        ->widget(\kartik\widgets\Select2::classname(), [
            'data' => $dropDownItemName,
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


    <?= $form->field($model, 'timestamp_occurance')->widget(
        \kartik\widgets\DateTimePicker::className(),
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

    <?php
    /*echo $form->field($model, 'tags')->widget(\kartik\widgets\Select2::className(),
        [
            'options' => ['placeholder' => 'tags'],
            'pluginOptions' => [
                'tags' => ["earthquake", "event", "damage", "incident", "need",],
                'maximumInputLength' => 10
            ],
        ]);*/
    ?>
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




    <?php
    /*    echo \common\modules\reporting\widgets\MultipleDamages::widget([
            'parentReportItem'=>$model->reportitem,
            'parentFormContext'=>$form,
        ]);
        */?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$loginFormJs = <<<JS
(function($){
//{{{
    /**
    * Enabling ajax submission
    * prevents normal submission of form by overriding on-submit event of form
    * prevents normal on-click event of <button type='submit'>
    */
    /**
    * Disabling form submission by yiiActiveForm by unbinding the 'submit.yiiActiveForm' event
    * @see line:196 of JavaScript widget used by the ActiveForm widget. which is:
    * line:196 | .on('submit.yiiActiveForm', methods.submitForm);
    */
    $('#formEventCreate').on('beforeSubmit', function () {
        var form=this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:$(form).serialize(),
                success:function(data){
                    data = JSON.parse(data);
                    if(data.status=='error'){
                        /*<data> must be as: by controller/action with following content. SiteController-actionLogin
                        {
                            "status":-1,
                            "msg":"Model validation error",
                            "errors":[{"password":"Incorrect username or password"}]
                        }
                        */
                        if(data.errors!=undefined){
                            errorsModels =data.errors;
                            for(var k=0;k<errorsModels.length;k++ ){
                                errors=errorsModels[k];
                                errKeys = Object.keys(errors);
                            yiiActiveForm=$(form).data('yiiActiveForm');
                            errAttr=[];

                            for(i=0;i<errKeys.length;i++){
                                for(j = 0;j<yiiActiveForm.attributes.length;j++){
                                    if(yiiActiveForm.attributes[j].name in errors){
                                        errAttr.push(
                                            {
                                            formAttribute:yiiActiveForm.attributes[j],
                                            errorMessage:errors[errKeys[i]]
                                            }
                                        );

                                    }
                                }
                            }
                            for(i = 0;i<errAttr.length;i++){
                                formAttribute = errAttr[i].formAttribute;
                                errorMessage = errAttr[i].errorMessage;

                                containerClass =formAttribute.container;
                                errorClass=formAttribute.error;
                                errSelector= containerClass+' '+errorClass;

                                $(errSelector).html(errorMessage);
                                $(containerClass).addClass(yiiActiveForm.settings.errorCssClass)
                            }
                            console.log(yiiActiveForm);
                            }
                        }
                    }
                    console.log('success')
                    form.reset();
                    $('.select2-offscreen').select2('val', '');
                }
            })
            .done(function(result){
                console.log('done');
                console.log(result)
            })
            .fail(function(){
                console.log('failed');
                console.log('server error');
            });
        return false;
    });
//}}}
})(jQuery);
JS;
$this->registerJs($loginFormJs, $this::POS_READY);
?>
