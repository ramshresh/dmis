<?php

use common\components\AppHelper;
use yii\helpers\Url;

/**
 * @var string $subject
 * @var \common\modules\user\models\User $user
 * @var \common\modules\user\models\Profile $profile
 * @var \common\modules\user\models\UserKey $userKey
 */
?>

<h3><?= $subject ?></h3>

<p><?= Yii::t("user", "Please confirm your email address by clicking the link below:") ?></p>
<br>
<p>Copy paste the following url into web browser to go to confirmation page </p>
<em><?= AppHelper::getAppUrlToRoute('frontend',["/user/registration/confirm", "key" => $userKey->key]); ?></em>
<br>
<p><a href="<?= AppHelper::getAppUrlToRoute('frontend',["/user/registration/confirm", "key" => $userKey->key]); ?>">Click Here to Confirm</a>
