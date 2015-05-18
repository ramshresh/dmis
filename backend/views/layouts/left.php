<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Nav;
//$avatar = (Yii::$app->user->isGuest)?"$directoryAsset/img/avatar.png":"$directoryAsset/img/user2-160x160.jpg";
$avatar = (Yii::$app->user->isGuest)?Yii::$aliases['@web']."/img/user-avatar-placeholder.png":Yii::$aliases['@web']."/img/user-avatar-placeholder.png";

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
       <!-- <div class="user-panel">
            <div class="pull-left image">
                <img src="<?/*= $avatar */?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?/*= Yii::$app->getUser()->getDisplayName()*/?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    '<li class="header">Menu</li>',
                    [
                        'label' => '<span class="fa fa-dashboard text-green"></span> Dashboard',
                        'url' => ['/user/admin'],
                    ],
                    [
                        'label' => '<span class="fa fa-users text-aqua"></span> Users',
                        'url' => ['/user/admin'],
                    ],
                    [
                        'label' => '<span class="fa fa-sign-in text-blue"></span> Sign in', //for basic
                        'url' => ['/site/login'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                    [
                        'label' => '<span class="fa fa-sign-out text-red"></span> Sign out', //for basic
                        'url' => ['/site/logout'],
                        'visible' =>!Yii::$app->user->isGuest
                    ],
                ],
            ]
        );
        ?>
<hr>
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-thin"></i> <span>Items</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['/rapid_assessment/crud-item/create']) ?>"><span class="fa fa-plus-square"></span> Add</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/rapid_assessment/crud-item/index']) ?>"><span class="fa fa-table"></span> Table</a>
                    </li>
                    <!--<li>
                        <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-thin"></i> <span>Item Types</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['/rapid_assessment/crud-item-type/create']) ?>"><span class="fa fa-plus-square"></span> Add</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/rapid_assessment/crud-item-type/index']) ?>"><span class="fa fa-table"></span> Table</a>
                    </li>
                    <!--<li>
                        <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                </ul>
            </li>

        </ul>
    </section>
</aside>
