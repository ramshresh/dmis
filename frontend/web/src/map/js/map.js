/**
 * Created by User on 5/7/2015.
 */
/* Defining basic Map with OSM as basemap*/
$(document).ready(function() {
    /*******************Overlay Group*****************/
    var http = location.protocol;
    //var hostName=window.location.hostname;
    var hostName='116.90.239.21';

    var host = http.concat("//").concat(hostName);
    var geoserverPort = 8080;
    var geoserverHost = host.concat(':').concat(geoserverPort);
    console.log(geoserverHost);

    var overlayGroup = new ol.layer.Group({
        title: 'Overlays',
        layers: []
    });
    /*
     * earthquake clustering start
     * */
    var vectorSource = new ol.source.ServerVector({
        format: new ol.format.GeoJSON({
            //    projection: 'EPSG:3857'
        }),
        //   'crossOrigin':'anonymous',
        loader: function(extent, resolution, projection) {
            //    var url='http://localhost:8080/geoserver/fra/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=fra%3Aambulance&srsname=EPSG:3857&maxFeatures=50&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');
            var url=geoserverHost+'/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis:report_item&srsname=EPSG:3857&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');
            console.log(url);
            //   var url = 'http://localhost:8080/geoserver/disaster/ows?service=WFS&version=1.0.0&request=GetFeature&layer=disaster:hazard0&outputformat=text/javascript&srsname=EPSG:4326';
            $.ajax({
                url: url,
                dataType: 'jsonp',
                success:function(data) {
                    console.log(data);
                },
                error:function(data) {
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
    console.log(vectorSource);
    var styleCache = {};
    var vector = new ol.layer.Vector({

        source: new ol.source.Cluster({
            distance: 40,
            source:vectorSource
        }),
        //style: styleFunction
        style:function(feature, resolution) {
            var size = feature.get('features').length;
            //console.log(feature);
            //  var style = styleCache[size];
            var stroke = new ol.style.Stroke({color: 'black', width: 2});
            var fill = new ol.style.Fill({color: 'red'});
            // if (!style) {
            var src_icon = function(){
                $.each(feature.values_.features,function(index, value){
                    if (value.values_.type=="impact"){
                        src = "png/impact.png";
                    }
                    else if (value.values_.type=="incident"){
                        src = "png/incident.png";
                    }
                    else{
                        src="png/need.png";
                    }
                })
                return src;
            }
            //  src_icon();
            if (size===1) {

                style = [new ol.style.Style({
                    image: new ol.style.Icon(({
                        src: 'png/need.png',
                        //  src: src_icon(),
                        offset: [1,1]
                    }))
                })]
            } else{
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
    console.log(vector);
    window.vector = vector;
    var loadFeatures = function (response) {
        vectorSource.addFeatures(vectorSource.readFeatures(response));
    };
    window.loadFeatures = loadFeatures;
    overlayGroup.getLayers().push(vector);

    /*end*/
    var view = new ol.View({

        center: ol.proj.transform([87, 29], 'EPSG:4326', 'EPSG:3857'),
        zoom: 2
    });
    var osm = new ol.layer.Tile({
        title:'OSM',
        type:'base',
        source: new ol.source.OSM()
    });

    /*******************ol3 map object*****************/
    map = new ol.Map({
        target: 'map',
        renderer : 'canvas',
        layers: [
            new ol.layer.Group({
                'title': 'Base',
                layers: [osm ]
            }),
            overlayGroup
        ],
        controls:  ol.control.defaults({
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

    var highlightStyleCache = {};

    var featureOverlay = new ol.FeatureOverlay({
        map: map,
        style: function(feature, resolution) {
            console.log(feature);
            //console.log(resolution);
            // var text = resolution < 5000 ? feature.get('name') : '';
            var size = feature.get('features').length;
            if(size==1){
                var text = resolution < 5000 ? (feature.values_.features[0].values_.item_name) : '';
            }
            else{
                text='';
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
                            color: '#f00',
                            width: 3
                        })
                    })
                })];
            }
            return highlightStyleCache[text];
        }
    });

    var highlight;
});