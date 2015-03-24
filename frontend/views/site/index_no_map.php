<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<?php $this->beginBlock('nav-login-form', false) ?>
    <div class="dropdown-menu" style="padding:17px;">
        <form class="form" id="formLogin">
            <input name="username" id="username" placeholder="Username" type="text">
            <input name="password" id="password" placeholder="Password" type="password"><br>
            <button type="button" id="btnLogin" class="btn">Login</button>
        </form>
    </div>
<?= \common\modules\user\widgets\login\LoginWidget::widget(['formType'=>\common\modules\user\widgets\login\LoginWidget::TYPE_NAVBAR_INLINE]); ?>
<?php $this->endBlock(); ?>
<div class="site-index">
    <div class="jumbotron">
        <h2>Welcome!</h2>
        <p class="lead">Here you can get information of disaster events</p>
        <p><a class="btn btn-lg btn-success" href="#">Get to map</a></p>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h3>Incident Reporting</h3>
                <p>Any one can report incidents of a disaster incident using Android Smart Phones, Web Browser, SMS</p>
                <p><a class="btn btn-default" href="#">Start Reporting&raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h3>Resource Tracking</h3>
                <p>User can track the locations of ambulance deployed during emergency response</p>
                <p><a class="btn btn-default" href="#/">Track Ambulance &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h3>Geofence & Alerts</h3>
                <p>Admin can demarcate any area for potential hazard. User can subscribe to </p>
                <p><a class="btn btn-default" href="#">View Geofence and Alerts &raquo;</a></p>
            </div>
        </div>
    </div>
</div>
<?php
$fr_site_index_jumborton=<<<CSS
CSS;
?>