<?php

namespace common\modules\reporting\models\forms;

use Yii;
use yii\base\Model;

/**
 * ReportEventForm is the model behind the login form.
 */
class ReportEventForm extends Model
{
    /**
     * @var ReportItem  $reportItem
     */
    public $reportItem;

    /**
     * @var Event $event
     */
    public $event;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {


        return [
            [["username", "password"], "required"],
            ["username", "validateUser"],
            ["username", "validateUserStatus"],
            ["password", "validatePassword"],
            ["rememberMe", "boolean"],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        // calculate attribute label for "username"
        $attribute = Yii::$app->getModule("user")->requireEmail ? Yii::t("user", "Email") : Yii::t("user", "Username");
        return [
            "username" => $attribute,
            "password" => Yii::t("user", "Password"),
            "rememberMe" => Yii::t("user", "Remember Me"),
        ];
    }
}