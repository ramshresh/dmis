<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/12/2015
 * Time: 11:51 AM
 */
/* @var $this yii\web\View; */

use common\assets\IconsReportingAsset;
use common\assets\Ol3Asset;
use common\assets\Ol3LayerSwitcherAsset;
use common\assets\Ol3PopupAsset;
use yii\jui\JuiAsset;

Ol3Asset::register($this);
Ol3LayerSwitcherAsset::register($this);
Ol3PopupAsset::register($this);
IconsReportingAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
JuiAsset::register($this);
?>
<style>
    .ol-popup-closer:after {
        content: "[x]";
        color: red;
        font-size: 16px;
    }

    .ol-popup {
        display: none;
        position: absolute;
        background-color: white;
        padding: 15px;
        border: 1px solid rgb(57,52,86);;
        bottom: 12px;
        left: -50px;
    }


    .ol-popup:before {
        border-top-color: rgb(57,52,86);
        border-width: 11px;
        left: 48px;
        margin-left: -11px;
    }
    .layer-switcher{
        top:150px
    }
</style>
<div id="map"></div>
<!---------------------- Main Content Search Starts -------------------------->
<div id="navbar" class="col-lg-12 col-md-12 col-sm-12 row">
    <div class="col-md-4">
        <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
            <li class="active">
                <a href="#quicksearch" data-toggle="tab">
                    <button type="button" class="btn btn-info"><i style="font-size: 22px;color:royalblue" class="icon-search"></i></button>
                </a>
            </li>
            <li>
                <a href="#reporting" data-toggle="tab">
                    <button type="button" class="btn btn-info"><i style="font-size: 22px;color:#DE007B" class="icon-reporting"></i></button>
                </a>
            </li>
            <li>
                <a href="#home" data-toggle="tab">
                    <button type="button" class="btn btn-info"><i style="font-size: 22px;color:#04C9A6;" class="icon-line-chart"></i></button>
                </a>
            </li>
            <li>
                <a href="#settings" data-toggle="tab">
                    <button type="button" class="btn btn-info"><i style="font-size: 22px;color:orange" class="icon-resource"></i></button>

                </a>
            </li>
        </ul>

        <div class="tab-content col-md-9" style="border:1px solid #ebebeb;">
            <div class="tab-pane active" id="quicksearch">
                <form role="form" class="form-horizontal form-groups-bordered">
                    <div class="form-group" style="margin-top:10px;margin-bottom:0 !important;">

                        <div class="col-md-12">
                            <select name="test" class="selectboxit">
                                <option value="1">Select Option</option>
                                <option value="2">Building Damage</option>
                                <option value="3">Public Building Damage</option>
                                <option value="4">Infastructure Damage</option>
                                <option value="5">Washington</option>

                            </select>

                        </div>
                        <div class="col-md-12">
                            <select name="test" class="selectboxit">
                                <option value="1">Select District</option>
                                <option value="2">Fully</option>
                                <option value="3">Moderate</option>
                                <option value="4">Not</option>

                            </select>

                        </div>
                        <button type="button" class="btn btn-success" style="margin-left:30%;margin-top:10px;padding:6px 20px;">Quick Search</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="reporting">
                <h4>Reporting</h4>
                <form role="form" class="form-horizontal form-groups-bordered" style="margin-top:20px;">
                    <div class="form-group" style="margin-bottom:0 !important;">
                        <div class="col-md-12">
                            <select name="test" class="selectboxit">
                                <option value="1">Select Incident</option>
                                <option value="2">Building Damage</option>
                                <option value="3">Public Building Damage</option>
                                <option value="4">Infastructure Damage</option>
                                <option value="5">Washington</option>

                            </select>

                        </div>
                        <div class="col-md-12">
                            <select name="test" class="selectboxit">
                                <option value="1">Damage Type</option>
                                <option value="2">Fully</option>
                                <option value="3">Moderate</option>
                                <option value="4">Not</option>

                            </select>

                        </div>
                        <div class="panel-title" style="margin-left:10px;padding:10px 0;color:orange">
                            Impacts
                        </div>
                        <label for="field-1" class="col-md-2 control-label">Dead</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="field-1" placeholder="No.">
                        </div>
                        <label for="field-1" class="col-md-2 control-label">Injured</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="field-1" placeholder="No.">
                        </div>
                        <label for="field-1" class="col-md-2 control-label">Missing</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="field-1" placeholder="No.">
                        </div>
                        <div class="clearfix"></div>

                        <div class="panel-title" style="margin-left:10px;padding:10px 0;color:#04C9A6">
                            Needs
                        </div>
                        <label for="field-1" class="col-md-2 control-label">Tent</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="field-1" placeholder="No.">
                        </div>
                        <label for="field-1" class="col-md-2 control-label">Food</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="field-1" placeholder="No.">
                        </div>
                        <label for="field-1" class="col-md-2 control-label">Medicine</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="field-1" placeholder="No.">
                        </div>
                        <label for="field-1" class="col-md-2 control-label">Water</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="field-1" placeholder="No.">
                        </div>
                        <label for="field-1" class="col-md-2 control-label">Ambulance</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="field-1" placeholder="No.">
                        </div>
                        <label for="field-1" class="col-md-2 control-label">Fuel</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="field-1" placeholder="No.">
                        </div>
                        <button type="button" class="btn btn-success" style="margin-left:35%;margin-top:10px;padding:6px 20px;">Submit</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="home">

                <div class="scrollable" data-height="500">
                    <form role="form" class="form-horizontal form-groups-bordered">

                        <div class="form-group" style="margin-top:15px !important;">
                            <div class="col-md-12">
                                <select name="test" class="selectboxit">
                                    <optgroup label="United States">
                                        <option value="1">Select</option>
                                        <option value="2">Boston</option>
                                        <option value="3">Ohaio</option>
                                        <option value="4">New York</option>
                                        <option value="5">Washington</option>
                                    </optgroup>
                                </select>

                            </div>

                            <div class="col-md-12">
                                <select name="test" class="selectboxit">
                                    <optgroup label="United States">
                                        <option value="1">Select</option>
                                        <option value="2">Boston</option>
                                        <option value="3">Ohaio</option>
                                        <option value="4">New York</option>
                                        <option value="5">Washington</option>
                                    </optgroup>
                                </select>

                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" data-format=" yyyy MM dd" placeholder="From">

                                    <div class="input-group-addon">
                                        <a href="#"><i class="entypo-calendar" style="color:#04C9A6"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" data-format=" yyyy MM dd" placeholder='To'>
                                    <div class="input-group-addon">
                                        <a href="#"><i class="entypo-calendar" style="color:orange"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <select name="test" class="selectboxit">
                                    <optgroup label="United States">
                                        <option value="1">Select</option>
                                        <option value="2">Boston</option>
                                        <option value="3">Ohaio</option>
                                        <option value="4">New York</option>
                                        <option value="5">Washington</option>
                                    </optgroup>
                                </select>

                            </div>

                        </div>


                        <div class="form-group" style="margin:0;padding:0">
                            <div class="row" style="margin:0 3px">

                                <ul class="nav nav-tabs left-aligned">
                                    <li class="active"><a href="#home-2" data-toggle="tab">
                                            <span class="visible-xs"><i class="entypo-home"></i></span>
                                            <span class="hidden-xs">Summary</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#profile-2" data-toggle="tab">
                                            <span class="visible-xs"><i class="entypo-user"></i></span>
                                            <span class="hidden-xs">Table</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content inside">
                                    <div class="tab-pane active" id="home-2">

                                        <div class="scrollable" data-height="220" style="padding:0 10px;">

                                            <p>Carriage quitting securing be appetite it declared. High eyes kept so busy feel call in. Would day nor ask walls known. But preserved advantage are but and certainty earnestly enjoyment. Passage weather as up am exposed. And natural related man subject. Eagerness get situation his was delighted. </p>

                                            <p>Fulfilled direction use continual set him propriety continued. Saw met applauded favourite deficient engrossed concealed and her. Concluded boy perpetual old supposing. Farther related bed and passage comfort civilly. Dashwoods see frankness objection abilities the. As hastened oh produced prospect formerly up am. Placing forming nay looking old married few has. Margaret disposed add screened rendered six say his striking confined. </p>

                                            <p>When be draw drew ye. Defective in do recommend suffering. House it seven in spoil tiled court. Sister others marked fat missed did out use. Alteration possession dispatched collecting instrument travelling he or on. Snug give made at spot or late that mr. </p>

                                            <p>Luckily friends do ashamed to do suppose. Tried meant mr smile so. Exquisite behaviour as to middleton perfectly. Chicken no wishing waiting am. Say concerns dwelling graceful six humoured. Whether mr up savings talking an. Active mutual nor father mother exeter change six did all. </p>

                                        </div>

                                    </div>
                                    <div class="tab-pane" id="profile-2">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Type</th>
                                                <th>Location</th>
                                                <th>Route</th>

                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr>
                                                <td>Subash</td>
                                                <td>Nushi</td>
                                                <td>Kathmandu</td>
                                                <td>Test</td>
                                            </tr>

                                            <tr>
                                                <td>Subash</td>
                                                <td>Nushi</td>
                                                <td>Kathmandu</td>
                                                <td>Test</td>
                                            </tr>

                                            <tr>
                                                <td>Subash</td>
                                                <td>Nushi</td>
                                                <td>Kathmandu</td>
                                                <td>Test</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <br />

                            </div>
                        </div>

                    </form>
                </div>

            </div>

            <div class="tab-pane" id="settings">


                <p>Fulfilled direction use continual set him propriety continued. Saw met applauded favourite deficient engrossed concealed and her. Concluded boy perpetual old supposing. Farther related bed and passage comfort civilly. Dashwoods see frankness objection abilities the. As hastened oh produced prospect formerly up am. Placing forming nay looking old married few has. Margaret disposed add screened rendered six say his striking confined. </p>

                <p>When be draw drew ye. Defective in do recommend suffering. House it seven in spoil tiled court. Sister others marked fat missed did out use. Alteration possession dispatched collecting instrument travelling he or on. Snug give made at spot or late that mr. </p>
            </div>
        </div>


    </div>


    <div class="col-lg-5 col-md-12 col-sm-12">
        <div class="input-group">
            <input type="text" class="form-control search" placeholder="Enter Location Here">
				<span class="input-group-btn search_btn">
					<button class="btn btn-primary" type="button" style="padding:9px 12px"><i class="entypo-search"></i></button>
				</span>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-12 toolbar-menu">
        <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Graph" data-original-title="Graph"><i style="font-size: 22px;color:#E47124;" class="icon-earthquake"></i></button>

    </div>

</div>
<!---------------------- Main Content Search Starts -------------------------->

<div class="clearfix"></div>
<!---------------------- Main Content toolbar Starts -------------------------->
<div id="toolbar" style="position:fixed;top:15%;">
    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Geo-Location" data-original-title="Geo Location"><i style="color:#04C9A6;" class="icon-target"></i></button>
</div>
<!---------------------- Main Content toolbar ends -------------------------->
