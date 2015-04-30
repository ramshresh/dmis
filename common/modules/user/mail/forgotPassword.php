<?php

use common\components\AppHelper;
use yii\helpers\Url;

/**
 * @var string $subject
 * @var \common\modules\user\models\User $user
 * @var \common\modules\user\models\UserKey $userKey
 */


?>

<h3><?= $subject ?></h3>

<p><?= Yii::t("user", "Please use this link to reset your password:") ?></p>


<p><a href="<?= AppHelper::getAppUrlToRoute('backend',["/user/registration/reset", "key" => $userKey->key]); ?>">Click Here to Reset Password</a>
