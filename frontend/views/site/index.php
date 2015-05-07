<?php
/**
 * @var $this \yii\web\View;
 */


use common\assets\Ol3Asset;
use common\assets\Ol3LayerSwitcherAsset;
use common\assets\Ol3PopupAsset;
use frontend\assets\NeonAsset;
use frontend\assets\SubashAsset;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\JqueryAsset;
use yii\web\YiiAsset;

//JqueryAsset::register($this);
Ol3Asset::register($this);
Ol3LayerSwitcherAsset::register($this);
Ol3PopupAsset::register($this);
SubashAsset::register($this);
//NeonAsset::register($this);

$this->registerJsFile('@web/src/map/js/map.js');
$this->registerCssFile('@web/src/map/css/map.css');

?>



<div id="map"></div>

<div class="col-lg-12 col-md-12 header">
    <div class="col-md-4">
    </div>
    <div class="col-md-5">
        <nav class="navbar navbar-default" role="navigation">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </div>
    <div class="col-md-1 social-media">
        <i class="entypo-facebook" style="color:royalblue;"></i>
        <i class="entypo-twitter" style="color:lightblue;"></i>
    </div>
    <div class="col-md-2">
        <ul class="nav navbar-nav nav-right">
            <li data-toggle="modal" data-target="#basicModal"><a href="#">Register</a></li>
            <li><a href="#">Login</a></li>
        </ul>
    </div>
</div>
<div class="clearfix"></div>

<div id="navbar" class="col-lg-12 col-md-12 col-sm-12">
    <div class="col-lg-4 col-md-4 col-sm-12 toolbar-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-placement="bottom"><i style="font-size: 22px;color:#04C9A6;" class="icon-line-chart"></i></button>

                <ul class="dropdown-menu">
                    <form role="form" class="form-horizontal form-groups-bordered">
                        <div class="form-group" style="margin:5px !important;">
                            <div class="col-md-6">
                                <select name="" class="selectboxit">
                                        <option value="1">Select report type</option>
                                        <option value="all">All</option>
                                        <option value="event">Event</option>
                                        <option value="incident">Incident</option>
                                        <option value="impact">Impact</option>
                                        <option value="need">Need</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <select name="test" class="selectboxit">
                                        <option value="1">Select report subtype</option>
                                    <optgroup label="selected event type">
                                        <option value="all">All</option>
                                        <option value="Fire">Fire</option>
                                        <option value="Earthquake">Earthquake</option>
                                        <option value="Landslide">Landslide</option>
                                    </optgroup>
                                    <optgroup label="selected incident type">
                                        <option value="all">All</option>
                                        <option value="Fire">Fire</option>
                                        <option value="Landslide">Landslide</option>
                                        <option value="Landslide">Building Damage</option>
                                        <option value="Landslide">Building Damage</option>
                                    </optgroup>
                                    <optgroup label="selected impact type">
                                        <option value="all">All</option>
                                        <option value="Death">Death</option>
                                        <option value="Injury">Injury</option>
                                        <option value="Missing">Missing</option>
                                        <option value="Homelesss">Homeless</option>
                                    </optgroup>
                                    <optgroup label="selected need type">
                                        <option value="all">All</option>
                                        <option value="Shelter">Shelter</option>
                                        <option value="Food">Food</option>
                                        <option value="Water">Water</option>
                                        <option value="Fuel">Fuel</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" data-format=" yyyy MM dd" placeholder="From">

                                    <div class="input-group-addon">
                                        <a href="#"><i class="entypo-calendar"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" data-format=" yyyy MM dd" placeholder='To'>
                                    <div class="input-group-addon">
                                        <a href="#"><i class="entypo-calendar"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                            <div class="row" style="margin:0 5px">

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

                                <div class="tab-content">
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
                </ul>
            </li>
            <li class="dropdown">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-placement="bottom"><i style="font-size: 22px;color:#DE007B" class="icon-reporting"></i></button>

                <ul class="dropdown-menu" style="min-width:350px;">
                    <form role="form" class="form-horizontal form-groups-bordered" method="post" action="/girc/dmis/api/rapid_assessment/report-items/ReportItemIncident/create">
                        <div class="form-group" style="margin:15px !important;">
                            <div class="col-md-12">
                                <select name="[ReportItemIncident][event]" class="selectboxit">
                                    <option value="1">Select Event</option>
                                    <option value="2">Earthquake</option>
                                    <option value="3">Fire</option>
                                    <option value="4">Landslide</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <select name="[ReportItemIncident][item_name]" class="selectboxit">
                                    <option value="1">Select Incident</option>
                                    <option value="2">Building Damage</option>
                                    <option value="3">Public Building Damage</option>
                                    <option value="4">Infastructure Damage</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <select name="[ReportItemIncident][class_name]" class="selectboxit">
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
                                <input type="text" class="form-control" id="field-1" name="[ReportItemImpact][new1][magnitude]" placeholder="No.">
                            </div>
                            <label for="field-1" class="col-md-2 control-label">Injured</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="field-1" placeholder="No." name="[ReportItemImpact][new2][magnitude]">
                            </div>
                            <label for="field-1" class="col-md-2 control-label">Missing</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="field-1" name="[ReportItemImpact][new3][magnitude]" placeholder="No.">
                            </div>
                            <div class="clearfix"></div>

                            <div class="panel-title" style="margin-left:10px;padding:10px 0;color:#04C9A6">
                                Needs
                            </div>
                            <label for="field-1" class="col-md-2 control-label">Tent</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="field-1" name="[ReportItemNeed][new1][magnitude]" placeholder="No.">
                            </div>
                            <label for="field-1" class="col-md-2 control-label">Food</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="field-1" placeholder="No.">
                            </div>
                            <label for="field-1" class="col-md-2 control-label">Medicine</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="field-1" placeholder="No.">
                            </div>
                            <label for="field-1" class="col-md-2 control-label">Medicine</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="field-1" placeholder="No.">
                            </div>
                            <label for="field-1" class="col-md-2 control-label">Medicine</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="field-1" placeholder="No.">
                            </div>
                            <label for="field-1" class="col-md-2 control-label">Medicine</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="field-1" placeholder="No.">
                            </div>
                            <label for="field-1" class="col-md-2 control-label">Medicine</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="field-1" placeholder="No.">
                            </div>
                            <label for="field-1" class="col-md-2 control-label">Medicine</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="field-1" placeholder="No.">
                            </div>
                            <button type="submit" class="btn btn-success" style="margin-left:35%;margin-top:10px;padding:6px 20px;">Submit</button>
                        </div>
                    </form>
                </ul>
            </li>
            <li class="dropdown">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-placement="bottom"><i style="font-size: 22px;color:royalblue" class="icon-search"></i></button>

                <ul class="dropdown-menu">
                    <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">User stats <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">Favourites Snippets <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-placement="bottom"><i style="font-size: 22px;color:orange" class="icon-resource"></i></button>

                <ul class="dropdown-menu">
                    <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">User stats <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">Favourites Snippets <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-placement="bottom"><i style="font-size: 22px;color:#734286" class="icon-routing"></i></button>

                <ul class="dropdown-menu">
                    <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">User stats <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">Favourites Snippets <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                    <li class="divider"></li>
                    <li><a href="#">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                </ul>
            </li>

        </ul>
    </div>

    <!--
    <div class="col-md-4">
    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Direction"><i style="font-size: 18px;" class="icon-routing"></i></button>
    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Geofence"><i style="font-size: 18px;" class="icon-geofence"></i></i></button>
    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Resources"><i style="font-size: 18px;" class="icon-resource"></i></i></button>
    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Updates"><i style="font-size: 18px;" class="icon-update"></i></i></button>
    </div>-->

    <div class="col-lg-5 col-md-12 col-sm-12">
        <div class="input-group">
            <input id="input-search" type="text" class="form-control search" placeholder="Enter Location Here">
				<span class="input-group-btn search_btn">
					<button class="btn btn-primary" type="button" style="padding:9px 12px"><i class="entypo-search"></i></button>
				</span>
        </div>
    </div>
    <?php
    $JsAddressSearch = <<<JS


        $("#input-search").autocomplete({
            delay: 500,
            minLength: 3,
            source: function(request, response) {
                $.getJSON("http://open.mapquestapi.com/nominatim/v1/search.php?format=json", {
                    // do not copy the api key; get your own at developer.rottentomatoes.com

                    q: request.term

                }, function(data) {
                    // data is an array of objects and must be transformed for autocomplete to use
                    var array = data.error ? [] : $.map(data, function(m) {
                        return {
                            label: m.display_name,
                            lat : parseFloat(m.lat),
                            lon : parseFloat(m.lon),
                            url: m.icon
                        };
                    });
                    response(array);
                });
            },
            search:function(event, ui){
                var self=this;
                   $('#input-search').addClass('loadinggif');
                },
            response:function( event, ui ){
                var self= this;
                   $('#input-search').removeClass('loadinggif');
            },
            focus: function(event, ui) {
                // prevent autocomplete from updating the textbox
                event.preventDefault();
            },
            select: function(event, ui) {
                // prevent autocomplete from updating the textbox
                event.preventDefault();
                var position =ol.proj.transform(
                [ui.item.lon,ui.item.lat], 'EPSG:4326', 'EPSG:3857'
                );
                map.getView().setCenter(position);
                map.getView().setZoom(12);
                // Adding overlay marker
                map.addOverlay(new ol.Overlay({
                  position:position,
                  element:  $('<img src="http://116.90.239.21/girc/dmis/img/location.png" style="width:32px;height:auto;">')
                                 .css({marginTop: '-200%', marginLeft: '-50%', cursor: 'pointer'})
                                .popover({
                                  'placement': 'top',
                                  'html': true,
                                  'content':'<strong>'+ui.item.label+'</strong>'
                                })
                               .on('click', function (e) { $(".location-popover").not(this).popover('hide').close; })
                }));
            }
        });
        $("#input-search").autocomplete( "instance" )._renderItem = function( ul, item ) {
          return $( "<li>" )
            .append( "<a>" + item.label + "</a></br>" )
            .append( "<a>(" + item.lat +' '+item.lon + ")</a>" )
            .appendTo( ul );
        };
        $("#input-search").autocomplete( "instance" )._renderMenu= function( ul, items ) {
          var that = this;
          $.each( items, function( index, item ) {
            that._renderItemData( ul, item );
          });
          $( ul ).find( "li:odd" ).addClass( "odd" );
          $( ul ).find( "li:even" ).addClass( "even" );
        };
        $("#input-search").autocomplete( "instance" )._resizeMenu= function() {
           var ul = this.menu.element;
             ul.outerWidth(this.element.outerWidth());
        };
JS;
    //$this->registerJs($JsAddressSearch, $this::POS_READY);
    ?>
    <div class="col-lg-3 col-md-3 col-sm-12 toolbar-menu">
        <ul class="nav navbar-nav" style="float:left">
            <li class="dropdown">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-placement="bottom"><i style="font-size: 22px;color:#04C9A6;" class="icon-earthquake"></i></button>
            </li>
        </ul>
    </div>

</div>

<div class="clearfix"></div>

<div id="toolbar">
    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Geo-Location" data-original-title="Geo Location"><i style="color:#04C9A6;" class="icon-target"></i></button>
</div>


<div id="toolbar-left">

    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="" data-original-title="Download-Apps"><i style="font-size:100px; color:#f1f1f1;" class="fa fa-android"></i></button>

</div>
<div>
</div>

<!-- Models for register ---->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Basic Modal</h4>
            </div>
            <div class="modal-body">
                <h3>Modal Body</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- ends of modals -->


