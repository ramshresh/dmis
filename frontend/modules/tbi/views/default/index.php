<?php

/* @var $this \yii\web\View */
use common\assets\d3\D3Asset;
use common\assets\jquery_print\JqueryPrintAsset;
use common\assets\leaflet\LeafletAsset;
use common\assets\leaflet_easyPrint\LeafletEasyPrintAsset;
use common\assets\leaflet_markerCluster\LeafletMarkerClusterAsset;
use common\assets\MustacheAsset;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\helpers\Html;
use miloschuman\highcharts\HighchartsAsset;
use yii\web\JqueryAsset;
use yii\widgets\Pjax;

$this->title = 'Traditional Building Inventory';
JqueryAsset::register($this);

LeafletAsset::register($this);
LeafletMarkerClusterAsset::register($this);
JqueryPrintAsset::register($this);
LeafletEasyPrintAsset::register($this);
D3Asset::register($this);
HighchartsAsset::register($this)->withScripts(['modules/exporting', 'modules/drilldown']);
MustacheAsset::register($this);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.0/masonry.pkgd.min.js"></script>
<style>
/*    Gridview */
    #mapDetailBody{
        height: 32em;
        overflow:hidden;
        overflow-y: auto;
        overflow-x: auto;
    }
    #map {
        position: relative;
        height: 32em;
    }

    #afterPhotos{
        height: 32em;
        overflow:hidden;
        overflow-y: auto;
        overflow-x: auto;
    }
    #mapSummaryBody{
        overflow:hidden;
        overflow-y: auto;
        overflow-x: auto;
    }



    #legend {
        position: absolute;
        bottom: 5px;
        right: 5px;
        margin: 10px;
        padding: 5px;
        border-radius: 5px;
        z-index: 100;
        font-size: 1em;
        font-family: sans-serif;
        width: 165px;
        background: rgba(255, 255, 255, 0.6);
    }

    .legendheading {
        position: relative;
        height: 25px;
        padding: 5px 2px 0px 2px;
        font-size: larger;
        font-weight: bold;
    }

    .legenditem {
        padding: 2px;
        margin-bottom: 2px;
    }

    /*Marker clusters*/
    .marker-cluster-pie g.arc {
        fill-opacity: 0.5;
    }

    .marker-cluster-pie-label {
        font-size: 14px;
        font-weight: bold;
        font-family: sans-serif;
    }

    /*Markers*/
    .marker {
        width: 18px;
        height: 18px;
        border-width: 2px;
        border-radius: 10px;
        margin-top: -10px;
        margin-left: -10px;
        border-style: solid;
        /*fill: #CCC;
        stroke: #444;
        background: #CCC;
        border-color: #444;*/
    }

    .marker div {
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        font-family: sans-serif;
    }

    /*Popup*/
    .map-popup span.heading {
        display: block;
        font-size: 1.2em;
        font-weight: bold;
    }

    .map-popup span.attribute {
        display: block;
    }

    .map-popup span.label {
        font-weight: bold;
    }

    /* Grow */
    .hvr-grow {
        display: inline-block;
        vertical-align: middle;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -moz-osx-font-smoothing: grayscale;
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-transition-property: transform;
        transition-property: transform;
    }

    .hvr-grow:hover, .hvr-grow:focus, .hvr-grow:active {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }

    /* @see: http://ianlunn.github.io/Hover/*/
    /* SHADOW/GLOW TRANSITIONS */
    /* Glow */
    .hvr-glow {
        display: inline-block;
        vertical-align: middle;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -moz-osx-font-smoothing: grayscale;
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-transition-property: box-shadow;
        transition-property: box-shadow;
    }

    .hvr-glow:hover, .hvr-glow:focus, .hvr-glow:active {
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.6);
    }

    /* Bubble */
    .hvr-bubble-right {
        display: inline-block;
        vertical-align: middle;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -moz-osx-font-smoothing: grayscale;
        position: relative;
        height: 100px;
    }


</style>
<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Map </h3>

                        <div class="box-tools pull-right">
                            <a href="<?= Yii::$app->urlManagerBackEnd->createAbsoluteUrl(["/tbi/crud-building"]);?>"><button class="btn btn-info">Admin Page</button></a>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div id="mapBody" class="box-body">
                        <div id="map"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Photos</h3>

                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div id="mapDetailBody" class="box-body">
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Data Table - Traditional Buildings</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div id="mapSummaryBody" class="box-body">
                <?php
                $gridColumns=[
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'user_id',
                    'surveyor:ntext',
                    'surveyed_by:ntext',
                    'survey_date',
                    'surveyed_at',
                    'owner_name:ntext',
                    'owner_contact:ntext',
                    'owner_comment:ntext',
                    'building_name:ntext',
                    'year_of_construction',
                    'no_of_storey',
                    'current_use:ntext',
                    'special_features:ntext',
                    'type:ntext',
                    'type_other:ntext',
                    'style:ntext',
                    'style_other:ntext',
                    'physical_condition:ntext',
                    'physical_condition_comment:ntext',
                    'street:ntext',
                    'settlement:ntext',
                    'ward_no',
                    'v_code',
                    'd_code',
                    'z_code',
                    'latitude',
                    'longitude',
                    'timestamp_created_at',
                    'timestamp_updated_at',
                    // 'geom',
                    // 'wkt:ntext',
                    [
                        'attribute' => 'userProfileFullName',
                        'value' => 'userProfile.full_name'
                    ],

                ];
                ?>
                <?php Pjax::begin();?>

                <?php

                // Renders a export dropdown menu
                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'emptyText'=>'Empty Result',
                    'target'=>ExportMenu::TARGET_SELF,
                ]);
                ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                       // 'id',
                        'user_id',
                        'surveyor:ntext',
                        'surveyed_by:ntext',
                        'survey_date',
                        'surveyed_at',
                        'owner_name:ntext',
                         'owner_contact:ntext',
                         'owner_comment:ntext',
                         'building_name:ntext',
                         'year_of_construction',
                         'no_of_storey',
                         'current_use:ntext',
                         'special_features:ntext',
                         'type:ntext',
                         'type_other:ntext',
                         'style:ntext',
                         'style_other:ntext',
                         'physical_condition:ntext',
                         'physical_condition_comment:ntext',
                         'street:ntext',
                         'settlement:ntext',
                         'ward_no',
                         'v_code',
                         'd_code',
                        // 'z_code',
                         'latitude',
                         'longitude',
                         'timestamp_created_at',
                         'timestamp_updated_at',
                        // 'geom',
                        // 'wkt:ntext',
                        [
                            'attribute' => 'userProfileFullName',
                            'value' => 'userProfile.full_name'
                        ],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {edit}',

                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','#', [
                                        'id' => 'activity-view-link',
                                        'title' => Yii::t('yii', 'View'),
                                        'data-toggle' => 'modal',
                                        'data-target' => '.activity-view-link',
                                        'data-id' => $key,
                                        'data-pjax' => '0',

                                    ]);
                                },
                            ],
                        ],


                    ],
                ]); ?>
                <?php Pjax::end();?>
<?php
                $this->registerJs("$('.activity-view-link').click(function() {var elementId = $(this).closest('tr').data('key'); alert($(this));});");
                ?>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<div  class="modal activity-view-link">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Modal Default</h4>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>
    <?php $this->beginBlock('map-posReady'); ?>
    "use strict"
    var geojson,
        metadata = {
            "attribution": "Traditional Building Inventory Survey, Nepal Earthquake 2015 ",
            "description": "The survey was conducted by Kathmandu Municipality from June xx to June xx  2015 after Nepal Earthquake 2015",
            "fields": {
                "building_name": {
                    "name": "Name"
                },
                "year_of_construction": {
                    "name": "Constructed In"
                },
                "no_of_storey": {
                    "name": "No. of Storey"
                },
                "current_use": {
                    "name": "Current Use"
                },
                "type": {
                    "name": "Building Type",
                    "lookup": {
                        "11":"Other",
                        "7":"Jahru",
                        "3":"Dyo Chhe",
                        "6":"Pokhari",
                        "5":"Phalcha",
                        "8":"Sattal",
                        "4":"Hiti",
                        "9":"Ianr or Kuwa",
                        "2":"Temple",
                        "10":"Freestanding Shrines",
                        "1":"Residental Dwelling"
                    }
                },
                /*"type": {
                    "name": "Building Type",
                    "lookup": {
                        "other":"Other",
                        "pati":"Pati",
                        "jahru":"Jahru",
                        "dyo chhe":"Dyo Chhe",
                        "pokhari":"Pokhari",
                        "phalcha":"Phalcha",
                        "sattal":"Sattal",
                        "hiti":"Hiti",
                        "inar or kuwa":"Ianr or Kuwa",
                        "temple":"Temple",
                        "freestanding shrines":"Freestanding Shrines",
                        "residental dwelling":"Residental Dwelling"
                    }
                },*/
                "type_other": {
                    "name": "Building Type(Other)"
                },
                "special_features": {
                    "name": "Special Features"
                },
                "style": {
                    "name": "Architecture Style",
                    /*"lookup": {
                        "10": "other",
                        "2": "vernacular",
                        "3": "gurung",
                        "4": "tharu",
                        "5": "tamang",
                        "6": "chetteri",
                        "7": "brahmin",
                        "1": "newar",
                        "9": "rana",
                        "8": "modern"
                    }*/
                    "lookup":{
                        "1":"Shikara",
                        "2":"Pyagoda",
                        "3":"Gumbaj/Moughal",
                        "4":"Stupa",
                        "5":"Others"
                    }
                },
                /*"style": {
                    "name": "Architecture Style",
                    "lookup": {
                        "other": "other",
                        "vernacular": "vernacular",
                        "gurung": "gurung",
                        "tharu": "tharu",
                        "tamang": "tamang",
                        "chetteri": "chetteri",
                        "brahmin": "brahmin",
                        "newar": "newar",
                        "rana": "rana",
                        "modern": "modern"
                    }
                },*/
                "style_other": {
                    "name": "Architecture Style(Other)"
                },
                "physical_condition": {
                    "name": "Physical Condition",
                    "lookup": {
                        "1":"No visible damage",
                        "2":"Minor damage",
                        "4":"Partially collapsed",
                        "3":"Major damage",
                        "5":"Completely collapsed"
                    }
                },
                /*"physical_condition": {
                    "name": "Physical Condition",
                    "lookup": {
                        "no visible damage":"No visible damage",
                        "minor damage":"Minor damage",
                        "partially collapsed":"Partially collapsed",
                        "major damage":"Major damage",
                        "completely collapsed":"Completely collapsed"
                    }
                },*/
                "physical_condition_comment": {
                    "name": "Comment"
                },
                "street": {
                    "name": "Street"
                },
                "settlement": {
                    "name": "Settlement"
                },
                "surveyor": {
                    "name": "Surveyor"
                },
                "surveyed_by": {
                    "name": "Surveyed By"
                },
                "survey_date":{
                    "name":"Survey Date"
                },
                "surveyed_at": {
                    "name": "Surveyed At"
                },
                "owner_name": {
                    "name": "Current Use"
                },
                "owner_contact": {
                    "name": "Owner Contact"
                },
                "owner_comment": {
                    "name": "Owner Comment"
                }
            }
        },
       // geojsonPath = 'traffic_accidents.json',
        categoryField = 'physical_condition', //This is the fieldname for marker category (used in the pie and legend)
        categories = {
            "physical_condition": {
                //"values": ["no visible damage","minor damage","partially collapsed","major damage","completely collapsed"],
                "values": ["1","2","3","4","5"],
                "cssStyles": [
                    {"fill": "#40d47e", "stroke": "#ffffff", "background": "#40d47e", "border-color": "#ffffff"},
                    {"fill": "#f1c40f", "stroke": "#ffffff", "background": "#f1c40f", "border-color": "#ffffff"},
                    {"fill": "#d35400", "stroke": "#ffffff", "background": "#d35400", "border-color": "#ffffff"},
                    {"fill": "#e74c3c", "stroke": "#ffffff", "background": "#e74c3c", "border-color": "#ffffff"},
                    {"fill": "#ff0000", "stroke": "#ffffff", "background": "#ee4c3c", "border-color": "#ffffff"}
                    /*{"fill": "#ff000", "stroke": "#ffffff", "background": "#ee4c3c", "border-color": "#ffffff"}*/
                ]
            }
        },
        icons = {
            "physical_condition": {
                //"values": ["no visible damage","minor damage","partial damage","major damage","completely collapsed"],
                "values": ["1","2","3","4","5"],
                "cssStyles": [
                    {
                        "background-image": "url('http://www.iconsdb.com/icons/download/black/running-16.png')",
                        "background-repeat": "no-repeat",
                        "background-position": "0px 1px"
                    },
                    {
                        "background-image": "url('http://www.iconsdb.com/icons/download/black/bicycle-16.png')')",
                        "background-repeat": "no-repeat",
                        "background-position": "0px -2px"
                    },
                    {
                        "background-image": "url('http://www.iconsdb.com/icons/download/black/motorcycle-16.png')",
                        "background-repeat": "no-repeat",
                        "background-position": "0px -2px"
                    },
                    {
                        "background-image": "url('http://www.iconsdb.com/icons/download/black/car-16.png')",
                        "background-repeat": "no-repeat",
                        "background-position": "0px -2px"
                    },
                    {
                        "background-image": "url('http://www.iconsdb.com/icons/download/black/car-16.png')",
                        "background-repeat": "no-repeat",
                        "background-position": "0px -2px"
                    }
                ]
            }
        },
        iconField = 'physical_condition', //This is the fieldame for marker icon
        popupFields = [
            'building_name',
            'physical_condition',
            'physical_condition_comment',
            'surveyor',
            'surveyed_at',
            'surveyed_by',
            'survey_date',
            'owner_contact',
            'owner_comment',
            'year_of_construction',
            'no_of_storey',
            'current_use',
            'special_features',
            'type',
            'type_other',
            'style',
            'style_other',
            'street',
            'settlement'
        ], //Popup will display these fields
        tileServer = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        tileAttribution = 'Map data: <a href="http://openstreetmap.org">OSM</a>',
        rmax = 30, //Maximum radius for cluster pies
        markerclusters = L.markerClusterGroup({
            maxClusterRadius: 2*rmax,
            iconCreateFunction: defineClusterIcon //this is where the magic happens
        });


    var map = L.map('map').setView([27.70, 85.30], 8);

    L.easyPrint().addTo(map)

    //Add basemap
    L.tileLayer(tileServer, {attribution: tileAttribution, maxZoom: 24}).addTo(map);
    //and the empty markercluster layer
    map.addLayer(markerclusters);


    // L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: 'Map data &copy; '+ mapLink , maxZoom: 24,}).addTo(map);


    //        Heritage Layer
    var owsrootUrl = 'http://smtp.icimod.org:8080/geoserver/dmis/ows';
    var defaultParameters = {
        service: 'WFS',
        version: '2.0',
        request: 'GetFeature',
        typeName: 'dmis:building',
        outputFormat: 'text/javascript',
        format_options: 'callback:getJson',
        SrsName: 'EPSG:4326'
    };
    var parameters = L.Util.extend(defaultParameters);
    var URL = owsrootUrl + L.Util.getParamString(parameters);
    $.ajax({
        url: URL,
        dataType: 'jsonp',
        jsonpCallback: 'getJson',
        success: function (data) {
            geojson = data;
            var markers = L.geoJson(geojson, {
                pointToLayer: defineFeature,
                onEachFeature: defineFeaturePopup
            });
            markerclusters.addLayer(markers);
            map.fitBounds(markers.getBounds());
            map.attributionControl.addAttribution(metadata.attribution);

            renderLegend();
            renderCssStyle();
        },
        error: function () {
            console.log('Could not load data...');
        }
    });

    //       ./ Heritage Layer

    function defineFeature(feature, latlng) {
        var categoryVal = feature.properties[categoryField],
            iconVal = feature.properties[iconField];
        var myClass = 'marker hvr-grow hvr-glow category-' + space2underscore(categoryVal) + ' icon-' + space2underscore(iconVal);

        var myIcon = L.divIcon({
            className: myClass,
            iconSize: null
        });
        return L.marker(latlng, {icon: myIcon});
    }

    function defineFeaturePopup(feature, layer) {
     //   console.log(feature);
        var props = feature.properties,
            fields = metadata.fields,
            popupContent = '',
            fid = feature.id.split('.')[1];
        popupFields.map(function (key) {
            if (props[key]) {
                var val,field,label,lookup;
                if(props[key] && fields[key]){
                    val = props[key];
                    if(fields[key] && props[key]){
                        field  = fields[key];
                        label  =  field.name;
                        if(field.lookup){
                            lookup = field.lookup;
                            val = lookup[val];
                        }else{
                            console.log('no lookup for key:'+key+' fields ->'+JSON.stringify(fields));
                        }
                    }else{
                        console.log('fields or props not defined for key ->'+key+' fields -> '+ JSON.stringify(fields)+' props -> '+JSON.stringify(props));
                    }

                }

                if(!label || !val){
                    console.log('error label or val not defined');
                    console.log('lookup -> '+ JSON.stringify(lookup));
                    console.log('val -> '+ val);
                }
                popupContent += '<span class="attribute text-muted"><span class="text-aqua">' + label + ':</span> ' + val + '</span>';
            }
        });
        popupContent = '<div class="map-popup">' + popupContent + '</div>';
        layer.on('click', function (e) {
            popupSetImages(fid);
        });
        layer.bindPopup(popupContent, {offset: L.point(1, -2)});
    }

    function defineClusterIcon(cluster) {
        var children = cluster.getAllChildMarkers(),
            n = children.length, //Get number of markers in cluster
            strokeWidth = 1, //Set clusterpie stroke width
            r = rmax - 2 * strokeWidth - (n < 10 ? 12 : n < 100 ? 8 : n < 1000 ? 4 : 0), //Calculate clusterpie radius...
            iconDim = (r + strokeWidth) * 2, //...and divIcon dimensions (leaflet really want to know the size)
            data = d3.nest() //Build a dataset for the pie chart
                .key(function (d) {
                    return d.feature.properties[categoryField];
                })
                .entries(children, d3.map),
        //bake some svg markup
            html = bakeThePie({
                data: data,
                valueFunc: function (d) {
                    return d.values.length;
                },
                strokeWidth: 1,
                outerRadius: r,
                innerRadius: r - 10,
                pieClass: 'cluster-pie',
                pieLabel: n,
                pieLabelClass: 'marker-cluster-pie-label',
                pathClassFunc: function (d) {
                    return "hvr-grow hvr-glow category-" + space2underscore(d.data.key);
                },
                pathTitleFunc: function (d) {
                    return metadata.fields[categoryField].lookup[d.data.key] + ' (' + d.data.values.length + ' monument' + (d.data.values.length != 1 ? 's' : '') + ')';
                }
            }),
        //Create a new divIcon and assign the svg markup to the html property
            myIcon = new L.DivIcon({
                html: html,
                className: 'marker-cluster',
                iconSize: new L.Point(iconDim, iconDim)
            });
        return myIcon;
    }

    /*function that generates a svg markup for the pie chart*/
    function bakeThePie(options) {
        /*data and valueFunc are required*/
        if (!options.data || !options.valueFunc) {
            return '';
        }
        var data = options.data,
            valueFunc = options.valueFunc,
            r = options.outerRadius ? options.outerRadius : 35, //Default outer radius = 28px
            rInner = options.innerRadius ? options.innerRadius : r - 15, //Default inner radius = r-10
            strokeWidth = options.strokeWidth ? options.strokeWidth : 1, //Default stroke is 1
            pathClassFunc = options.pathClassFunc ? options.pathClassFunc : function () {
                return '';
            }, //Class for each path
            pathTitleFunc = options.pathTitleFunc ? options.pathTitleFunc : function () {
                return '';
            }, //Title for each path
            pieClass = options.pieClass ? options.pieClass : 'marker-cluster-pie', //Class for the whole pie
            pieLabel = options.pieLabel ? options.pieLabel : d3.sum(data, valueFunc), //Label for the whole pie
            pieLabelClass = options.pieLabelClass ? options.pieLabelClass : 'marker-cluster-pie-label',//Class for the pie label

            origo = (r + strokeWidth), //Center coordinate
            w = origo * 2, //width and height of the svg element
            h = w,
            donut = d3.layout.pie(),
            arc = d3.svg.arc().innerRadius(rInner).outerRadius(r);

        //Create an svg element
        var svg = document.createElementNS(d3.ns.prefix.svg, 'svg');
        //Create the pie chart
        var vis = d3.select(svg)
            .data([data])
            .attr('class', pieClass)
            .attr('width', w)
            .attr('height', h);

        var arcs = vis.selectAll('g.arc')
            .data(donut.value(valueFunc))
            .enter().append('svg:g')
            .attr('class', 'arc')
            .attr('transform', 'translate(' + origo + ',' + origo + ')');

        arcs.append('svg:path')
            .attr('class', pathClassFunc)
            .attr('stroke-width', strokeWidth)
            .attr('d', arc)
            .append('svg:title')
            .attr('class', 'hvr-bubble')
            .text(pathTitleFunc);

        vis.append('text')
            .attr('x', origo)
            .attr('y', origo)
            .attr('class', pieLabelClass)
            .attr('text-anchor', 'middle')
            //.attr('dominant-baseline', 'central')
            /*IE doesn't seem to support dominant-baseline, but setting dy to .3em does the trick*/
            .attr('dy', '.3em')
            .text(pieLabel);


        //Return the svg-markup rather than the actual element
        return serializeXmlNode(svg);
    }


    /*Function for generating a legend with the same categories as in the clusterPie*/
    function renderLegend() {
        var data = d3.entries(metadata.fields[categoryField].lookup),
            legenddiv = d3.select('#map').append('div')
                .attr('id', 'legend')
                .attr('style', 'background-color:#FFF;border:groove;border-width:thin;color:#000');

        //'<i style="background:' + getColor(from + 1) + '"></i> '
        var heading = legenddiv
                .append('li')
                .classed('legendheading', true)
                .text(metadata.fields[categoryField].name)
                .attr('style', 'width:100%;')
            ;

        var legenditems = legenddiv.selectAll('.legenditem')
            .data(data);

        legenditems
            .enter()
            .append('div')
            .attr('class', function (d) {
                return 'hvr-grow hvr-glow category-' + space2underscore(d.key);
            })
            .attr('style', 'width:100%; color:#FFF')
            .classed({'legenditem': true})
            .text(function (d) {
                return d.value;
            });
    }

    function renderCssStyle() {
        var sheet = addStylesheet('styleCategory');
        var clusterCategory = categories[categoryField];

        $.each(clusterCategory.values, function (idx, value) {
            var selector = '.category-' + space2underscore(value);
            var cssStyleObj = clusterCategory.cssStyles[idx];
            var cssStyleStr = selector + '{' + styleObj2css(cssStyleObj) + '}';
            sheet.insertRule(cssStyleStr, 0);
        });

        var iconCategory = categories[iconField];
        $.each(iconCategory.values, function (idx, value) {
            var selector = '.icon-' + space2underscore(value);
            var cssStyleObj = iconCategory.cssStyles[idx];
            var cssStyleStr = selector + '{' + styleObj2css(cssStyleObj) + '}';
           // sheet.insertRule(cssStyleStr, 0);
        });

        /*
         categoryField:5065
         Sample stylesheet "properties": {
         "5055": "2013-06-17",
         "5065": "4",
         "5074": "5"
         }
         */
        /*sheet.insertRule(".category-1{fill: #F88;stroke: #800; background: #F88; border-color: #800;}",0);
         sheet.insertRule(".category-2{fill: #FA0;stroke: #B60; background: #FA0; border-color: #B60;}",0);
         sheet.insertRule(".category-3{fill: #FF3;stroke: #D80; background: #FF3; border-color: #D80;}",0);
         sheet.insertRule(".category-4{fill: #BFB;stroke: #070; background: #BFB; border-color: #070;}",0);
         sheet.insertRule(".category-5{fill: #9DF;stroke: #007; background: #9DF; border-color: #007);}",0);
         sheet.insertRule(".category-6{fill: #CCC;stroke: #444; background: #CCC; border-color: #444;}",0);*/

    }

    /* Helper function*/
    function serializeXmlNode(xmlNode) {
        if (typeof window.XMLSerializer != "undefined") {
            return (new window.XMLSerializer()).serializeToString(xmlNode);
        } else if (typeof xmlNode.xml != "undefined") {
            return xmlNode.xml;
        }
        return "";
    }

    function addStylesheet(id) {
        var sheet = (function () {
            // Create the <style> tag
            var style = document.createElement("style");

            // Add a media (and/or media query) here if you'd like!
            // style.setAttribute("media", "screen")
            // style.setAttribute("media", "only screen and (max-width : 1024px)")

            // WebKit hack :(
            style.appendChild(document.createTextNode(""));

            // Add the <style> element to the page
            document.head.appendChild(style);

            return style.sheet;
        })();
        return sheet;
    }

    function addCSSRule(sheet, selector, rules) {
        //Backward searching of the selector matching cssRules
        var index = sheet.cssRules.length - 1;
        for (var i = index; i > 0; i--) {
            var current_style = sheet.cssRules[i];
            if (current_style.selectorText === selector) {
                //Append the new rules to the current content of the cssRule;
                rules = current_style.style.cssText + rules;
                sheet.deleteRule(i);
                index = i;
            }
        }
        if (sheet.insertRule) {
            sheet.insertRule(selector + "{" + rules + "}", index);
        }
        else {
            sheet.addRule(selector, rules, index);
        }
        return sheet.cssRules[index].cssText;
    }// Use it!  addCSSRule(document.styleSheets[0], "header", "float: left");

    function clearCSSRules(sheet) {
        var i = sheet.cssRules.length - 1;
        // Remove all the rules from the end inwards.
        while (i >= 0) {
            if ("deleteRule" in sheet) {
                sheet.deleteRule(i);
            }
            else if ("removeRule" in sheet) {
                sheet.removeRule(i);
            }
            i--;
        }
    }

    function styleObj2css(styleObject) {
        var css = '';
        var keys = Object.keys(styleObject);
        for (var i = 0; i < keys.length; i++) {
            css += keys[i] + ':' + styleObject[keys[i]] + ';';
        }
        return css;
    }

    function space2underscore(str) {
        return str.split(' ').join('_');
    }
    /* ./Helper function*/

    /**
     * Chart
     */
    var heritageHighChartsSeries_pie;
    var seriesData;
    var legendField=categoryField;

    var heritageLegend = {
        physical_condition: {
            values: ["no visible damage","minor damage","partially collapsed","major damage","completely collapsed"],
            color: ["#40d47e", "#f1c40f", "#d35400", "#e74c3c","#ee4c3c"]
        }
    };
    function getLegendColor(legendData, attribute, value) {
        var index = legendData[attribute].values.indexOf(value);
        return legendData[attribute].color[index];
    }
    var getHighChartSeries = function (chartType, url, queryParam) {
        return $.ajax({
            url: url,
            data: queryParam,
            success: function () {
                console.log('success getHighChartSeries()');
            },
            error: function () {
                console.log('error getHighChartSeries()');
            }
        });
    };
    getHighChartSeries('pie', 'http://smtp.icimod.org/girc/dmis/api/tbi/buildings/unique/' + legendField, {}, heritageLegend)
        .done(function (data) {
            var hcItems = [];
            var hcColors = [];
            $.each(data, function (idx, item) {
                var hcItem = [item.value, item.count];
                hcItems.push(hcItem);

                var hcColor = getLegendColor(heritageLegend, legendField, item.value);
                hcColors.push(hcColor);

               // console.log('highchart data.item');
               // console.log(item);
               // console.log('highchart data.item');
            });
            heritageHighChartsSeries_pie = hcItems;
           // console.log('hcItems');
           // console.log(hcItems);
           // console.log('hcItems');

            seriesData = hcItems;

            // Build the chart
            $('#chartContainerPie_Heritage').highcharts({
                colors: hcColors,
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Building Physical Condition'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Physical Condition',
                    data: seriesData
                    /*data: [
                     ['Firefox',   45.0],
                     ['IE',       26.8],
                     {
                     name: 'Chrome',
                     y: 12.8,
                     sliced: true,
                     selected: true
                     },
                     ['Safari',    8.5],
                     ['Opera',     6.2],
                     ['Others',   0.7]
                     ]*/
                }]
            });

        });
    /**
     * Images
     */
    function popupSetImages(id, imgContainer) {
        $.ajax({
            url: 'http://smtp.icimod.org/girc/dmis/api/tbi/buildings',
            //url: 'http://118.91.160.230/girc/dmis/api/rapid_assessment/report-items/'+id+'/galleries',
            data: {
                expand: 'galleryImages',
                id: id
            },
            cache: true,
            success: function (heritages) {
                if (heritages) {
                    $.each(heritages, function (index_heritage, heritage) {
                        if (heritage.galleryImages) {
                            var photoData = [];
                            $.each(heritage.galleryImages, function (index_gallery, galleryImage) {
                                var src = galleryImage.route + '/' + galleryImage.ownerId + '/' + galleryImage.id + '/' + 'preview' + '.' + galleryImage.extension;
                                var alt = "loading..";
                                var caption = "caption";
                                photoData.push(
                                {"src":src,"alt":alt,"caption":caption}
                                );
                             //   console.log(src);
                            });
                        makePhotoCarousel(photoData,'http://smtp.icimod.org/girc/dmis');
                        }
                    });
                }
            }
        });
    }
/**
 * Photo
 */
 function makePhotoCarousel(photoData, webRoot) {
    var webRoot = (webRoot) ? webRoot : 'http://smtp.icimod.org/girc/dmis';
    var indicators =[];
    var items = [];

    $.each(photoData, function (index, photo) {
        var indicator =[];
        var item = [];
        indicator["data-target"]= "#carousel-example-generic";
        indicator["data-slide-to"]=index;
        item["src"]=webRoot+'/'+photo.src;
        item["alt"]=photo.alt;
        item["caption"]=photo.caption;

        if (index == 0) {
                indicator["class"]="active";
                item["class"]="item active";
            } else {
            indicator["class"]="";
            item["class"]="item";
        }

        indicators.push(indicator);
        items.push(item);

    });

    var templateData={"indicators":indicators,"items":items};
    /**
     *
     * @type {*|jQuery}
     * Mustache
     */

    /*var templateData = {
        "indicators":[
            {
                "data-target": "#carousel-example-generic",
                "data-slide-to":"0",
                "class":""
            },
            {
                "data-target": "#carousel-example-generic",
                "data-slide-to":"1",
                "class":""
            },
            {
                "data-target": "#carousel-example-generic",
                "data-slide-to":"2",
                "class":"active"
            }
        ],
        "items":[
            {
                "class":"item active",
                "src":"http://placehold.it/900x500/39CCCC/ffffff&text=I+Love+Bootstrap",
                "alt":"",
                "caption":"First "
            },
            {
                "class":"item",
                "src":"http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap",
                "alt":"",
                "caption":"Second"
            },
            {
                "class":"item",
                "src":"http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap",
                "alt":"",
                "caption":"Third"
            }
        ]
    };*/
//console.log(templateData);
    var template = $('#template').html();
    Mustache.parse(template);   // optional, speeds up future uses
    var rendered = Mustache.render(template,
        templateData
    );
    //$('#mapPhotosBody').html(rendered);
    $('#mapDetailBody').html(rendered);
}

    <?php $this->endBlock();?>
    <?php $this->registerJs($this->blocks['map-posReady'],$this::POS_READY);?>
</script>

<script id="template" type="x-tmpl-mustache">

                <div id="afterPhotos" class="box-body grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "columWidth": 200 }'>
                  {{#items}}
                      <img class="grid-item" src="{{src}}" alt="{{alt}}">
                  {{/items}}
                 </div>

</script>
