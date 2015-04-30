<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/9/2015
 * Time: 6:29 AM
 */
use yii\helpers\Url;
use yii\widgets\Pjax;

$widgets = ['dashboard/rapid-assessment/manage-items' => 'Manage reporting items']
?>
<style>

    .glyphicon {
        margin-right: 10px;
    }

    /* CSS used here will be applied after bootstrap.css */
    .panel a {
        color: #777;
    }

    .panel-scroll {
        /*max-height: 320px;*/
        overflow: hidden;
        overflow-y: auto;
    }

    .panel a:hover {
        text-decoration: none;
        color: #222;
    }

    .panel .table td {
        border-color: #f3f3f3;
    }
</style>
<div class="row">
    <div id="dashboardMenu" class="col-sm-3 sidebar">
        <div class="panel panel-group" id="main">
            <div class="panel-body">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#main" href="#accordion"><span
                                class="glyphicon glyphicon-th-large"></span> Modules</a>
                    </h4>
                </div>
                <div class="panel-collapse collapse panel-scroll" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span
                                        class="glyphicon glyphicon-rapid-assessment"></span> Rapid Assessment</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="<?= Url::toRoute(['dashboard', 'view' => 'rapid-assessment/manage-items']) ?>"
                                               data-pjax="#pjaxDashboardContent">
                                                <span
                                                    class="glyphicon glyphicon-ra-item text-primary">

                                                </span>
                                                Manage Items
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="<?= Url::toRoute(['rapid-assessment', 'view' => 'manage-report-items']) ?>"
                                               data-pjax="#pjaxDashboardContent">
                                                <span
                                                    class="glyphicon glyphicon-ra-report-item text-primary">
                                                </span>
                                                Manage Submitted Reports Items
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span
                                        class="glyphicon glyphicon-twitter"></span> Social Media Reporting</a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse ">
                            <div class="panel-body">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="#">Change Password</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">Notifications</a> <span class="label label-info">9</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">Import</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#" class="text-danger"><span
                                                    class="glyphicon glyphicon-trash text-danger"></span> Delete
                                                Account</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span
                                        class="glyphicon glyphicon-ambulance"></span> Ambulance Tracking</a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse ">
                            <div class="panel-body">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="#">Orders</a> <span class="label label-success">$ 42</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">Invoices</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">Shipments</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#">Logging</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                    <span class="glyphicon glyphicon-reports"></span> Reports</a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <a href="#"><span class="glyphicon glyphicon-usd"></span> Sales</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#"><span class="glyphicon glyphicon-user"></span> Customers</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#"><span class="glyphicon glyphicon-tasks"></span> Products</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="#"><span class="glyphicon glyphicon-shopping-cart"></span>
                                                Shopping Cart</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-sm-9 main">
        <?php Pjax::begin(['id' => 'pjaxDashboardContent', 'linkSelector' => '#dashboardMenu a']); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
