<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/19/15
 * Time: 6:01 AM
 */
namespace common\components;
/**
 * Interface MyYiiActiveFormJsAjaxFormInterface is the Interface that should be implemented by a class providing
 * ajax response for form submission and using yii.activeForm.js
 *
 * @package common\components
 */

interface MyYiiActiveFormJsAjaxFormInterface
{
    /**
     * @param $model
     *
     * @return {"status":-1,"msg":"Model validation error","errors":[{"password":"Incorrect username or password"}]} to the client side
     *
     */

    /*(function($){
//{{{ Client side implementation
    $('#login-form').on('beforeSubmit', function () {
        var form=this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:$(form).serialize(),
                success:function(data){
                    data = JSON.parse(data);
                    if(data.status==-1){

                        if(data.errors!=undefined){
                            errors =data.errors;
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
                    console.log('success')
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
})(jQuery);*/

    public function sendErrorResponseOnAjaxFormSubmit($models);

    public function getErrorResponseOnAjaxFormSubmit($models);

}