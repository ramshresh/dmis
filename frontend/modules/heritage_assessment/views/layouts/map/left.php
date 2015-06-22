<?php
/* @var $this \yii\web\View */
/* @var $content string */
/* @var $directoryAdminLteAsset string */

use yii\bootstrap\Nav;
use yii\helpers\Url;

//$avatar = (Yii::$app->user->isGuest)?"$directoryAsset/img/avatar.png":"$directoryAsset/img/user2-160x160.jpg";
$avatar = (Yii::$app->user->isGuest)?Yii::$aliases['@web']."/img/user-avatar-placeholder.png":Yii::$aliases['@web']."/img/user-avatar-placeholder.png";

?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
       <!-- <ul class="sidebar-menu">
            <li>
                <a href="<?/*= Url::toRoute(['/dashboard/index'])*/?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa ion-map"></i>
                    <span>Maps</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-thin"></i> Country Profile</a></li>
                    <li><a href="#"><i class="fa fa-circle-thin"></i> Global Incidents</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa ion-grid"></i>
                    <span>Modules</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-thin"></i> Ambulance Tracking</a></li>
                    <li><a href="#"><i class="fa fa-circle-thin"></i> Social Media Reporting</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa ion-clipboard"></i> <span>Submit Report</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashcube"></i>
                    <span>Tools</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a></li>
                    <li><a href="#"><i class="fa fa-upload"></i> Upload</a></li>
                </ul>
            </li>

        </ul>-->
    </section>
    <!-- /.sidebar -->
</aside>
