<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h2>Welcome Administrator!</h2>
        <p class="lead">Here you can manage this website. </p>
        <p><a class="btn btn-lg btn-success" href="<?=Url::toRoute(['dashboard/main'])?>">Get to Dashboard</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-sm-4">
                <h3>User <h5>Administration</h5></h3>

                <p>You can perform tasks on Website Users such as: Send email, Activate/Deactivate users, Change user type  </p>

                <p><a class="btn btn-default" href="#">Manage Users &raquo;</a></p>
            </div>
            <div class="col-sm-4">
                <h3>Incident Reporting <h5>Administration</h3></h2>

                <p>You can perform tasks on Incident Reporting such as: Create Disaster Event, Verify incoming Reports, CRUD operations on Incident Reports, Add/Delete ReportItem, Assign type to ReportItem  </p>

                <p><a class="btn btn-default" href="#">Manage Incident Reporting &raquo;</a></p>
            </div>
            <div class="col-sm-4">
                <h3>Alerts and Geo-fence <h5>Administration</h3></h2>

                <p>You can perform tasks on Alert and Geo-fence such as: Create new Geo-fence, Update/Delete Geo-fence, Manage subscribers of Alerts,  </p>

                <p><a class="btn btn-default" href="#">Manage Alerts & Geo-fence &raquo;</a></p>
            </div>
        </div>

    </div>
</div>


