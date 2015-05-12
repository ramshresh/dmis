<?php
/**
 * @var $this \yii\web\View
 * @var $content
 */
use frontend\assets\AppAsset;
use frontend\assets\SubashAsset;
use ramshresh\assets\adminlte\web\AdminLteAsset;
use yii\helpers\Html;
use yii\helpers\Url;
AdminLteAsset::register($this);
AppAsset::register($this);

$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="page-body">
    <?php $this->beginBody() ?>

    <div class="wrap">

        <div class="col-lg-12 col-md-12 header">
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
                    <!--<li data-toggle="modal" data-target="#basicModal"><a href="<?/*=Url::to(['site/login'])*/?>">Register</a></li>-->
                    <!--<li data-toggle="modal" data-target="#login"><a href="#">Login</a></li>-->
                    <li data-toggle="modal" ><a href="<?=Url::to(['/site/login'])?>">Login</a></li>
                </ul>
            </div>
        </div>

        <!-- Models for register ---->
        <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
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
        </div>
        <!-- ends of modals -->

        <?=$content ?>
    </div>




    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>