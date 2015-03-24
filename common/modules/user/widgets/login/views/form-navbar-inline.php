<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/23/15
 * Time: 10:36 PM
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="dropdown-menu" style="width: 300px;  padding:10px;">

    <?php $form = ActiveForm::begin([
        'id' => 'formLogin',
        'action'=>\yii\helpers\Url::to(['/user/default/login']),
        'fieldConfig' => [
            'template' => "{input}\n{error}",
            'labelOptions' => ['class' => 'col-xs-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
<div class="row">
        <div class="col-lg-7">
            <?= $form->field($model, 'rememberMe', [
                'template' => "{label}{input}",
            ])->checkbox() ?>
        </div>
        <div class="col-lg-5">
            <?= Html::submitButton('Login', ['class' => 'btn-primary','style'=>'width:100px;']) ?>
        </div>
</div>
    <h6>
        <?= Html::a("*Register", ["/user/register"]) ?>
        <?= Html::a("*Forgot password" . "?", ["/user/forgot"]) ?>
        <?= Html::a("*Resend confirmation email", ["/user/resend"]) ?>
    </h6>
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

    $('#formLogin').on('beforeSubmit', function () {
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
