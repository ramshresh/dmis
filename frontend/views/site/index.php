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
        border: 1px solid rgb(57, 52, 86);
    ;
        bottom: 12px;
        left: -50px;
        height: auto;
        width: 400px;
        max-height: 300px;
        max-width: 400px;

    }
    .ol-popup-content {
        overflow-y:auto;
    }
    .ol-popup:before {
        border-top-color: rgb(57, 52, 86);
        border-width: 11px;
        left: 48px;
        margin-left: -11px;
    }
</style>
    <div id="map" style="height:100%;width:100%;"></div>
<!---------------------- Main Content Search Starts -------------------------->
<div id="navbar" class="col-lg-12 col-md-12 col-sm-12 row">
    <div class="col-md-4">
        <ul class="nav nav-tabs bordered"><!-- available classes "bordered", "right-aligned" -->
            <!--<li class="active">
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
            </li>-->
        </ul>

        <!--<div class="tab-content col-md-9" style="border:1px solid #ebebeb;">
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
                                        <a href="#"><i class="fa fa-calendar" style="color:#04C9A6"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" data-format=" yyyy MM dd" placeholder='To'>
                                    <div class="input-group-addon">
                                        <a href="#"><i class="fa fa-calendar" style="color:orange"></i></a>
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
                                            <span class="visible-xs"><i class="fa fa-home"></i></span>
                                            <span class="hidden-xs">Summary</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#profile-2" data-toggle="tab">
                                            <span class="visible-xs"><i class="fa fa-user"></i></span>
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
        </div>-->


    </div>


   <!-- <div class="col-lg-5 col-md-12 col-sm-12">
        <div class="input-group">
            <input type="text" class="form-control search" placeholder="Enter Location Here">
				<span class="input-group-btn search_btn">
					<button class="btn btn-primary" type="button" style="padding:9px 12px"><i class="fa fa-search"></i></button>
				</span>
        </div>
    </div>-->

    <!--<div class="col-lg-3 col-md-3 col-sm-12 toolbar-menu">
        <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Graph" data-original-title="Graph"><i style="font-size: 22px;color:#E47124;" class="icon-earthquake"></i></button>
    </div>-->

</div>
<!---------------------- Main Content Search Starts -------------------------->

<div class="clearfix"></div>
<!---------------------- Main Content toolbar Starts -------------------------->
<div id="toolbar" style="position:fixed;top:15%;">
    <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Geo-Location" data-original-title="Geo Location"><i style="color:#04C9A6;" class="icon-target"></i></button>
</div>
<!---------------------- Main Content toolbar ends -------------------------->

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
        var vectorSource = new ol.source.ServerVector({
            format: new ol.format.GeoJSON({}),
            loader: function(extent, resolution, projection) {
               // var url = 'http://118.91.160.230:8080/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis:report_item&srsname=EPSG:3857&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');
                var url = 'http://118.91.160.230:8080/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis:report_item_incident&srsname=EPSG:3857&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'jsonp',
                    success: function(data) {},
                    error: function(data) {},
                    timeout: 30000 // 1 minute timeout
                });
            },
            strategy: ol.loadingstrategy.createTile(new ol.tilegrid.XYZ({
                maxZoom: 19
            }))
        });



        var styleCache = {};
        var vector = new ol.layer.Vector({

            source: new ol.source.Cluster({
                distance: 40,
                source: vectorSource
            }),
            //style: styleFunction
            style: function(feature, resolution) {
                var size = feature.get('features').length;
                if (size === 1) {

                    style = [new ol.style.Style({
                        image: new ol.style.Icon(({
                            src: 'http://vignette2.wikia.nocookie.net/fallout/images/7/73/Icon_damage.png/revision/latest?cb=20091010164957',
                            //  src: src_icon(),
                            offset: [1, 1],
                            // size: [32,32],
                            scale: 0.1
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
                            })
                        ];
                        styleCache[size] = style;
                    }
                }

                return style;
            }
        });
        window.vector = vector;
        var loadFeatures = function(response) {
            vectorSource.addFeatures(vectorSource.readFeatures(response));
        };
        window.loadFeatures = loadFeatures;
        overlayGroup.getLayers().push(vector);
        /*end*/

        var nepal_vdc = new ol.layer.Tile({
            title: 'Nepal VDC',
            name: 'Nepal VDC',
            type: 'overlay',
            source: new ol.source.TileWMS(
                ({
                    url: 'http://118.91.160.230:8080/geoserver/wms',
                    params: {
                        'LAYERS': 'dmis:nepal_vdc',
                        'TILED': true
                    }
                }))
        });

        //overlayGroup.getLayers().push(nepal_vdc);

        var view = new ol.View({

            center: ol.proj.transform([87.2345, 29.3535], 'EPSG:4326', 'EPSG:3857'),
            zoom: 4
        });
        var osm = new ol.layer.Tile({
            title: 'OSM',
            type: 'base',
            source: new ol.source.OSM()
        });

        var key = 'Ak-dzM4wZjSqTlzveKz5u0d4IQ4bRzVI309GxmkgSVr1ewS6iPSrOvOKhA-CJlm3';

        var imagery = new ol.layer.Tile({
            source: new ol.source.BingMaps({
                key: key,
                imagerySet: 'Aerial'
            })
        });

        baseGroup.getLayers().push(osm);
        baseGroup.getLayers().push(imagery);


        /*******************ol3 map object*****************/
        map = new ol.Map({
            target: 'map',
            renderer: 'canvas',
            layers: [
                baseGroup,
                overlayGroup
            ],
            controls:
            //ol.control.defaults({
            //    attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
            //        collapsible: false
            //    })
            // }).extend(
                [
                    new ol.control.LayerSwitcher(),
                    new ol.control.Zoom(),
                    // new ol.control.ZoomToExtent({
                    //extent: [-180,-90,180,90]
                    //    extent: [8858052.801082317, 2602714.8048996064, 10081045.253645137, 3825707.2574624266]
                    // })
                ],
            //),

            view: view
        });

        var radius = 100;
        $(document).keydown(function(evt) {
            if (evt.which === 38) {
                radius = Math.min(radius + 5, 150);
                map.render();
            } else if (evt.which === 40) {
                radius = Math.max(radius - 5, 25);
                map.render();
            }
        });

        // get the pixel position with every move
        var mousePosition = null;
        $(map.getViewport()).on('mousemove', function(evt) {
            mousePosition = map.getEventPixel(evt.originalEvent);
            map.render();
        }).on('mouseout', function() {
            mousePosition = null;
            map.render();
        });

        // before rendering the layer, do some clipping
        imagery.on('precompose', function(event) {
            var ctx = event.context;
            var pixelRatio = event.frameState.pixelRatio;
            ctx.save();
            ctx.beginPath();
            if (mousePosition) {
                // only show a circle around the mouse
                ctx.arc(mousePosition[0] * pixelRatio, mousePosition[1] * pixelRatio,
                    radius * pixelRatio, 0, 2 * Math.PI);
                ctx.lineWidth = 5 * pixelRatio;
                ctx.strokeStyle = 'rgba(0,0,0,0.5)';
                ctx.stroke();
            }
            ctx.clip();
        });

        // after rendering the layer, restore the canvas context
        imagery.on('postcompose', function(event) {
            var ctx = event.context;
            ctx.restore();
        });


        /***********function for counting unique values in an array**********/
        function unique_count(arr) {
            var a = [],
                b = [],
                prev;

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
        /*********************/


        var popup = new ol.Overlay.Popup();
        map.addOverlay(popup);

        var popupSetImage = function(id,imgContainer) {
            $.ajax({
                url: 'http://118.91.160.230/girc/dmis/api/rapid_assessment/report-items',
                //url: 'http://118.91.160.230/girc/dmis/api/rapid_assessment/report-items/'+id+'/galleries',
                data: {
                    expand: 'galleryImages,children',
                    id: id
                },
                cache: true,
                success: function(data) {
                    var src;
                    if (data) {
                        if (data[0]) {

                            // gallery images
                            if (data[0].galleryImages[0]) {
                                if (data[0].galleryImages[0].src) {
                                    src = data[0].galleryImages[0].src;
                                    console.log("src");
                                    console.log(src);
                                    console.log("src");
                                }
                            }

                            // needs
                            if (data[0].children[0]) {
                                children=data[0].children;

                                console.log('children');
                                console.log(data[0].children);
                                console.log('children');
                            }
                        }

                        if (src) {
                            img_src = '<img src="http://118.91.160.230' + src + '" alt="" style="height:auto;width:200px;">';

                            // console.log(img_src);
                        } else {
                            img_src = '';
                        }
                        //  popup.show(evt.coordinate, popupContent);

                        $(imgContainer).append(img_src);

                    } else {
                        console.log('no photo');
                    }
                }
            });
            //console.log(img_src);
            //console.log(img(id));
            /*if (img_src){
                return img_src;
            }else{
                console.log('img_src not defined for: ');
                console.log(data);
            }*/
        }

        /**
         * @pamam ids array of report_item id eg. [213,876]
         * @pamam impactsContainer string of selector eg. '#popup-ri-impacts'
         */
        var popupSetImpactDetails = function(ids,impactsContainer){
            $.ajax({
                url:'http://118.91.160.230/girc/dmis/api/rapid_assessment/report-items/impact-summary',
                // url:'http://localhost/girc/dmis/api/rapid_assessment/report-items/impact-summary',
                data:{
                    ids:JSON.stringify(ids)
                },
                success:function(data){
                    console.log('impact summary');
                    console.log(data);
                    console.log('impact summary');

                    if(data.length>0){
                        var popupImpactsContent = '<strong class="text-blue">Impacts</strong><table class="table table-bordered table-striped table-condensed">';
                        popupImpactsContent += '<thead class="text-light-blue"><td class="text-light-blue">Item</td><td class="text-light-blue">Count</td></thead>';
                        $.each(data, function(index, item) {
                            popupImpactsContent += '<tr><td >' + item.attribute_value + '</td><td>' + item.count + '</td></tr>';
                        });
                        popupImpactsContent +='</table>';
                        $(impactsContainer).append(popupImpactsContent);
                    }

                },
                error:function(){
                    console.log('impact summary');
                    console.log('error');
                    console.log('impact summary');
                }
            });
        }

        /**
         * @pamam ids array of report_item id eg. [213,876]
         * @pamam needsContainer string of selector eg. '#popup-ri-needs'
         */
        var popupSetNeedDetails = function(ids,needsContainer){
            $.ajax({
                url:'http://118.91.160.230/girc/dmis/api/rapid_assessment/report-items/need-summary',
                // url:'http://localhost/girc/dmis/api/rapid_assessment/report-items/impact-summary',
                data:{
                    ids:JSON.stringify(ids)
                },
                success:function(data){
                    console.log('need summary');
                    console.log(data);
                    console.log('need summary');



                    if(data.length>0){
                        var popupNeedsContent = '<strong class="text-blue">Needs</strong><table class="table table-bordered table-striped table-condensed">';
                        popupNeedsContent += '<thead ><td class="text-light-blue">Item</td><td class="text-light-blue">Need<br><p class="text-muted">(in person)</p></td><td class="text-light-blue">Supplied<br><p class="text-muted">(in person)</p></td></thead>';
                        $.each(data, function(index, item) {
                            popupNeedsContent += '<tr><td>' + item.attribute_value + '</td><td>' + item.count + '</td><td>'+item.supplied_per_person+'</td></tr>';
                        });
                        popupNeedsContent +='</table>';
                        $(needsContainer).append(popupNeedsContent);
                    }

                },
                error:function(){
                    console.log('need summary');
                    console.log('error');
                    console.log('need summary');
                }
            });
        }

        var highlight;
        var displayFeatureInfo = function(pixel) {

            var feature = map.forEachFeatureAtPixel(pixel, function(feature, layer) {
                return feature;
            });

            var info = document.getElementById('info');
            try {
                var size = feature.get('features').length;
            } catch (e) {}
            //  console.log(size);
            if (feature) {
                coor_feature = feature.values_.geometry.flatCoordinates;
                if (size == 1) {
                    console.log(feature);

                    var incident=feature.values_.features[0];

                    id=(feature.values_.features[0].values_.id)?
                        feature.values_.features[0].values_.id:
                        feature.values_.features[0].id_.split('.')[1];

                    var popup_content_incident = '<strong class="text-orange">Report Details</strong><hr><strong class="text-blue">Incident</strong><table class="table table-bordered table-striped table-condensed">';
                    popup_content_incident += '<thead><td class="text-light-blue">Name</td><td class="text-light-blue">Type</td><td class="text-light-blue">Count</td></thead>';
                    popup_content_incident += '<tr><td>' + incident.values_.item_name + '</td><td>'+incident.values_.class_name+'</td><td>'+incident.values_.magnitude+'</td></tr></table>';

                    popup.show(coor_feature,'<div id="popup-ri-incident"></div><div id="popup-ri-img"></div><div id="popup-ri-impacts"></div><div id="popup-ri-needs"></div>' );

                    $('#popup-ri-incident').append(popup_content_incident);
                    popupSetImpactDetails([id],'#popup-ri-impacts');
                    popupSetNeedDetails([id],'#popup-ri-needs');
                    popupSetImage(id,'#popup-ri-img');

                    // popup.show(coor_feature, '<h4>' + feature.values_.features[0].values_.item_name);
                } else {
                    var items_array_incident = [];
                    var ids=[];
                    $.each(feature.values_.features, function(index, item) {
                        if (item.values_.type == "incident") {
                            items_array_incident.push(item.values_.class_name);
                        } else {
                            console.log('selected layer is not incident');
                        }

                        id=(item.values_.id)?
                            item.values_.id:
                            item.id_.split('.')[1];
                        if(id){
                            ids.push(id);
                        }
                    });

                    console.log(ids);

                    var incidents = unique_count(items_array_incident);
                    var incident_unique = incidents[0];
                    var incident_counts = incidents[1];


                    var popup_content_incidents = '<strong class="text-orange">Report Details</strong><hr><strong class="text-blue">Incidents</strong><table class="table table-striped table-bordered table-condensed">';
                    popup_content_incidents += '<thead><td class="text-light-blue">Name</td><td class="text-light-blue">Type</td><td class="text-light-blue">Count</td></thead>';
                    for (i = 0; i < incidents.length + 1; i++) {
                        if( typeof incident_unique[i]==="undefined"){

                        }
                        else{
                            popup_content_incidents += '<tr><td>' + 'house(s)' + '</td><td>'+incident_unique[i]+'</td><td>' + incident_counts[i]  + '</td></tr>';
                        }
                    }

                    //@todo implement tabbedContent for popup
                    tabbedContent =
                        '<!-- Custom Tabs -->' +
                        '<div class="nav-tabs-custom">' +
                            '<ul class="nav nav-tabs">' +
                                '<li class="pull-left"><p class="text-green">Reports</p></li>' +
                                '<li class="pull-right"><a href="#popup-nav-ri-photo" data-toggle="tab">Photo</a></li>' +
                                '<li class="pull-right"><a href="#popup-nav-ri-details" data-toggle="tab">Details</a></li>' +
                                '<li class="active pull-right"><a href="#popup-nav-ri-incident" data-toggle="tab">Incident</a></li>' +
                            '</ul>' +
                            '<div class="tab-content">' +
                                '<div class="tab-pane active" id="popup-nav-ri-incident">' +
                                    '<blockquote>Incident</blockquote>' +
                                '</div><!-- /.tab-pane -->' +
                                '<div class="tab-pane" id="popup-nav-ri-details">' +
                                    '<blockquote>Details</blockquote>' +
                                '</div><!-- /.tab-pane -->' +
                                '<div class="tab-pane" id="popup-nav-ri-photo">' +
                                    '<blockquote>Photos</blockquote>' +
                                '</div><!-- /.tab-pane -->' +
                            '</div><!-- /.tab-content -->' +
                        '</div><!-- nav-tabs-custom -->';

                    popup.show(coor_feature,'<div id="popup-ri-incidents"></div><div id="popup-ri-impacts"></div><div id="popup-ri-needs"></div>' );


                    $('#popup-ri-incidents').append(popup_content_incidents);
                    popupSetImpactDetails(ids,'#popup-ri-impacts');
                    popupSetNeedDetails(ids,'#popup-ri-needs');

                }
            } else {
                $(".ol-popup").hide();
            }
        };

        map.on('click', function(evt) {
            displayFeatureInfo(evt.pixel);
        });

        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJs($this->blocks['scriptPosReady'], $this::POS_READY); ?>