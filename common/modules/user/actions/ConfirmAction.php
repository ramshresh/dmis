<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/10/2015
 * Time: 4:48 AM
 */

namespace common\modules\user\actions;

use common\components\MyBaseAction;
use common\modules\user\components\User;
use yii;

class ConfirmAction extends yii\base\Action
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * registration api action
     */
    public function run()
    {
        /** @var \common\modules\user\models\UserKey $userKey */
        /** @var \common\modules\user\models\User $user */
        if(!isset($_GET['key'])){
            echo yii\helpers\Json::encode(["status"=>"error","msg"=>"keu not sent"]);
        }
        $key = $_GET['key'];
        // search for userKey
        $success = false;
        $userKey = Yii::$app->getModule("user")->model("UserKey");
        $userKey = $userKey::findActiveByKey($key, [$userKey::TYPE_EMAIL_ACTIVATE, $userKey::TYPE_EMAIL_CHANGE]);
        if ($userKey) {

            // confirm user
            $user = Yii::$app->getModule("user")->model("User");
            $user = $user::findOne($userKey->user_id);
            $user->confirm();

            // consume userKey and set success
            $userKey->consume();
            $success = $user->email;
        }

        // render
        return $this->controller->render("confirm", [
            "userKey" => $userKey,
            "success" => $success
        ]);
    }
}