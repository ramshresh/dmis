<?php
/* @var $this yii\web\View */


use common\assets\PlaceAutocompleteAsset;

$this->title = 'My Yii Application';

?>

<?php \common\assets\Ol3Asset::register($this); ?>
<?php \common\assets\Ol3LayerSwitcherAsset::register($this); ?>
<?php \common\assets\IconsReportingAsset::register($this); ?>
<?php PlaceAutocompleteAsset::register($this);?>

<?php
$css = <<<CSS
        .carousel-inner .active.left {
            left: -33%;
        }
        .carousel-inner .next {
            left: 33%;
        }
        .carousel-inner .prev {
            left: -33%;
        }
        .carousel-control.left,
        .carousel-control.right {
            background-image: none;
        }
        .carousel-caption {
            top: 0;
            bottom: auto;
        }


        hr{
            border-width: 1px 0 0;
            margin-bottom: 5px;
            margin-top: 5px;
        }

        .ol-full-screen {
            right: 0.5em;
            top: 3.2em;
        }

        .ol-zoom {
            position:absolute;
            left: auto;
            right: 0.5em;
            top: 6em;
        }



        .ol-control button {
            background-color: rgba(57, 52, 86, 0.8);

        }
        /*  #navbar >* {
              background-color: rgba(57, 52, 86, 0.8);
              width:auto;

          }*/




        /* pullout css */
        div.pullout-right-footer-btn {
            position: fixed;
            bottom: 3px;
            right: 0;
            background: rgba(57, 52, 86, 0.8);
            border-radius: 5px 0px 0px 5px;
            padding: 10px 15px;
            font-size: 16px;
            z-index: 99999;
            cursor: pointer;
            color: #ddd;
        }
        div.pullout-right-footer {
            background: none repeat scroll 0 0 rgba(57, 52, 86, 0.8);
            bottom: 3px;
            height: 167px;
            position: fixed;
            right: -100%;
            width: 100%;
            z-index: 1000
        }
        /* tags and other css */
        img {
            display: inline-block;
            height: auto;
            max-width: 100%;
        }
        html,
        body,
        #map {
            margin-top: 0;
            width: 100%;
            height: 100%;
        }

        /*for z-index of a dialog box */
        .ui-dialog{
            display: block;
            z-index: 1000;
        }

        .ui-widget-header {
            background: none repeat scroll 0 0 rgba(57, 52, 86, 0.8);
            border: 1px solid #e78f08;
            color: #fff;
            font-weight: bold;
        }

        .ui-dialog .ui-dialog-titlebar {
            padding: 0.2em 1em;
            position: relative;
        }

        .toolbar
        {
            background: none repeat scroll 0 0 rgba(57, 52, 86, 0.8);
            border-color: #d8d8d8;/* -moz-use-text-color #d8d8d8 #d8d8d8;*/
            border-image: none;
            border-radius: 3px;
            border-style: solid none solid solid;
            border-width: 1px medium 1px 1px;
            padding: 5px;
            position: absolute;
            right: 0.5em;
            top: 11.2em;
            width: 25px;
            z-index: 999;
        }


        hr{
            border-width: 1px 0 0;
            margin-bottom: 5px;
            margin-top: 5px;
        }

        .ol-full-screen {
            right: 0.5em;
            top: 0.5em;
        }

        .ol-zoom {
            position:absolute;
            right:auto;
            left: 0.5em;
            top: 0.5em;
        }

        .ol-control button {
            background-color: rgba(57, 52, 86, 0.8);
            font-size: 2em;
            /*padding:0em;*/

        }
        /*   *:before, *:after {
               box-sizing: border-box;
           }*/

        .ol-attribution, .ol-control button, .ol-has-tooltip [role="tooltip"], .ol-scale-line-inner {
            top: 2em;
        }

CSS;
$this->registerCss($css);
?>
<?php
/*echo  \common\modules\reporting\widgets\event\Create::widget([
    'jqToggleBtnSelector'=>'#report',
    'widgetId'=>'event-form-widget',
    'formId'=>'event-form',
]);*/
?>
<!-- {{{ Implement Pjax -->
<!--<div id="formsection">
</div>
<?php /*\yii\widgets\Pjax::begin(); */ ?>
    <?php
/*    echo \yii\helpers\Html::a(
        'get event-report-create-widget',
        [ '','widget_name'=>'event-report-create'],
        ['data-pjax'=> '#formsection']);
    */ ?>

--><?php /*\yii\widgets\Pjax::end(); */ ?>
<!-- }}} ./Implement Pjax -->


<div id="navbar" class="ol-unselectable ol-control" style='display:inline-flex;top:0.5em;left:20%; z-index:9999999999;'>
    <button id="report_emergency_situation" class="ol-has-tooltip" type="button">
        <span role="tooltip">Report Emergency Situation</span><i style="font-size: 22px;" class="icon-reporting"></i>
    </button>
    <button id="report_event" class="ol-has-tooltip" type="button">
        <span role="tooltip">Report Event</span><i style="font-size: 22px;" class="icon-reporting"></i>
    </button>
    <button id="report_damage" class="ol-has-tooltip" type="button">
        <span role="tooltip">ReportDamage</span><i style="font-size: 22px;" class="icon-reporting"></i>
    </button>
    <button id="report_need" class="ol-has-tooltip" type="button">
        <span role="tooltip">Report Need </span><i style="font-size: 22px;" class="icon-reporting"></i>
    </button>
    <button id="directions" class="ol-has-tooltip" type="button">
        <span role="tooltip">Directions</span><i style="font-size: 22px;" class="icon-routing"></i>
    </button>

    <button id="geofence" class="ol-has-tooltip" type="button">
        <span role="tooltip">Geofence</span><i style="font-size: 22px;" class="icon-geofence"></i>
    </button>

    <button id="resources" class="ol-has-tooltip" type="button">
        <span role="tooltip">Resources</span><i style="font-size: 22px;" class="icon-resource"></i>
    </button>

    <button id="updates" class="ol-has-tooltip" type="button">
        <span role="tooltip">Updates</span><i style="font-size: 22px;" class="icon-update"></i>
    </button>

    <style>
        .ui-autocomplete {
            max-height: 150px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            /* add padding to account for vertical scrollbar */
            padding-right: 20px;
        }
        /* IE 6 doesn't support max-height
         * we use height instead, but this forces the menu to always be this tall
         */
        * html .ui-autocomplete {
            height: 100px;
        }
        .loadinggif {
            background:url('http://www.hsi.com.hk/HSI-Net/pages/images/en/share/ajax-loader.gif') no-repeat right center;
        }
        .ui-autocomplete li.odd{
            background-color: rgba(200,200,200,0.4);
        },
        .ui-autocomplete li.even{
            background-color: rgba(250,250,250,0.4);
        }
    </style>

        <input id="input-search" type="text" placeholder="Search Address" style="background-color: #fff;border-top: 1px solid #d9d9d9;">
</div>


<style>
    .ol-toolbar .ol-has-tooltip:focus [role=tooltip],
    .ol-toolbar .ol-has-tooltip:hover [role=tooltip] {
        top: 1.1em
    }
</style>

<div id="toolbar" class="ol-toolbar ol-unselectable ol-control" style="top:6.5em;left:0.5em; z-index:9999999999;">

    <button id="hospital" class="ol-toolbar-hospital ol-has-tooltip" type="button">
        <span role="tooltip">Hospital</span>
        <i style="font-size: 25px;" class="icon-hospital"></i>
    </button>

    <button id="police_station" class="ol-has-tooltip" type="button">
        <span role="tooltip">Police Station</span><i style="font-size: 25px;" class="icon-policestation"></i>
    </button>

    <button id="openspace" class="ol-has-tooltip" type="button">
        <span role="tooltip">Open Space</span><i style="font-size: 25px;" class="icon-openspace"></i>
    </button>

    <button id="camp" class="ol-has-tooltip" type="button">
        <span role="tooltip">Camp</span><i style="font-size: 25px;" class="icon-shelter"></i>
    </button>

</div>


<div id="socialmedia" class="ol-unselectable ol-control" style="top:18.2em;left:0.5em; z-index:9999999999">

    <button id="social_facebook" class="ol-has-tooltip" type="button">
        <span role="tooltip">Facebook</span><i style="font-size: 22px;" class="icon-facebook"></i>
    </button>

    <button id="social_twitter" class="ol-has-tooltip" type="button">
        <span role="tooltip">Twitter</span><i style="font-size: 22px;" class="icon-twitter"></i>
    </button>
</div>


<div id="map" data-map></div>
<div id="dialog">
    <div class="dropdown">

        <select id="all_options" class="btn btn-default dropdown-toggle">
            <option selected="true" style="display:none;">Search By</option>
            <option value="ambulance">Ambulance no</option>
            <option value="driver">Driver name</option>
        </select>

        <select id="drivers" class="btn btn-default dropdown-toggle">
            <option selected="true" style="display:none;">Select Driver</option>
        </select>
        <select id="ambulance_no" class="btn btn-default dropdown-toggle">
            <option selected="true" style="display:none;">Select Ambulance No</option>
        </select>

        <button class="btn btn-primary" id="search">Search</button>
        <button id="trigger" style="display:none;">search box</button>
    </div>
</div>

<!-- Start Image gallery on bottom -->
<div class="pullout-right-footer" style="padding-top:10px; padding-bottom:10px; height:auto;">
    <div class="col-xs-12">
        <div class="carousel slide" id="myCarousel">

            <!-- Start Imager gallery photos -->
            <div class="carousel-inner">
                <div class="item active">
                    <div class="col-xs-3">
                        <a href="#">
                            <img src="/girc/dmis/common/uploads/photos/disaster3.jpg" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-3">
                        <a href="#">
                            <img src="/girc/dmis/common/uploads/photos/disaster2.jpg" class="img-responsive">

                            <div class="carousel-caption">
                                <p>Image 1 Description</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-3">
                        <a href="#">
                            <img src="/girc/dmis/common/uploads/photos/disaster1.jpg" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-3">
                        <a href="#">
                            <img src="/girc/dmis/common/uploads/photos/disaster2.jpg" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-3">
                        <a href="#">
                            <img src="/girc/dmis/common/uploads/photos/disaster3.jpg" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-3">
                        <a href="#">
                            <img src="/girc/dmis/common/uploads/photos/disaster4.jpg" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-3">
                        <a href="#">
                            <img src="/girc/dmis/common/uploads/photos/disaster5.jpg" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-3">
                        <a href="#">
                            <img src="/girc/dmis/common/uploads/photos/disaster6.jpg" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="item">
                    <div class="col-xs-3">
                        <a href="#">
                            <img src="/girc/dmis/common/uploads/photos/disaster7.jpg" class="img-responsive">
                        </a>
                    </div>
                </div>
            </div>
            <!--End Imager gallery photos-->

            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="icon-prev"></i></a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="icon-next"></i></a>
        </div>
    </div>
    <!--Pull up and down icon-->
    <div class="pullout-right-footer-btn"><i class='icon-facebook'></i>
    </div>
</div>


<?php
$jsMap = <<<JS

    var osm = new ol.layer.Tile({
        title:'OSM',
        type:'base',
        source: new ol.source.OSM()
    });

    var tilewmsSource = new ol.source.TileWMS(
        ({
            //   url: 'http://localhost:8080/geoserver/wms',
            url: 'http://116.90.239.21:8080/geoserver/wms',
            params: {'LAYERS': 'dmis:reportitems_all', 'TILED': true
                //   params: {'LAYERS': 'fra:ambulance', 'TILED': true
                //'cql_filter':"subcategory='trapped'"
                //        'STYLES':'disaster_hazard'
                //    'SLD' :'styles/all_feature_style.sld'

            },
            //styles:"",
            serverType: 'geoserver'
            //   request:'GetMap'

        }));

    var tile_wms =
        new ol.layer.Tile({
            title:'tile wms',
            name: 'tiled layer',
            type:'overlay',
            source: tilewmsSource
        });

    var fra_ambulance = new ol.layer.Tile({
        title:'ambulance',
        name : 'ambulance',
        type : 'overlay',
        source : new ol.source.TileWMS(
            ({  url: 'http://localhost:8080/geoserver/wms',
                params: {'LAYERS': 'fra:ambulance', 'TILED': true}
            }))
    });

    var vectorSource = new ol.source.ServerVector({
        format: new ol.format.GeoJSON({
            //    projection: 'EPSG:3857'
        }),
        loader: function(extent, resolution, projection) {
            //    var url='http://localhost:8080/geoserver/fra/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=fra%3Aambulance&srsname=EPSG:3857&maxFeatures=50&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');
            var url='http://localhost:8080/geoserver/disaster/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=disaster%3Ahazard0,disaster:kbl0&srsname=EPSG:3857&maxFeatures=50&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');
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


    var defaultStyle=new ol.style.Style({
        image: new ol.style.Circle({
            radius: 3,
//                fill: new ol.style.Fill({color: '#AA0000'}),
            stroke: new ol.style.Stroke({color: 'red', width: 1})
        })
    })
    var testdata_geopnt = new ol.layer.Vector({

        type:'overlay',
        name:'vectorLayer',
        title:'vectorLayer',
        source: vectorSource
        // style: defaultStyle
    });
    window.testdata_geopnt = testdata_geopnt;

    //var clusterSource = new ol.source.Cluster({
    //    distance: 40,
    //    source: vectorSource
    //});
    var loadFeatures = function (response) {
        vectorSource.addFeatures(vectorSource.readFeatures(response));
    };
    window.loadFeatures = loadFeatures;

    var overlayGroup = new ol.layer.Group({
        title: 'Overlays',
        layers: [testdata_geopnt
        ]
    });

    var view = new ol.View({
        //    projection:'EPSG:3857',
        zoom: 3,
        center: ol.proj.transform([85,27], 'EPSG:4326', 'EPSG:3857')
    });

    //function init() {
    var init=function() {


        // Create a map
        map = new ol.Map({
            target: 'map',
//                    layers: [
//                        raster,
//                        //new ol.layer.Tile({
//                        //  source: new ol.source.OSM()
//                        // }),
//                        vector_layer
//                    ],

            layers: [
                new ol.layer.Group({
                    'title': 'Base maps',
                    layers: [osm ]
                }),
                overlayGroup
            ],
            view: view,
            controls:// ol.control.defaults().extend(
                [
                    //  new ol.control.ScaleLine({className: 'ol-scale-line', target: document.getElementById('scale-line')}),
                    new ol.control.FullScreen(),
                    new ol.control.LayerSwitcher(),
                    new ol.control.Zoom({element:document.getElementById('info')})
                ]
            //)
        });

        overlayGroup.getLayers().push(tile_wms);
        overlayGroup.getLayers().push(fra_ambulance);
        $('#map').data('map',map);
    }
    init();
JS;
$this->registerJs($jsMap, $this::POS_READY);
?>

<?php
$js1 = <<<JS
    /*------Dialog box ----*/
   /* $('#report').click(function() {
        //   $('#dialog').dialog('open');

        var elem = $("#dialog");
        elem.dialog({
            modal: false,
            resizable: false,
            title: 'Resource Locator',
            width:'auto',
            height:'auto'
        }); // end dialog
        elem.dialog('open');

    });*/
    /*------Carousel----*/
    $('#myCarousel').carousel({
        interval: 10000
    });
    $('.carousel .item').each(function() {
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i = 0; i < 2; i++) {
            next = next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }
    });

JS;
$this->registerJs($js1, $this::POS_READY);
$js2 = <<<JS
var pullout_right_footer = $('div.pullout-right-footer');
    var pullout_right_footer_btn = $('div.pullout-right-footer-btn');
    pullout_right_footer_btn.click(function() {
        if (!$(this).hasClass("open")) {
            $(this).css("bottom", "200px");
            pullout_right_footer.css("right", "0");
            $(this).addClass("open");
        } else {
            $(this).css("bottom", "0");
            pullout_right_footer.css("right", "-100%");
            $(this).removeClass("open")
        }
    });
JS;
$this->registerJs($js2, $this::POS_READY);
?>
<?php
echo \common\modules\reporting\widgets\emergency_situation\Create::widget([
    'jqToggleBtnSelector' => '#report_emergency_situation',
    'widgetId' => 'emergency-situation-form-widget',
    'formId' => 'emergency-situation-form',
    'actionRoute' => 'site/emergency-situation-create'
]);
?>
<?php
echo \common\modules\reporting\widgets\event\Create::widget([
    'jqToggleBtnSelector' => '#report_event',
    'widgetId' => 'event-form-widget',
    'formId' => 'event-form',
    'actionRoute' => 'site/event-create'
]);
?>

<?php
echo \common\modules\reporting\widgets\damage\Create::widget([
    'jqToggleBtnSelector' => '#report_damage',
    'widgetId' => 'damage-form-widget',
    'formId' => 'damage-form',
    'actionRoute' => 'site/damage-create'
]);
?>

<?php
echo \common\modules\reporting\widgets\need\Create::widget([
    'jqToggleBtnSelector' => '#report_need',
    'widgetId' => 'need-form-widget',
    'formId' => 'need-form',
    'actionRoute' => 'site/need-create'
]);
?>

<?php
$JsAddressSearch = <<<JS
  $("#input-search").placeAutocomplete({});

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
                  element:  $('<img src="http://localhost/girc/dmis/img/location.png" style="width:32px;height:auto;">')
                                 .css({marginTop: '-200%', marginLeft: '-50%', cursor: 'pointer'})
                                .popover({
                                  'placement': 'top',
                                  'html': true,
                                  'content':'<strong>'+ui.item.label+'</strong>'
                                })
                                .on('click', function (e) { $(".location-popover").not(this).popover('hide'); })
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
