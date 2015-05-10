<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/10/2015
 * Time: 4:40 AM
 *
 * @var $this yii\web\View
 * @var $model \common\modules\rapid_assessment\models\ReportItem
 */
use common\assets\Ol3Asset;
use common\assets\Ol3LayerSwitcherAsset;
use common\assets\Ol3PopupAsset;

Ol3Asset::register($this);
Ol3LayerSwitcherAsset::register($this);
Ol3PopupAsset::register($this);

?>
<style>
    body, html {
        height: 100%;
    }
    .map-form {
        top: 5px;
        border: solid;
        height: 80%;
    }
    .sidebar-left{
        top: 5px;
        border: solid;
        height: 80%;
        background-color: #FFFFFF;
    }
</style>

<div>
    <div id="map" class="col-md-8 map map-form"></div>
    <div class="col-md-4 sidebar sidebar-left">
        <?= $this->render('_form',['model'=>$model])?>
    </div>
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