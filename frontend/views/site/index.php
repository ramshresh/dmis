<?php
/**
 * @var $this yii\web\View;
 */
use common\assets\Ol3Asset;
use common\assets\Ol3LayerSwitcherAsset;
use common\assets\Ol3PopupAsset;
use frontend\assets\SubashAsset;


Ol3Asset::register($this);
Ol3LayerSwitcherAsset::register($this);
Ol3PopupAsset::register($this);
SubashAsset::register($this);


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
    </style>

<div id="map"></div>

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
<i class="entypo-facebook" style="color:royalblue;"></i>
<i class="entypo-twitter" style="color:lightblue;"></i>
</div>
<div class="col-md-2">
<ul class="nav navbar-nav nav-right">
			<li data-toggle="modal" data-target="#basicModal"><a href="#">Register</a></li>
			<li data-toggle="modal" data-target="#login"><a href="#">Login</a></li>
		</ul>
</div>
</div>
<div class="clearfix"></div>

<div id="navbar" class="col-lg-12 col-md-12 col-sm-12">
<div class="col-lg-4 col-md-4 col-sm-12 toolbar-menu">
<ul class="nav navbar-nav">
<!--filter by parameters start-->
<li class="dropdown">
          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-placement="bottom"><i style="font-size: 22px;color:#04C9A6;" class="icon-line-chart"></i></button>

         <ul class="dropdown-menu">
            <form role="form" class="form-horizontal form-groups-bordered">

					<div class="form-group" style="margin-top:25px !important;">
						<div class="col-md-6">
<!--							<select name="test" class="selectboxit" id="search_type">-->
							<select name="test" class="" id="search_type">
									<option value="">Select type</option>
							</select>
						</div>

						<div class="col-md-6">
<!--							<select name="test" class="selectboxit"  id="search_subtype">-->
							<select name="test" class=""  id="search_subtype">
								<optgroup label="Sub Type">
									<option value="1">Select subtype</option>
								</optgroup>
							</select>

						</div>
						<div class="col-md-6">
							<div class="input-group">
								<input type="text" class="form-control datepicker" data-format=" yyyy MM dd" placeholder="From" id="search_start_date">

								<div class="input-group-addon">
									<a href="#"><i class="entypo-calendar"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group">
								<input type="text" class="form-control datepicker" data-format=" yyyy MM dd" placeholder='To' id="search_end_date">
								<div class="input-group-addon">
									<a href="#"><i class="entypo-calendar"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<select name="test" class="selectboxit">

								<optgroup label="Custom Area" >
									<option value="1" class="btn btn-grey col-sm-12">Select Area</option>

								</optgroup>

								<optgroup label="District" class="scrollable" >
									<option value="1">Select Area</option>

								</optgroup>
								<optgroup label="Vdc/municipality" class="scrollable">
									<option value="1">Select Area</option>

								</optgroup>
							</select>

						</div>
<br>
						<div class="col-md-6">
							<div class="btn btn-primary col-md-12" >Submit</div>

						</div>




					</div>




					<div class="form-group" style="margin:0;padding:0">
						<div class="row" style="margin:0 5px">

		<ul class="nav nav-tabs left-aligned">
			<li class="active"><a href="#search_summary" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-home"></i></span>
					<span class="hidden-xs">Summary</span>
				</a>
			</li>
			<li>
				<a href="#search_table" data-toggle="tab">
					<span class="visible-xs"><i class="entypo-user"></i></span>
					<span class="hidden-xs">Table</span>
				</a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="home-2">

				<div class="scrollable" data-height="220" style="padding:0 10px;" id="search_summary" >

					<p>Carriage quitting securing be appetite it declared. High eyes kept so busy feel call in. Would day nor ask walls known. But preserved advantage are but and certainty earnestly enjoyment. Passage weather as up am exposed. And natural related man subject. Eagerness get situation his was delighted. </p>

					<p>Fulfilled direction use continual set him propriety continued. Saw met applauded favourite deficient engrossed concealed and her. Concluded boy perpetual old supposing. Farther related bed and passage comfort civilly. Dashwoods see frankness objection abilities the. As hastened oh produced prospect formerly up am. Placing forming nay looking old married few has. Margaret disposed add screened rendered six say his striking confined. </p>

					<p>When be draw drew ye. Defective in do recommend suffering. House it seven in spoil tiled court. Sister others marked fat missed did out use. Alteration possession dispatched collecting instrument travelling he or on. Snug give made at spot or late that mr. </p>

					<p>Luckily friends do ashamed to do suppose. Tried meant mr smile so. Exquisite behaviour as to middleton perfectly. Chicken no wishing waiting am. Say concerns dwelling graceful six humoured. Whether mr up savings talking an. Active mutual nor father mother exeter change six did all. </p>

				</div>

			</div>
			<div class="tab-pane" id="search_table">
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
<!--filter by parameters end-->

		<li class="dropdown">
          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-placement="bottom"><i style="font-size: 22px;color:#DE007B" class="icon-reporting"></i></button>

          <ul class="dropdown-menu" style="min-width:350px;">
          <form role="form" class="form-horizontal form-groups-bordered" style="margin-top:20px !important">
            <div class="form-group" style="margin:25px 0 !important;">
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
          </ul>
        </li>
        <li class="dropdown">
          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-placement="bottom"><i style="font-size: 22px;color:royalblue" class="icon-search"></i></button>

          <ul class="dropdown-menu" style="min-width:300px";>
            <form role="form" class="form-horizontal form-groups-bordered">
            <div class="form-group" style="margin:15px 0 !important;">
            	<button type="button" class="btn btn-orange" style="margin-left:30%;margin-top:10px;padding:6px 20px;">Quick Search</button>

						<div class="col-md-12" style="margin-top:20px">
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
						<button type="button" class="btn btn-success" style="margin-left:35%;margin-top:10px;padding:6px 20px;">Submit</button>
					</div>
					</form>
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

</div>


    <script>

        <?php $this->beginBlock('scriptPosReady')?>
        var http = location.protocol;
        var hostName = window.location.hostname;
        var host = http.concat("//").concat(hostName);
        var geoserverPort = 8080;
        var geoserverHost = host.concat(':').concat(geoserverPort);

        /*******************Overlay Group*****************/
        var overlayGroup = new ol.layer.Group({
            title: 'Overlays',
            layers: []
        });

        var baseGroup = new ol.layer.Group({
            'title': 'Base',
            layers: []
        })
        /*
         * earthquake impact clustering start
         * */
        var vectorSource = new ol.source.ServerVector({
            format: new ol.format.GeoJSON({
                //    projection: 'EPSG:3857'
            }),
            //   'crossOrigin':'anonymous',
            loader: function (extent, resolution, projection) {
                //    var url='http://localhost:8080/geoserver/fra/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=fra%3Aambulance&srsname=EPSG:3857&maxFeatures=50&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');
                //var url='http://116.90.239.21:8080/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis:report_item&srsname=EPSG:3857&outputformat=text/javascript&filter=<PropertyIsEqualTo><PropertyName>type</PropertyName><Literal>incident</Literal></PropertyIsEqualTo>&format_options=callback:loadFeatures&bbox=' + extent.join(',');
                //var url='http://116.90.239.21:8080/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis:report_item&cql_filter='+filter+'&srsname=EPSG:3857&outputformat=text/javascript&format_options=callback:loadFeatures' ;//+ extent.join(',');
                var url = 'http://118.91.160.230:8080/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis:report_item&srsname=EPSG:3857&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');


                //var url="http://116.90.239.21:8080/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis:report_item&srsname=EPSG:3857&outputformat=text/javascript&format_options=callback:loadFeatures" + extent.join(',');
                //   var url = 'http://localhost:8080/geoserver/disaster/ows?service=WFS&version=1.0.0&request=GetFeature&layer=disaster:hazard0&outputformat=text/javascript&srsname=EPSG:4326';
                //var url='http://116.90.239.21:8080/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis:report_item&srsname=EPSG:3857&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'jsonp',
                    //jsonp:'jsonp',
                    success: function (data) {
                        //  console.log(data);
                    },
                    error: function (data) {
                        //  console.log(data);
                    },
                    timeout: 30000 // 1 minute timeout
                });
            },
            strategy: ol.loadingstrategy.createTile(new ol.tilegrid.XYZ({
                maxZoom: 19
            }))
            //   projection: 'EPSG:3857'
        });
        var styleCache = {};
        var vector = new ol.layer.Vector({

            source: new ol.source.Cluster({
                distance: 40,
                source: vectorSource
            }),
            //style: styleFunction
            style: function (feature, resolution) {
                var size = feature.get('features').length;
                //console.log(feature);


                //  var style = styleCache[size];
                var stroke = new ol.style.Stroke({color: 'black', width: 2});
                var fill = new ol.style.Fill({color: 'red'});
                if (size === 1) {
                    style = [new ol.style.Style({
                        image: new ol.style.Icon(({
                            src: 'png/need.png',
                            //  src: src_icon(),
                            offset: [1, 1]
                        }))
                    })]
                } else {
                    // styleCache[size] = style;
                    style = styleCache[size];
                    if (!style) {
                        style = [
                            new ol.style.Style({
                                image: new ol.style.Circle({
                                    radius: 17,
                                    stroke: new ol.style.Stroke({
                                        color: '#ffcc33'
                                    }),
                                    fill: new ol.style.Fill({
                                        color: '#000000'
                                    })
                                }),
                                text: new ol.style.Text({
                                    textAlign: "center",
                                    textBaseline: "middle",
                                    font: 'Normal 12px Arial',
                                    text: size.toString(),
                                    fill: new ol.style.Fill({
                                        color: '#ffcc33'
                                    }),
                                    stroke: new ol.style.Stroke({
                                        color: '#000000',
                                        width: 1
                                    }),
                                    offsetX: 0,
                                    offsetY: 0,
                                    rotation: 0
                                })
                            })];
                        styleCache[size] = style;
                    }


                }

                return style;
            }
        });
        window.vector = vector;
        var loadFeatures = function (response) {
            vectorSource.addFeatures(vectorSource.readFeatures(response));
        };
        window.loadFeatures = loadFeatures;
        //vector.getSource().clear();
        overlayGroup.getLayers().push(vector);
        /*end*/
        var view = new ol.View({

            center: ol.proj.transform([87, 29], 'EPSG:4326', 'EPSG:3857'),
            zoom: 2
        });
        var osm = new ol.layer.Tile({
            title: 'OSM',
            type: 'base',
            source: new ol.source.OSM()
        });

        var key = 'Ak-dzM4wZjSqTlzveKz5u0d4IQ4bRzVI309GxmkgSVr1ewS6iPSrOvOKhA-CJlm3';

        var imagery = new ol.layer.Tile({
            source: new ol.source.BingMaps({key: key, imagerySet: 'Aerial'})
        });
        baseGroup.getLayers().push(osm);


        /*******************ol3 map object*****************/
        map = new ol.Map({
            target: 'map',
            renderer: 'canvas',
            layers: [
                baseGroup,
                overlayGroup
            ],
            controls: ol.control.defaults({
                attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
                    collapsible: false
                })
            }).extend([
                new ol.control.LayerSwitcher(),
                new ol.control.ZoomToExtent({
                    //extent: [-180,-90,180,90]
                    extent: [8858052.801082317, 2602714.8048996064, 10081045.253645137, 3825707.2574624266]
                })
            ]),

            view: view
        });
        /***********function for counting unique values in an array**********/
        function unique_count(arr) {
            var a = [], b = [], prev;

            arr.sort();
            for (var i = 0; i < arr.length; i++) {
                if (arr[i] !== prev) {
                    a.push(arr[i]);
                    b.push(1);
                } else {
                    b[b.length - 1]++;
                }
                prev = arr[i];
            }

            return [a, b];
        }
        var highlightStyleCache = {};

        var featureOverlay = new ol.FeatureOverlay({
            map: map,
            style: function (feature, resolution) {
                //console.log(feature);
                //console.log(resolution);
                // var text = resolution < 5000 ? feature.get('name') : '';
                var size = feature.get('features').length;
                if (size == 1) {
                    var text = resolution < 5000 ? (feature.values_.features[0].values_.item_name) : '';
                }
                else {
                    var text = '';
                    var text_array = [];
                    $.each(feature.values_.features, function (index, value) {
                        if (value.values_.type === "need") {
                            text_array.push(value.values_.item_name);
                        }
                    })
                    //console.log($.unique(text_array));
                    var result = unique_count(text_array);
                    //console.log('[' + result[0] + '][' + result[1] + ']')
                }

                if (!highlightStyleCache[text]) {
                    highlightStyleCache[text] = [new ol.style.Style({
                        stroke: new ol.style.Stroke({
                            color: '#f00',
                            width: 1
                        }),
                        fill: new ol.style.Fill({
                            color: 'rgba(0,150,0,0.1)'
                        }),
                        text: new ol.style.Text({
                            font: '12px Calibri,sans-serif',
                            text: text,
                            fill: new ol.style.Fill({
                                color: '#000'
                            }),
                            stroke: new ol.style.Stroke({
                                color: '#00f',
                                width: 3
                            })
                        })
                    })];
                }
                return highlightStyleCache[text];
            }
        });

        var popup = new ol.Overlay.Popup();
        map.addOverlay(popup);
        var image = function (id) {
            $.ajax({
                url: 'http://116.90.239.21/girc/dmis/api/rapid_assessment/report-items',
                data: {
                    expand: 'galleryImages',
                    id: id
                },
                success: function (data) {
                    var src;
                    if (data) {
                        if (data[0]) {
                            if (data[0].galleryImages[0]) {
                                if (data[0].galleryImages[0].src) {
                                    src = data[0].galleryImages[0].src;
                                    console.log(src);
                                }
                            }
                        }
                    } else {
                        console.log('no photo');
                    }

                    if (src) {
                        img_src = '<img src="http://116.90.239.21' + src + '" alt="" style="height:auto;width:200px;">';
                    }
                    else {
                        img_src = '';
                    }
                }
            });
            console.log(img_src);
            return img_src;
        }
        var highlight;
        var displayFeatureInfo = function (pixel) {

            var feature = map.forEachFeatureAtPixel(pixel, function (feature, layer) {
                return feature;
            });

            var info = document.getElementById('info');
            size = feature.get('features').length;
            if (feature) {
                coor_feature = feature.values_.geometry.flatCoordinates;
                if (size == 1) {
                    console.log(feature);
                    //fid = feature.values_.features[0].id_;
                    //id = fid.split('-')[1];
                    id = feature.values_.features[0].id;
                    console.log("id");
                    console.log(id);
                    console.log("id");
                    //	info.innerHTML = feature.getId() + ': ' + feature.get('name');
                    popup.show(coor_feature, '<h4>' + feature.values_.features[0].values_.item_name + '</h4>Human Casulty : ' + feature.values_.features[0].values_.magnitude + image(id));
                }
                else {
                    console.log(feature);
                    var text = '';
                    var text_array = [];
                    $.each(feature.values_.features, function (index, value) {
                        text_array.push(value.values_.item_name);
                    })
                    //console.log($.unique(text_array));
                    var result = unique_count(text_array);

                    if (result[0].length == result[1].length) {
                        length = result[0].length;

                        list = [];
                        for (var i = 0; i < length; i++) {
                            row = {};
                            row.value = result[0][i];
                            row.count = result[1][i];
                            list.push(row);
                        }
                        var popup_content = '<h4>Report Detail</h4><hr>';
                        $.each(list, function (index, value) {
                            popup_content += value.value + ' : ' + value.count + '<br>';
                        })
                        popup.show(coor_feature, popup_content);

                    } else {
                        alert('error arrays not equal');
                    }

                }
            } else {
            }

        };
        map.on('click', function (evt) {
            displayFeatureInfo(evt.pixel);
        });
        ////////////////////////////////////////////////////////////////////////
        var ajaxFirstCall = function(url,dom){
            $.ajax({
                //async: false,
                type: "GET",
                url: url,
                success: function(data) {
                        data.forEach(function(entry) {
                            $("#"+dom).append($('<option></option>').val(entry).html(entry));
                        });
                },
                error:function(){
                    console.log('ajaxFirstCall error');
                }
            })
        };
        var ajaxSecondCall = function(url,dom){
            console.log(url);
            $.ajax({
                async: false,
                type: "GET",
                url: url,
                success: function(data) {
                            json_data = data;
                            console.log(data);

                            $.each(data, function(key, value){
                                //$.each(value, function(_key, _value){

                                $("#"+dom).append('<option value='+value.value+'>'+value.value+'</option>');
                                    console.log(value.value);
                                //	console.log(value)
                                //})

                            });

                        }
            })
        };
        /**
            queryData={
                "attr_value":[
                    {"type":"emergency_situation"},
                    {"item_name":"Emergency Situation"},
                    {"class_name":"Regional"}
                ],
                "date_filter":[
                    {"datefilter_from":"2015-02-15 12:00:00","datefilter_to":"2015-02-15 12:00:00"}
                ]
            }
         */
         var queryData={};
         var first_search_value;

        ajaxFirstCall(host+'/girc/dmis/api/rapid_assessment/report-items/attributes?_format=json','search_type');

        $("#search_type").change ( function () {
                 first_search_value = $(this).val();
                 $("#search_subtype").html('');
                 //ajaxSecondCall('http://116.90.239.21/girc/dmis/api/rapid_assessment/report-items/unique/'+first_search_value+'?_format=json','second_search');
                 console.log(first_search_value);
                 ajaxSecondCall(host+'/girc/dmis/api/rapid_assessment/report-items/unique/type?_format=json','search_subtype');
            });

        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJs($this->blocks['scriptPosReady'], $this::POS_READY); ?>