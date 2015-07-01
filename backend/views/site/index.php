<?php
/* @var $this yii\web\View */

use ramshresh\behaviors\ar\ExtendedBehavior;
use yii\helpers\Url;

$this->title = 'Disaster Information Management System';
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
                <h3>Detail Assessment Survey <h5>After Nepal Earthquake 2015</h5></h3>
                <ul>
                    <li>
                        Traditional Building Inventory Survey
                        <div class="pull-right">
                            <a href="<?= Yii::$app->urlManagerFrontEnd->createAbsoluteUrl(["/tbi"]);?>">
                                <button class="btn btn-infKathmo">Map</button>
                            </a>
                            <a href="<?= Yii::$app->urlManagerBackEnd->createAbsoluteUrl(["/tbi/crud-building"]);?>">
                                <button class="btn btn-info">Admin Page</button>
                            </a>
                        </div>
                    </li>
                    <li>
                        Heritage Survey
                        <div class="pull-right">
                            <a href="<?= Yii::$app->urlManagerFrontEnd->createAbsoluteUrl(["/heritage_assessment"]);?>">
                                <button class="btn btn-infKathmo">Map</button>
                            </a>
                            <a href="<?= Yii::$app->urlManagerBackEnd->createAbsoluteUrl(["/heritage_assessment/crud-heritage"]);?>">
                                <button class="btn btn-info">Admin Page</button>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


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

<?= \ramshresh\behaviors\ar\AutoloadExample::widget(); ?>


