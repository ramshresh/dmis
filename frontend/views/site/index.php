<?php
/**
 * @var $this yii\web\View;
 */
use common\assets\Ol3Asset;
use common\assets\Ol3LayerSwitcherAsset;
use common\assets\Ol3PopupAsset;

use yii\jui\JuiAsset;
Ol3Asset::register($this);
Ol3LayerSwitcherAsset::register($this);
Ol3PopupAsset::register($this);
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

    <div id="navbar" class="col-lg-12 col-md-12 col-sm-12">
        <div class="col-lg-4 col-md-4 col-sm-12 toolbar-menu">
            <ul class="nav navbar-nav">
                <!--filter by parameters start-->
                <li class="dropdown">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-placement="bottom"><i style="font-size: 22px;color:#04C9A6;" class="icon-line-chart"></i></button>

                    <ul class="dropdown-menu">
                        <form
                            id="report_item_search"
                            role="form" method="get" action="/girc/dmis/rapid_assessment/report-items"
                            class="form-horizontal form-groups-bordered">
                            <div class="form-group" style="margin-top:25px !important;">
                                <div class="col-md-6">
                                    <!--							<select name="test" class="selectboxit" id="search_type">-->
                                    <select name="search_type" class="" id="search_type">
                                        <option value="">Select type</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <!--							<select name="test" class="selectboxit"  id="search_subtype">-->
                                    <select name="search_subtype" class=""  id="search_subtype">
                                        <optgroup label="Sub Type">
                                            <option value="1">Select subtype</option>
                                        </optgroup>
                                    </select>

                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input name="datefilter_from" type="text" class="form-control datepicker" data-format="yyyy-mm-dd" placeholder="From" id="search_start_date">

                                        <div class="input-group-addon">
                                            <a href="#"><i class="entypo-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" name="datefilter_to" class="form-control datepicker" data-format="yyyy-mm-dd" placeholder='To' id="search_end_date">
                                        <div class="input-group-addon">
                                            <a href="#"><i class="entypo-calendar"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--							<select name="test" class="selectboxit">-->
                                    <select id="district_name" name="district_name" class="">
                                        <option value="">Select District</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <!--							<select name="test" class="selectboxit">-->
                                    <select id="vdc_name" name="vdc_name" class="">
                                        <option value="">Select VDC/Municipality</option>
                                    </select>
                                </div>
                                <br>
                                <div class="col-md-6">
                                    <button id="btn_report_item_search" type="button" class="btn-primary col-md-12">Submit</button>
                                </div>
                            </div>
                        </form>
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
<!--                                <div class="clearfix"></div>-->

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

                    <!--<ul class="dropdown-menu">
                        <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">User stats <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">Favourites Snippets <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                    </ul>-->
                </li>
                <li class="dropdown">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-placement="bottom"><i style="font-size: 22px;color:#734286" class="icon-routing"></i></button>

                    <!--<ul class="dropdown-menu">
                        <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">User stats <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">Favourites Snippets <span class="glyphicon glyphicon-heart pull-right"></span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">Sign Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                    </ul>-->
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

        <div class="col-lg-3 col-md-3 col-sm-12 toolbar-menu">
            <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Graph" data-original-title="Graph"><i style="font-size: 22px;color:#E47124;" class="icon-earthquake"></i></button>

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
                  element:  $('<img src="/girc/dmis/img/location.png" style="width:32px;height:auto;">')
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
$this->registerJs($JsAddressSearch, $this::POS_READY);
?>
<!--    <div class="clearfix"></div>-->

    <div id="toolbar">
        <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Geo-Location" data-original-title="Geo Location"><i style="color:#04C9A6;" class="icon-target"></i></button>
    </div>


    <div id="toolbar-left">

        <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="right" title="" data-original-title="Download-Apps"><i style="font-size:100px; color:#f1f1f1;" class="fa fa-android"></i></button>

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

        var ajaxFirstCallUniqueApi = function(url,dom){
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
                 ajaxSecondCall(host+'/girc/dmis/api/rapid_assessment/report-items/unique/'+first_search_value+'?_format=json','search_subtype');
            });

        //ajaxFirstCallUniqueApi(host+'/girc/dmis/api/vdc/nepal-vdcs/unique/dname?_format=json&count=false','district_name');
        ajaxSecondCall(host+'/girc/dmis/api/vdc/nepal-vdcs/unique/dname?_format=json','district_name');

        $("#district_name").change ( function () {
                         first_search_value = $(this).val();
                         $("#vdc_name").html('');
                         //ajaxSecondCall('http://116.90.239.21/girc/dmis/api/rapid_assessment/report-items/unique/'+first_search_value+'?_format=json','second_search');
                         console.log(first_search_value);
                         ajaxSecondCall(host+'/girc/dmis/api/vdc/nepal-vdcs/unique/aan?_format=json'+'&dname='+first_search_value,'vdc_name');
                    });

                    $('#btn_report_item_search').click(function(){
                        alert('clicked');
                        var data=$("#report_item_search").serialize();
                        console.log(data);
                    });

        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJs($this->blocks['scriptPosReady'], $this::POS_READY); ?>