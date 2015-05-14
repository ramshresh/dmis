<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$avatar = (Yii::$app->user->isGuest)?Yii::$aliases['@web']."/img/user-avatar-placeholder.png":Yii::$aliases['@web']."/img/user-avatar-placeholder.png";
?>

<header class="main-header">

    <?= Html::a(Yii::$app->name, Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $avatar ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?= Yii::$app->getUser()->getDisplayName() ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php if (!Yii::$app->user->isGuest): ?>
                                <img src="<?= $avatar ?>" class="img-circle"
                                     alt="User Image"/>
                                <p>
                                    <?= Yii::$app->getUser()->getDisplayName() ?>
                                    <small>Member since April. 2015</small>
                                </p>
                            <?php else: ?>
                                <small>Be a registered user...</small>
                            <?php endif;?>

                        </li>
                        <!-- ./User image -->

                        <?php if (!Yii::$app->user->isGuest): ?>
                        <!-- Menu Body Registered User -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Submitted Reports</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Subscriptions</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Statistics</a>
                            </div>
                        </li>
                        <?php else:?>
                            <!-- Menu Body Guest -->

                        <?php endif;?>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <?php if (!Yii::$app->user->isGuest): ?>
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <?php else:?>
                                <div class="pull-right">
                                    <?= Html::a(
                                        'Sign In',
                                        ['/site/login'],
                                        ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                    ) ?>
                                </div>
                            <?php endif;?>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->

            </ul>
        </div>

        <a href="#" class="sidebar-toggle" data-toggle="control-sidebar" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
    </nav>
</header>
