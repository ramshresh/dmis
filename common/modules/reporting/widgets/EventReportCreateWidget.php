<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/22/15
 * Time: 3:30 PM
 */

namespace common\modules\reporting\widgets;

use common\modules\reporting\models\ItemType;
use common\modules\reporting\models\ReportItem;
use yii\base\Exception;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;

class EventReportCreateWidget extends Widget {
    public $parentReportItemId;
    public $modelReportItem;
    public $modelEvent;
    public $controllerRoute;
    public $htmlOptions;
    /**
     * @var $widgetTriggets Array
     * is an array of jQuery selectors such as: '#btn-login' or 'button#btn-login' OR '.btn-login' etc,
     * that should trigger this widget.
     * By triggering widget means triggering the hidden bootstrap-modal with login form
     */
    public $triggers;


    public function init(){
        parent::init();

        $this->registerScripts();

    }

    public function run(){

        if ($this->controllerRoute === null)
            throw new Exception('$controllerRoute must be set.', 500);

        if($this->triggers!=NULL){
            // if string then convert to array for consistency
            $this->triggers=(gettype($this->triggers)=='array')?$this->triggers:array($this->triggers);
        }



        $opts = array(
            'createUrl' =>Url::toRoute($this->controllerRoute . '/create'),
            'deleteUrl' =>Url::toRoute($this->controllerRoute . '/delete'),
            'updateUrl' =>Url::toRoute($this->controllerRoute . '/changeData'),
        );

        $opts = Json::encode($opts);

        $this->htmlOptions['id'] = $this->id;

        $this->getView()->registerJs("$('#{$this->id}').formEventReport({$opts});",View::POS_READY);

        $dropDownItemName =  ArrayHelper::map(ItemType::find()
            ->where('type=:type',[':type'=>ReportItem::TYPE_EVENT])
            ->all(), 'item_name', 'item_name');
        return $this->render('event-report-create/_form',
            [
                'parentReportItemId'=>$this->parentReportItemId,
                'reportItem'=>$this->modelReportItem,
                'event'=>$this->modelEvent,
                'dropDownItemName'=>$dropDownItemName
            ]);
    }


    public function registerScripts(){
        $js=<<<JS
(function($){
    $.fn.formEventReport=function(options){
    var defaults={};
    var opts=$.extend({},defaults,options);
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
                //url:$(form).attr('action'),
                url:opts.createUrl,
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
                        $('#formEventReportModal').modal('hide');
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
}
})(jQuery);
JS;
        $this->getView()->registerJs($js,View::POS_END);
    }
}