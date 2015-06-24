<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $directoryAdminLteAsset string */

$avatar = (Yii::$app->user->isGuest)?Yii::$aliases['@web']."/img/user-avatar-placeholder.png":Yii::$aliases['@web']."/img/user-avatar-placeholder.png";
?>

<header class="main-header">
    <a href="<?= Yii::$app->homeUrl ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <p>DMIS</p>
        </span>
            <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <p><?= Yii::$app->name ?></p>
        </span>
    </a>


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

                <!-- Control Sidebar:                -->
                <li>
                    <a href="#" data-toggle="control-sidebar">
                        <i class="fa fa-gears"></i>
                    </a>
                </li>
                <!-- /.Control Sidebar:                -->
                
            </ul>
        </div>
    </nav>
</header>


<!--<div class="col-lg-12 col-md-12 header">
    <div class="col-md-4">
    </div>
    <div class="col-md-5">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>

            </div>

        </nav>
    </div>
    <div class="col-md-1 social-media">
        <i class="fa fa-facebook" style="color:royalblue;"></i>
        <i class="fa fa-twitter" style="color:lightblue;"></i>
    </div>
    <div class="col-md-2">
        <ul class="nav navbar-nav nav-right">
            <li data-toggle="modal" ><a href="<?/*=Url::to(['/site/login'])*/?>">Login</a></li>
        </ul>
    </div>
</div>-->

<!-- Models for register ---->
<!--<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Create an Account</h4>
            </div>

            <div class="form-group" style="padding:0 20px;">
                <select name="test" class="selectboxit">
                    <option value="1">Select Type</option>
                    <option value="2">Single</option>
                    <option value="3">Group</option>

                </select>

            </div>
            <div class="form-group" style="padding:0 20px;">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-user-add"></i>
                    </div>

                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" data-mask="[a-zA-Z0-1\.]+" data-is-regex="true" autocomplete="off" />
                </div>
            </div>
            <div class="form-group" style="padding:0 20px;">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-mail"></i>
                    </div>

                    <input type="text" class="form-control" name="email" id="email" data-mask="email" placeholder="E-mail" autocomplete="off" />
                </div>
            </div>
            <div class="form-group" style="padding:0 20px;">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-phone"></i>
                    </div>

                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" data-mask="phone" autocomplete="off" />
                </div>
            </div>


            <div class="form-group" style="padding:0 20px;">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-lock"></i>
                    </div>

                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" autocomplete="off" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color:#734286;border-color:#734286;">Close</button>
                <button type="button" class="btn btn-primary" style="background-color:#04C9A6;border-color:#04C9A6;">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Login</h4>
            </div>

            <div class="form-group" style="padding:0 20px;">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-mail"></i>
                    </div>

                    <input type="text" class="form-control" name="email" id="email" data-mask="email" placeholder="E-mail" autocomplete="off" />
                </div>
            </div>


            <div class="form-group" style="padding:0 20px;">
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="entypo-lock"></i>
                    </div>

                    <input type="password" class="form-control" name="password" id="password" placeholder="Choose Password" autocomplete="off" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="background-color:#734286;border-color:#734286;">Close</button>
                <button type="button" class="btn btn-primary" style="background-color:#04C9A6;border-color:#04C9A6;">Login</button>
            </div>
        </div>
    </div>
</div>-->
<!-- ends of modals -->


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home text-aqua"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        <li><a href="#control-sidebar-mapdetails-tab" data-toggle="tab"><i class="fa fa-map-marker text-green"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">

        </div><!-- /.tab-pane -->
         <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">

        </div><!-- /.tab-pane -->

        <!--  Map tab  -->
        <div class="tab-pane" id="control-sidebar-mapdetails-tab">

        </div>
        <!--  /.Map tab  -->

    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>