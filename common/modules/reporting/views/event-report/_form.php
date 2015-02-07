<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/1/15
 * Time: 12:48 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\ReportItem */
/* @var $form yii\widgets\ActiveForm */
$this->registerAssetBundle(\kartik\growl\GrowlAsset::className(),$this::POS_END);
?>
<div class="event-report-item-form">
    <?php $form = ActiveForm::begin([
            'id'=>'eventReportForm']
    ); ?>

    <div class="row">
        <div class="col-md-6">
            <?php
            // Parent

            echo $form->field($reportItem, 'item_name')
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
            echo $form->field($reportItem, 'subtype_name')
                ->widget(\kartik\depdrop\DepDrop::classname(), [
                    'options' => ['id' => 'subtype_name'],
                    'pluginOptions' => [
                        'depends' => [\yii\helpers\Html::getInputId($reportItem,'item_name')],
                        'placeholder' => '--Select Event Sub-Type--',
                        'url' => \yii\helpers\Url::to(['/reporting/event-report/item-sub-type'])
                    ]
                ]);
            ?>
            <?= $form->field($event, 'timestamp_occurance')->widget(\kartik\widgets\DateTimePicker::className(),
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
        </div>
        <div class="col-md-6">
            <?= $form->field($reportItem, 'description')->textarea(['rows' => 4]) ?>
            <?= $form->field($reportItem, 'tags')->widget(\kartik\widgets\Select2::className(),
                [
                    'options' => ['placeholder' => 'tags'],
                    'pluginOptions' => [
                        'tags' => ["earthquake", "event", "damage", "incident", "need",],
                        'maximumInputLength' => 10
                    ],
                ]);

            ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($reportItem->isNewRecord || $event->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $reportItem->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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

    $('#eventReportForm').on('beforeSubmit', function () {
        var form=this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:$(form).serialize(),
                success:function(data){
                    if (typeof(data) === "string") {

                        // json result
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
                    }else if(data.status=='exception'){
                        $.growl({
                            title: '<strong>Exception:</strong> ',
                            message: data.msg
                        },{

                            type: 'danger',
                            placement:{
                                from:'top',
                                align:'right'
                            }
                        });

                    }
                    else if(data.status=='success'){

                        $.growl({
                            message: data.msg
                        },{

                            type: 'success',
                            placement:{
                                from:'top',
                                align:'right'
                            }
                        });
                        form.reset();
                    }
                    }

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
