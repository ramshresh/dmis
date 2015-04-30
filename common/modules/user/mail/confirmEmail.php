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

<p><a href="<?= AppHelper::getAppUrlToRoute('backend',["/user/registration/confirm", "key" => $userKey->key]); ?>">Click Here to Confirm</a>
