/**
 * Created by User on 3/11/2015.
 */
(function($){
    $.fn.yiiAjaxFormWidget = function (options) {
        options = $.extend({}, $.fn.yiiAjaxFormWidget.config, options);
        return this.each(function () {
            // initialize the elements in the collection
            /*
             widgetId: "form-container-w0",
             formId: "formEventCreate",
             jqToggleBtnSelector: null,
             urlToCreateActionk:"site/event-create"
             */

            $('#'+options.widgetId).dialog({
                autoOpen:false,
                autoResize:true
            });
            $(options.jqToggleBtnSelector).each(function(){
                $(this).on('click',function(){
                    if($('#'+options.widgetId).dialog('isOpen')){
                        $('#'+options.widgetId).dialog('close');
                    }else{
                        $('#'+options.widgetId).dialog('open');
                        $('#'+options.widgetId).removeClass('hidden');
                    }
                });
            });

//{{{
            /* @doc http://blog.nterms.com/2014/09/validate-yii2-forms-before-submitting.html*/
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
            $('#'+options.formId).on('beforeSubmit', function (event) {
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
                        }else if(data.status=='success'){
                            form.reset();
                            $('.select2-offscreen').select2('val', '');
                            alert('saved!');
                        }else if(data.status=='exception'){
                            alert('Unhandled exception');
                            console.log(data);
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
        });
    };

    $.fn.yiiAjaxFormWidget.config = {
        // set values and custom functions

    };
})(jQuery);