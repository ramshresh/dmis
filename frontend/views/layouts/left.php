<?php
/* @var $this \yii\web\View */
/* @var $content string */
/* @var $directoryAdminLteAsset string */

use yii\bootstrap\Nav;
//$avatar = (Yii::$app->user->isGuest)?"$directoryAsset/img/avatar.png":"$directoryAsset/img/user2-160x160.jpg";
$avatar = (Yii::$app->user->isGuest)?Yii::$aliases['@web']."/img/user-avatar-placeholder.png":Yii::$aliases['@web']."/img/user-avatar-placeholder.png";

?>
<div class="main-sidebar">
    <!-- Inner sidebar -->
    <div class="sidebar">

    </div><!-- /.sidebar -->
</div><!-- /.main-sidebar -->