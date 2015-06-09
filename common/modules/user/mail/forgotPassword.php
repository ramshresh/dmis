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

<br>
<p>Copy paste the following url into web browser to go to password reset page </p>
<em><?= Yii::$app->urlManagerFrontEnd->createAbsoluteUrl(["/user/registration/reset", "key" => $userKey->key]); ?></em>
<br>Or<br>
<p><?= Yii::t("user", "Please use this link to reset your password:") ?></p>
<p><a href="<?= Yii::$app->urlManagerFrontEnd->createAbsoluteUrl(["/user/registration/reset",  "key" => $userKey->key]); ?>">Click Here to Reset Password</a>
