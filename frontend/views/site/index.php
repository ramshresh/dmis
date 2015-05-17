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
        /*
         * earthquake impact clustering start
         * */
        var vectorSource = new ol.source.ServerVector({
            format: new ol.format.GeoJSON({
                //    projection: 'EPSG:3857'
            }),
            //   'crossOrigin':'anonymous',
            loader: function (extent, resolution, projection) {
                var url = 'http://118.91.160.230:8080/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis:report_item&srsname=EPSG:3857&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');
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
                var stroke = new ol.style.Stroke({color: 'black', width: 2});
                var fill = new ol.style.Fill({color: 'red'});
                if (size === 1) {
                    style = [new ol.style.Style({
                        image: new ol.style.Icon(({
                            src: 'http://vignette2.wikia.nocookie.net/fallout/images/7/73/Icon_damage.png/revision/latest?cb=20091010164957',
                            //  src: src_icon(),
                            offset: [1, 1],
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
        baseGroup.getLayers().push(imagery);


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
        var image = function (id,div) {
            $.ajax({
                url: '/girc/dmis/api/rapid_assessment/report-items',
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
                        img_src = '<img src="' + src + '" alt="" style="height:auto;width:200px;">';

                        document.getElementById(div).innerHTML=img_src;
                        console.log(img_src);
                        return img_src;
                    }
                }
            });

        }
        var highlight;
        var ids_array;
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
                    var id;
                    if(feature.values_.features[0].id){
                        id = feature.values_.features[0].id;
                    }else if(feature.values_.features[0].id_){
                        id = feature.values_.features[0].id_.split('.')[1];
                    }

                    console.log("id");
                    console.log(id);
                    console.log("id");

                    var imgDiv='popup_img';
                    //	info.innerHTML = feature.getId() + ': ' + feature.get('name');
                    popup.show(coor_feature, '<h4>' + feature.values_.features[0].values_.item_name + '</h4>Human Casulty : ' + feature.values_.features[0].values_.magnitude + image(id,imgDiv));
                }
                else {

                    var text = '';
                    var text_array = [];
                    var ids_array = [];
                    var user_id_array=[]
                    $.each(feature.values_.features, function (index, value) {
                        ids_array.push(value.id_);
                        user_id_array.push(value.values_.user_id);
                        text_array.push(value.values_.item_name);
                    });


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
                        });
                        popup_content+='<hr> <a id = "popupimages" >view images</a>';


                        popup.show(coor_feature, popup_content);

                        $('a#popupimages').click(function(evet){

                            showPopupImages(ids_array);
                        });

                    } else {
                        alert('error arrays not equal');
                    }

                }
            } else {
            }

        };

        function showPopupImages(ids){
            console.log(ids)
        }


        map.on('click', function (evt) {

            displayFeatureInfo(evt.pixel);
        });

        <?php $this->endBlock(); ?>
    </script>
<?php //$this->registerJs($this->blocks['scriptPosReady'], $this::POS_READY); ?>