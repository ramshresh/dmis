<?php
/* @var $this yii\web\View */


use common\assets\Ol3PopupAsset;
use common\assets\PlaceAutocompleteAsset;
use common\modules\rapid_assessment\models\ReportItem;
use frontend\widgets\social_media_gallery\SocialMediaGalleryWidget;
use kartik\widgets\Select2;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\JsExpression;

$this->title = 'My Yii Application';
?>

<?php \common\assets\Ol3Asset::register($this); ?>
<?php \common\assets\Ol3LayerSwitcherAsset::register($this); ?>
<?php \common\assets\IconsReportingAsset::register($this); ?>
<?php PlaceAutocompleteAsset::register($this); ?>
<?php Ol3PopupAsset::register($this); ?>

<?php
$css = <<<CSS
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
            position: absolute;
            border-radius: 0.1em;
            bottom: 3px;
            right: 0.5em;
            background: rgba(57, 52, 86, 0.8);
            padding: 1em 0.2em 0.5em 0.5em;
            font-size: 14px;
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
            z-index: 2147483647;
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
    <div class="dropdown">
        <button id="report" class="ol-has-tooltip dropdown-toggle " aria-expanded="false" data-toggle="dropdown"
                type="button">
            <i style="font-size: 22px;" class="icon-reporting"></i>
        </button>
        <ul class="dropdown-menu" role="menu" style="">
            <li>Reporting Module</li>
            <li id="report_emergency_situation">
                <icon class="icon-need"></icon>
                Emergency Situation
            </li>
            <li id="report_event">
                <icon class="icon-need"></icon>
                Event
            </li>
            <li id="report_incident">
                <icon class="icon-need"></icon>
                Incident
            </li>
            <li id="report_damage">
                <icon class="icon-need"></icon>
                Damage
            </li>
            <li id="report_need">
                <icon class="icon-need"></icon>
                Need
            </li>
        </ul>
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
        echo \common\modules\reporting\widgets\incident\Create::widget([
            'jqToggleBtnSelector' => '#report_incident',
            'widgetId' => 'incident-form-widget',
            'formId' => 'incident-form',
            'actionRoute' => 'site/incident-create'
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
    </div>
    <div class="dropdown">
        <button id="report" class="ol-has-tooltip dropdown-toggle " aria-expanded="false" data-toggle="dropdown"
                type="button">
            <i style="font-size: 22px;" class="icon-reporting"></i>
        </button>
        <ul class="dropdown-menu" role="menu" style="">
            <li>Rapid Assessment Module</li>
            <li id="rapid_assessment_es">
                <icon class="icon-need"></icon>
                Emergency Situation
            </li>
            <li id="rapid_assessment_ev">
                <icon class="icon-need"></icon>
                Event
            </li>
            <li id="rapid_assessment_in">
                <icon class="icon-need"></icon>
                Incident
            </li>
            <li id="rapid_assessment_im">
                <icon class="icon-need"></icon>
                Damage
            </li>
            <li id="rapid_assessment_nd">
                <icon class="icon-need"></icon>
                Need
            </li>
        </ul>
        <?php
        echo \common\modules\rapid_assessment\widgets\report_item\Create::widget([
            'jqToggleBtnSelector' => '#rapid_assessment_es',
            //'widgetId' => 'ebbvent-form-widget',
            //'formId' => 'evehnt-form',
            'actionRoute' => 'site/report-item-create',
            'reportItemType' => ReportItem::TYPE_EMERGENCY_SITUATION,
        ]);
        ?>
        <?php
        echo \common\modules\rapid_assessment\widgets\report_item\Create::widget([
            'jqToggleBtnSelector' => '#rapid_assessment_ev',
            // 'widgetId' => 'ebbvent-form-widget',
            // 'formId' => 'evehnt-form',
            'actionRoute' => 'site/report-item-create',
            'reportItemType' => ReportItem::TYPE_EVENT,
        ]);
        ?>
        <?php
        echo \common\modules\rapid_assessment\widgets\report_item\Create::widget([
            'jqToggleBtnSelector' => '#rapid_assessment_in',
            //'widgetId' => 'ebbvent-form-widget',
            //'formId' => 'evehnt-form',
            'actionRoute' => 'site/report-item-create',
            'reportItemType' => ReportItem::TYPE_INCIDENT,
        ]);
        ?>
        <?php
        echo \common\modules\rapid_assessment\widgets\report_item\Create::widget([
            'jqToggleBtnSelector' => '#rapid_assessment_im',
            // 'widgetId' => 'ebbvent-form-widget',
            // 'formId' => 'evehnt-form',
            'actionRoute' => 'site/report-item-create',
            'reportItemType' => ReportItem::TYPE_IMPACT,
        ]);
        ?>
        <?php
        echo \common\modules\rapid_assessment\widgets\report_item\Create::widget([
            'jqToggleBtnSelector' => '#rapid_assessment_nd',
            // 'widgetId' => 'ebbvent-form-widget',
            // 'formId' => 'evehnt-form',
            'actionRoute' => 'site/report-item-create',
            'reportItemType' => ReportItem::TYPE_NEED,
        ]);
        ?>
    </div>
    <div class="dropdown">
        <button id="tracking" class="ol-has-tooltip dropdown-toggle " aria-expanded="false"
                data-toggle="dropdown"
                type="button">
            <i style="font-size: 22px;" class="icon-resource"></i>
        </button>
        <ul class="dropdown-menu" role="menu" style="">
            <li id="search_ambulance">
                <icon class="icon-need"></icon>
                Search Ambulance
            </li>
            <?php if (!Yii::$app->user->isGuest): ?>
                <li id="register_driver">
                    <icon class="icon-need"></icon>
                    Driver Registration
                </li>
                <?php
                echo common\modules\tracking\widgets\driver\Registration::widget([
                    'jqToggleBtnSelector' => '#register_driver',
                    'widgetId' => 'register-driver-form-widget',
                    'formId' => 'driver-form',
                    'actionRoute' => 'site/register-driver'
                ]);
                ?>
            <?php endif; ?>
        </ul>
    </div>

    <button id="directions" class="ol-has-tooltip" type="button">
        <i style="font-size: 22px;" class="icon-routing"></i>
    </button>

    <button id="geofence" class="ol-has-tooltip" type="button">
        <i style="font-size: 22px;" class="icon-geofence"></i>
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
            background: url('http://www.hsi.com.hk/HSI-Net/pages/images/en/share/ajax-loader.gif') no-repeat right center;
        }

        .ui-autocomplete li.odd {
            background-color: rgba(200, 200, 200, 0.4);
        }

        ,
        .ui-autocomplete li.even {
            background-color: rgba(250, 250, 250, 0.4);
        }
    </style>

    <input id="input-search" type="text" placeholder="Search Address"
           style="background-color: #fff;border-top: 1px solid #d9d9d9;">


    <div class="dropdown">
        <button id="user-menu" class="ol-has-tooltip dropdown-toggle " aria-expanded="false" data-toggle="dropdown"
                type="button">
            <i style="font-size: 22px;" class="icon-user"></i>
        </button>
        <ul class="dropdown-menu" role="menu" style="">
            <?php if (Yii::$app->getUser()->getIsGuest()): ?>

                <li id="login">
                    <a href="<?= Url::toRoute(['/user/login']) ?>">
                        <icon class="icon-need"></icon>
                        Login</a>
                </li>
            <?php else: ?>
                <li><?= Yii::$app->getUser()->getId(); ?></li>
                <li id="logout">
                    <a href="<?= Url::toRoute(['/user/logout']) ?>">
                        <icon class="icon-need"></icon>
                        Logout</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>


<div id="toolbar" class="ol-unselectable ol-control" style="top:6.5em;left:0.5em; z-index:9999999999;">

    <button id="hospital" class="ol-has-tooltip" type="button">
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

<div id="analytics" class="ol-unselectable ol-control" style="top:24.4em;left:0.5em; z-index:9999999999">

    <button id="" class="ol-has-tooltip" type="button">
        <span role="tooltip">Analytics</span>A
    </button>


</div>


<div id="map" data-map></div>


<div class="pullout-right-footer" style="padding-top:10px; padding-bottom:15px; height:15.5em;">
    <div><?php echo SocialMediaGalleryWidget::widget() ?></div>
    <div id="images"></div>

</div>

<!--Pull up and down icon-->
<div class="pullout-right-footer-btn"><i class='icon-file-image-o'></i>
</div></div>

<div id="twitter_box"></div>
<div id="facebook_box"></div>
<div id="resources_box" style="display:none;width:auto;"></div>
<div id="geometryPicker_box" style="display:none;width:auto;"></div>
<div id="fbalbum_box" style="display:none;width:auto;"></div>
<?php
// The controller action that will return
$url = '/girc/dmis/api/web/report-items/describe-feature-type';
// Script to initialize the selection based on the value of the select2 element
$initScript = <<< SCRIPT
function (element, callback) {
var type=\$(element).val();
alert('hello');
if (type !== "") {
\$.ajax("{$url}?type=" + type, {
dataType: "json"
}).done(
function(data) {
callback(data.results);
});
}
}
SCRIPT;
// The widget
echo Select2::widget([
    'name' => 'layer-property',
    'size' => Select2::SMALL,
    'options' => ['placeholder' => 'Search for a city ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 1,
        'ajax' => [
            'url' => $url,
            'dataType' => 'json',
            'data' => new JsExpression('function(type,page) { return {type:type}; }'),
            'results' => new JsExpression('function(data,page) {results=[]; for(i=0;i<data.length;i++){result={}; result.id=data[i];result.name=data[i];results.push(result);}console.log("*********");console.log(results);console.log("*********");return {results:results};}'),
        ],
        'initSelection' => new JsExpression($initScript)
    ],
]);
?>
<?php
$jsMap = <<<JS
/* Defining basic Map with OSM as basemap*/

var view = new ol.View({

    center: ol.proj.transform([87, 29], 'EPSG:4326', 'EPSG:3857'),
    zoom: 3
});
var osm = new ol.layer.Tile({
        title:'OSM',
        type:'base',
        source: new ol.source.OSM()
    });
    map = new ol.Map({
        target: 'map',
        layers: [
           osm
        ],
        view: view
    });

    map.addControl(new ol.control.FullScreen());
    map.addControl(new ol.control.LayerSwitcher());
     var popup = new ol.Overlay.Popup();
     map.addOverlay(popup);

/* ./Defining basic Map */

//{{{ Defining Overlay Layers
//{{{ reportitems
var reportitems_all = new ol.layer.Tile(
    {
        'name': 'Report Items',
        'source': new ol.source.TileWMS(
            ({
                //   url: 'http://116.90.239.21:8080/geoserver/wms',
                url: 'http://116.90.239.21:8080/geoserver/wms',
                params: {
                    'LAYERS': 'dmis:reportitems_all', 'TILED': true
                    //   params: {'LAYERS': 'fra:ambulance', 'TILED': true
                    //'cql_filter':"subcategory='trapped'"
                    //        'STYLES':'disaster_hazard'
                    //    'SLD' :'styles/all_feature_style.sld'

                },
                //styles:"",
                serverType: 'geoserver'
                //   request:'GetMap'

            }))
    }
);
var reportitems_all_clickHandler = function (evt) {
    tilewmsSource = reportitems_all;
    viewResolution = view.getResolution();
    viewProjection = view.getProjection();
    //  console.log(evt.coordinate);
    var url = tilewmsSource.getSource().getGetFeatureInfoUrl(
        evt.coordinate, viewResolution, viewProjection,
        {
            'INFO_FORMAT': 'text/javascript'
            //   'propertyName': 'status',''
        });

    if (url) {
        var parser = new ol.format.GeoJSON();
        $.ajax({
            url: url,
            dataType: 'jsonp',
            jsonpCallback: 'parseResponse'
        }).then(function (response) {
            var result = parser.readFeatures(response);
            //console.log(result);

            if (result.length) {
                var popupContent = '';
                for (var i = 0, ii = result.length; i < ii; ++i) {
                    var values = result[i].values_;
                    console.log(values);
                    console.log(result[i].values_.reportitem_item_name);
                    console.log(result[i].values_.reportitem_subtype_name);
                    console.log(result[i].values_.reportitem_timestamp_created);
                    console.log(result[i].values_.reportitem_is_verified);
                    isVerified = undefined;

                    popupContent = values.reportitem_item_name;
                    popupContent += '(' + values.reportitem_subtype_name + ')';


                    switch (values.reportitem_type) {
                        case 0:

                            break;
                        case 1:
                            if (values.event_timestamp_occurance)
                                popupContent += '<br> time: ' + String(values.event_timestamp_occurance);
                            break;
                        case 2:

                            break;
                        case 3:
                            if (values.damage_quantity)
                                popupContent += '<br> ' + String(values.damage_quantity);
                            if (values.damage_units_shortname)
                                popupContent += ' ' + String(values.damage_units_shortname);
                            break;
                        case 4:
                            if (values.need_quantity)
                                popupContent += '<br> ' + String(values.need_quantity);
                            if (values.need_units_shortname)
                                popupContent += ' ' + String(values.need_units_shortname);
                            break;
                        default :
                            break;
                    }
                    if (values.reportitem_is_verified) {
                        isVerified = 'verified'
                    } else {
                        isVerified = 'not verified'
                    }
                    popupContent += '<br>' + isVerified;

                }
                ////container.innerHTML = info.join(', ');
                popup.show(evt.coordinate, popupContent);
            } else {
                //popup.show(evt.coordinate, 'Nothing to show!');
                //container.innerHTML = '&nbsp;';
            }
        });
    }
};
//map.addLayer(reportitems_all);
map.on('click', reportitems_all_clickHandler);
//}}}./reportitems

//{{{ tracking_driver wms : http://116.90.239.21:8080/geoserver/dmis/wms?service=WMS&version=1.1.0&request=GetMap&layers=dmis:tracking_driver&styles=&bbox=33.0,22.0,88.0,33.0&width=1650&height=330&srs=EPSG:4326&format=application/openlayers
var tracking_driver = new ol.layer.Tile({
        title:'tracking_driver',
        name : 'tracking_driver',
        type : 'overlay',
        source : new ol.source.TileWMS(
            ({  url: 'http://116.90.239.21:8080/geoserver/wms',
                params: {'LAYERS': 'dmis:tracking_driver', 'TILED': true}
            }))
    });
    map.addLayer(tracking_driver);

      /*
            Refreshing a layer at an interval
            */
           map.once("postcompose", function(){
                       //start refreshing each 3 seconds
                       window.setInterval(function(){
                           /// call your function here
                           var params = tracking_driver.getSource().getParams();
                           params.t = new Date().getMilliseconds()
                           tracking_driver.getSource().updateParams(params);
                       }, 3000);
                   }
           );
//}}}./tracking_driver wms


//{{{ tracking_driver wfs
/*var driverGeoJSONSource = new ol.source.Vector();
var geojsonFormat = new ol.format.GeoJSON();
driverVectorLayer=new ol.layer.Vector({ source: driverGeoJSONSource});
map.addLayer(driverVectorLayer);

  $.ajax({
        url:'http://116.90.239.21/github/php_postgres/postgis_geojson.php',
       data:{
           geotable:"\"tracking\".tracking_driver",
           geomfield:"geom"
       },
      success:function(data) {
        var features = geojsonFormat.readFeatures(data,
            {featureProjection:"EPSG:3857"});
        driverGeoJSONSource.clear();
        driverGeoJSONSource.addFeatures(features);
      }
  });*/

 /* var timer = null;
var vectorSource = new ol.source.ServerVector({
    format: new ol.format.GeoJSON(),
    loader: function(extent, resolution, projection) {
        if (timer != null) {
            clearInterval(timer);
            timer = null;
        }
        //var url = 'http://116.90.239.21:8000/geoserver/cite/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=cite:MyFeature&maxFeatures=50&outputFormat=application/json';
        var url = 'http://116.90.239.21/github/php_postgres/postgis_geojson.php';
        $.ajax({
        url:url,
           data:{
               geotable:"\"tracking\".tracking_driver",
               geomfield:"geom"
           },
          success:function(data) {
            var features = geojsonFormat.readFeatures(data,
                {featureProjection:"EPSG:3857"});
            driverGeoJSONSource.clear();
            driverGeoJSONSource.addFeatures(features);
          }
        });//.done(loadFeatures);
    }
});*/

/*var vectorSource = new ol.source.ServerVector({
    format: new ol.format.GeoJSON(),
    loader: function(extent, resolution, projection) {
        var url = 'http://116.90.239.21:8080/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis%3Atracking_driver&maxFeatures=50&outputformat=application%2Fjson';
        $.ajax({
            url: url,
            success:function(data){
                console.log(data);
            }
        })
    }
});
map.addLaer(vectorSource);*/
//}}}./ tracking_driver wfs
//}}}./Defining overlay Layers

//http://116.90.239.21:8080/geoserver/dmis/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=dmis:reportitems_all&maxFeatures=50&outputFormat=text%2Fjavascript




   /* {{{ Original */
    /*var osm = new ol.layer.Tile({
        title:'OSM',
        type:'base',
        source: new ol.source.OSM()
    });

    var tilewmsSource = new ol.source.TileWMS(
        ({
            //   url: 'http://116.90.239.21:8080/geoserver/wms',
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
            ({  url: 'http://116.90.239.21:8080/geoserver/wms',
                params: {'LAYERS': 'fra:ambulance', 'TILED': true}
            }))
    });

    var vectorSource = new ol.source.ServerVector({
        format: new ol.format.GeoJSON({
            //    projection: 'EPSG:3857'
        }),
        loader: function(extent, resolution, projection) {
            //    var url='http://116.90.239.21:8080/geoserver/fra/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=fra%3Aambulance&srsname=EPSG:3857&maxFeatures=50&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');
            var url='http://116.90.239.21:8080/geoserver/disaster/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=disaster%3Ahazard0,disaster:kbl0&srsname=EPSG:3857&maxFeatures=50&outputformat=text/javascript&format_options=callback:loadFeatures&bbox=' + extent.join(',');
            //   var url = 'http://116.90.239.21:8080/geoserver/disaster/ows?service=WFS&version=1.0.0&request=GetFeature&layer=disaster:hazard0&outputformat=text/javascript&srsname=EPSG:4326';

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



        var reportitems_all_clickHandler = function (evt) {


    tilewmsSource = tilewmsSource;
    viewResolution = view.getResolution();
    viewProjection = view.getProjection();
    //  console.log(evt.coordinate);
    var url = tilewmsSource.getSource().getGetFeatureInfoUrl(
        evt.coordinate, viewResolution, viewProjection,
        {
            'INFO_FORMAT': 'text/javascript'
            //   'propertyName': 'status',''
        });

    if (url) {
        var parser = new ol.format.GeoJSON();
        $.ajax({
            url: url,
            dataType: 'jsonp',
            jsonpCallback: 'parseResponse'
        }).then(function (response) {
            var result = parser.readFeatures(response);
            //console.log(result);

            if (result.length) {
                var popupContent = '';
                for (var i = 0, ii = result.length; i < ii; ++i) {
                    var values = result[i].values_;
                    console.log(values);
                    console.log(result[i].values_.reportitem_item_name);
                    console.log(result[i].values_.reportitem_subtype_name);
                    console.log(result[i].values_.reportitem_timestamp_created);
                    console.log(result[i].values_.reportitem_is_verified);
                    isVerified = undefined;

                    popupContent = values.reportitem_item_name;
                    popupContent += '(' + values.reportitem_subtype_name + ')';


                    switch (values.reportitem_type) {
                        case 0:

                            break;
                        case 1:
                            if (values.event_timestamp_occurance)
                                popupContent += '<br> time: ' + String(values.event_timestamp_occurance);
                            break;
                        case 2:

                            break;
                        case 3:
                            if (values.damage_quantity)
                                popupContent += '<br> ' + String(values.damage_quantity);
                            if (values.damage_units_shortname)
                                popupContent += ' ' + String(values.damage_units_shortname);
                            break;
                        case 4:
                            if (values.need_quantity)
                                popupContent += '<br> ' + String(values.need_quantity);
                            if (values.need_units_shortname)
                                popupContent += ' ' + String(values.need_units_shortname);
                            break;
                        default :
                            break;
                    }
                    if (values.reportitem_is_verified) {
                        isVerified = 'verified'
                    } else {
                        isVerified = 'not verified'
                    }
                    popupContent += '<br>' + isVerified;

                }
                ////container.innerHTML = info.join(', ');
                popup.show(evt.coordinate, popupContent);
            } else {
                //popup.show(evt.coordinate, 'Nothing to show!');
                //container.innerHTML = '&nbsp;';
            }
        });
    }
};
var popup = new ol.Overlay.Popup();
map.addOverlay(popup);

map.on('click', reportitems_all_clickHandler);

        $('#map').data('map',map);


    }
    init();*/
    /*}}} ./Original */
JS;
$this->registerJs($jsMap, $this::POS_READY);
?>

<?php
$js1 = <<<JS

/*    $('#camp').click(function() {
        $('#toolbar').fullscreen();
        return false;
    });*/

$("#social_twitter").click(function(){
    $( "#twitter_box" ).dialog({
        title:'Twitter Timeline',
        open: function(event, ui) {
            $( "#twitter_box" ) .load('twitter_timeline.html');
        }
    });
})

$("#social_facebook").click(function(){
    $( "#facebook_box" ).dialog({
        width:"auto",
        title:'Facebook Timeline',
        open: function(event, ui) {
            $( "#facebook_box" ) .load('facebook_timeline.html');
        }
        /*buttons: [
            {
                text: "OK",
                click: function() {
                    $( this ).dialog( "close" );
                }
            }
        ]*/
    });
})

/*
$("#resources").click(function(){
    $( "#resources_box" ).dialog({
        title:'Search Ambulance',
        modal:false,
        resizeable:false,
     //   height:"auto",
       width:"auto",
       minHeight: 0,
        create: function() {
            $(this).css("maxHeight", 120);
        }
    });
})
*/

$("#resources").click(function(){
    $( "#resources_box" ).dialog({
        title:'Search Ambulance',
        open: function(event, ui) {
            $( "#resources_box" ) .load('ambulance_search.html');
        }
    });
})


$("#geofence").click(function(){
    $( "#geometryPicker_box" ).dialog({
        title:'Geometry Picker',
        open: function(event, ui) {
            $( "#geometryPicker_box" ) .load('geometry_picker.html');
        },
        close:function(){

        }
    })
})

/*$("#updates").click(function(){
    $( "#fbalbum_box" ).dialog({
        title:'Facebook Photo',
        open: function(event, ui) {
            $( "#fbalbum_box" ) .load('fb_gallery/index.php');
		 //  $( "#fbalbum_box" ).open('fb_gallery/index.php');
        },
        close:function(){

        }
    })
})*/



    /*------Dialog box ----*/
    $('#report').click(function() {
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

    });



$('.pullout-right-footer-btn').click(function() {
  //  $( ".pullout-right-footer" ) .load('gallery.html');
    $( "#images" ) .load('gallery.html');

});


  /*  *//*------Carousel----*//*
    $('#myCarousel').carousel({
        interval: 10000
    })



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
    });*/
JS;
$this->registerJs($js1, $this::POS_READY);
$js2 = <<<JS
   var pullout_right_footer = $('div.pullout-right-footer');
    var pullout_right_footer_btn = $('div.pullout-right-footer-btn');
    pullout_right_footer_btn.click(function() {
        if (!$(this).hasClass("open")) {
            $(this).css("bottom", "15.5em");
           // $(this).css("position", "relative");
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
                  element:  $('<img src="http://116.90.239.21/girc/dmis/img/location.png" style="width:32px;height:auto;">')
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




<div id="gv-driver-search">
    <?php
    $searchModel = new \common\modules\tracking\models\search\Driver();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    $dataProvider->pagination = ['pageSize' => 0];


    \yii\widgets\Pjax::begin();
    echo GridView::widget([
        'id' => 'gridview-drivers',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'Firstname',
            'Lastname',
            //'Address',
            //'Phonr',
            //'IMEI',
            // 'Gender',
            'Ambulance_Number',
            // 'id',
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    \yii\widgets\Pjax::end();

    $this->registerJs('$("gridview-drivers").on("afterFilter", function(event){
    alert(1);
})', \yii\web\View::POS_READY);
    /*$this->registerJs('$("body").on("keyup.yiiGridView", "#gridview-drivers .filters input", function(){
        $("#gridview-drivers").yiiGridView("applyFilter");
    })', \yii\web\View::POS_READY);*/

    ?>

</div>


<div id="ambulance_search_container">
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
</div>

<?php
$jsDriverSearch = <<<JS
    var driverAttribute, driverValue;
 $.ajax({
       url: '/girc/dmis/api/tracking/tracking-drivers/attributes'
       , dataType: 'json'
       , success: function(response){
                for (var i = 0; i < response.length; i++){
                    var columnName=response[i];
                    $("#driver-attributes").append($('<option/>', {
                    value: columnName,
                    text : columnName
            }));
        }
       },
       error: function(msg){
           console.log(msg);
       }
    });

    $("#driver-attributes").on('change',function(e){
            $("#driver-attribute-values").empty();
         $.ajax({
               url: '/girc/dmis/api/tracking/tracking-drivers/unique/'+$("#driver-attributes").val()
               , dataType: 'json'
               ,data:{
                    count_alias:'count'
                    ,property_alias:'value'
               }
               , success: function(response){
                         console.log(response);
                        for (var i = 0; i < response.length; i++){
                            var value=response[i].value;
                           // var count=response[i].count;
                            $("#driver-attribute-values").append($('<option/>', {
                            value: value,
                            text : value
                    }
                    )
                    );
                }
               },
               error: function(msg){
                   console.log(msg);
               }
            });

    });

$("#ambulance_no").hide();
$("#drivers").hide();

$('#search_ambulance').on('click',function(){
    $('#ambulance_search_container').dialog({
        title:'Search Ambulance',
        resizable: false,
        modal: true,
        width:'auto'});
        /*Ambulance search */
           var  drivers = [];
			var ambulance_no = [];
			var longitude = [];
			var latitude = [];
			var center_lat, center_lon;
			dropdown = function(data){
				features = data.features;
				features_length = data.features.length;
				drivers=[];
				ambulance_no = [];
			    longitude = [];
                latitude = [];

				for (i = 0; i < features_length; i++) {
					var driver_name = features[i].properties.Firstname + '' + features[i].properties.Lastname;
					drivers.push(driver_name);
					ambulance_no.push(features[i].properties.Ambulance_Number);
					latitude.push(features[i].geometry.coordinates[0]);
					longitude.push(features[i].geometry.coordinates[1]);
					$("#drivers").append('<option value="'+drivers[i]+'">'+drivers[i]+'</option>');
					$("#ambulance_no").append('<option value="'+ambulance_no[i]+'">'+ambulance_no[i]+'</option>');
				};
			};

			$("#drivers").on('change',function(){
									index = drivers.indexOf($(this).val());
									center_lon = parseFloat(longitude[index]);
									center_lat=parseFloat(latitude[index]);
								});
                $("#ambulance_no").on('change',function(){
									index = ambulance_no.indexOf($(this).val());
									center_lon = parseFloat(longitude[index]);
									center_lat=parseFloat(latitude[index]);
								});

				$("#all_options").on('change',function(){
						opt_val = $(this).val();
						 if (opt_val=="driver"){
							//	$("#drivers").append('<option value="'+drivers[i]+'">'+drivers[i]+'</option>');
								$("#ambulance_no").hide();
								$("#drivers").show();
						}
						else{
						//	$("#ambulance_no").append('<option value="'+ambulance_no[i]+'">'+ambulance_no[i]+'</option>');
							$("#drivers").hide();
							$("#ambulance_no").show();
						}
					});
			            $("#search").click(function(){
			            if(center_lat!=undefined && center_lon!=undefined){
			            								//		map.setCenter(new OpenLayers.LonLat(longitude[index],latitude[index]), 12);
								map.getView().setCenter(ol.proj.transform([center_lon,center_lat], 'EPSG:4326', 'EPSG:3857'));
								//map.getView().setCenter(ol.proj.transform([center_lon,center_lat ], 'EPSG:4326', 'EPSG:3857'));
								map.getView().setZoom(12);
			            }else{
			            alert('could not find location');
			            }
                    });

			var getJson =  function(){
	alert("hello");
 };
  var url = "http://116.90.239.21:8080/geoserver/dmis/ows?service=WFS&version=1.1.0&request=GetFeature&typeName=dmis:tracking_driver&outputFormat=text/javascript&format_options=callback:getJson";
 // var url = "http://localhost:8080/geoserver/dmis/ows?service=WFS&version=1.1.0&request=GetFeature&typeName=dmis:tracking_driver&outputFormat=application/json";
	var json_data;
                    $.ajax({
                        jsonp: false,
                       jsonpCallback: 'getJson',
                        type: 'GET',
                        url: url,
                        async: false,
                        dataType: 'jsonp',
                       // dataType: 'json',
                        success: function(data) {
							console.log(data);
                           dropdown(data);
                        },
                        error:function(jqXHR){
                            console.log(jqXHR);
                        }
                    });
});

$('#gv-driver-search').dialog({ resizable: false,
autoOpen:false,
        modal: true,
        width:'auto'});



$("#directions").click(function(){
    $( "#geometry_picker_container" ).dialog({
        title:'Geom Picker',
        open: function(event, ui) {
            $( "#geometry_picker_container" ) .load('site/geometry-picker');
        },
        close: function(ev, ui) {
            map.removeInteraction(draw_interaction);
            vector_layer.getSource().clear();
          //  $(this).close();
        }
    });
})

JS;
$this->registerJs($jsDriverSearch, $this::POS_READY);
?>
<div id="geometry_picker_container"></div>