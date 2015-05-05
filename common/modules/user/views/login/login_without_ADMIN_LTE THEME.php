<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 */

$this->title = Yii::t('user', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">

	<!--<h1><?/*= Html::encode($this->title) */?></h1>-->

	<p><?= Yii::t("user", "Please fill out the following fields to login:") ?></p>

	<?php $form = ActiveForm::begin([
		'id' => 'login-form',
		'options' => ['class' => 'form-horizontal'],
		'fieldConfig' => [
			'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
			'labelOptions' => ['class' => 'col-lg-2 control-label'],
		],

	]); ?>

	<?= $form->field($model, 'username') ?>
	<?= $form->field($model, 'password')->passwordInput() ?>
	<?= $form->field($model, 'rememberMe', [
		'template' => "{label}<div class=\"col-lg-offset-2 col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
	])->checkbox() ?>

	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-10">
			<?= Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-primary']) ?>

            <br/><br/>
            <?= Html::a(Yii::t("user", "Register"), ["/user/registration/register"]) ?> /
            <?= Html::a(Yii::t("user", "Forgot password") . "?", ["/user/registration/forgot"]) ?> /
            <?= Html::a(Yii::t("user", "Resend confirmation email"), ["/user/registration/resend"]) ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

    <?php if (Yii::$app->get("authClientCollection", false)): ?>
        <div class="col-lg-offset-2">
            <?= \yii\authclient\widgets\AuthChoice::widget([
                'baseAuthUrl' => ['/user/auth/login']
            ]) ?>
        </div>
    <?php endif; ?>

	<div class="col-lg-offset-2" style="color:#999;">
		You may login with <strong>neo/neo</strong>.<br>
		To modify the username/password, log in first and then <?= HTML::a("update your account", ["/user/account"]) ?>.
	</div>

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

    $('#login-form').on('beforeSubmit', function () {
        /*yiiActiveForm=$('#login-form').data('yiiActiveForm');
        console.log(yiiActiveForm.submitting);*/
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