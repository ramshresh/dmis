/**
 * Created by user on 1/18/15.
 */
jQuery('#login-form').yiiActiveForm(
    [{
        "id": "loginform-username",
        "name": "username",
        "container": ".field-loginform-username",
        "input": "#loginform-username",
        "error": ".help-block.help-block-error",
        "validate": function (attribute, value, messages, deferred) {
            yii.validation.required(value, messages, {"message": "Username cannot be blank."});
        }
    }, {
        "id": "loginform-password",
        "name": "password",
        "container": ".field-loginform-password",
        "input": "#loginform-password",
        "error": ".help-block.help-block-error",
        "validate": function (attribute, value, messages, deferred) {
            yii.validation.required(value, messages, {"message": "Password cannot be blank."});
        }
    }, {
        "id": "loginform-rememberme",
        "name": "rememberMe",
        "container": ".field-loginform-rememberme",
        "input": "#loginform-rememberme",
        "error": ".help-block.help-block-error",
        "validate": function (attribute, value, messages, deferred) {
            yii.validation.boolean(value, messages, {
                "trueValue": "1",
                "falseValue": "0",
                "message": "Remember Me must be either \"1\" or \"0\".",
                "skipOnEmpty": 1
            });
        }
    }], []);
