<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/1/15
 * Time: 12:48 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\ReportItem */
/* @var $form yii\widgets\ActiveForm */
$this->registerAssetBundle(\common\assets\Ol3Asset::className(), $this::POS_END);
$this->registerAssetBundle(\common\assets\Ol3LayerSwitcherAsset::className(), $this::POS_END);
?>
<?php
$css = <<<CSS
#map {
            width: 100%;
            height: 300px;
            border: solid;
            border-color:#000033 ;
        }
        .ol-attribution ul,
        .ol-attribution a,
        .ol-attribution a:not([ie8andbelow]) {
            color: black !important;
        }
        .legend {
            position: absolute;
            z-index: 1;
            top: 100px;
            right: 50px;
            opacity: 1;
        }

    /*    html, body {
            height: 100%;
            padding: 0;
            margin: 0;
            font-family: sans-serif;
            font-size: small;
        }

        #map {
            width: 100%;
            height: 100%;
        }
       */

        .layer-switcher button {
            background-color:rgba(0, 60, 136, 0.5);
            /*background-image: url("");*/
            /*background-position: 2px center;*/
            background-repeat: no-repeat;
            border: medium none;
            float: right;
            height: 25px;
            width: 25px;
        }
CSS;
$this->registerCss($css);

?>

<?php
$js = <<<JS
(function($){
    var sld = '<StyledLayerDescriptor version="1.0.0" xsi:schemaLocation="http://www.opengis.net/sld StyledLayerDescriptor.xsd"><NamedLayer><Name>Point as graphic</Name><UserStyle><Title>GeoServer SLD Cook Book: Point as graphic</Title><FeatureTypeStyle><Rule><PointSymbolizer><Graphic><ExternalGraphic><OnlineResource xlink:type="simple" xlink:href="smileyface.png"/><Format>image/png</Format></ExternalGraphic><Size>32</Size></Graphic></PointSymbolizer></Rule></FeatureTypeStyle></UserStyle></NamedLayer></StyledLayerDescriptor>';

        var raster = new ol.layer.Tile({
            title:'Stamen',
            type: 'base',
            source: new ol.source.Stamen({ //Stamen, layer:'toner'
                layer: 'toner'
            })
        });

        // create a vector layer used for editing
        var vector_layer = new ol.layer.Vector({
            title:'vector',
            name: 'my_vectorlayer',
            source: new ol.source.Vector({
                projection: 'EPSG:4326'
            }),
            style: new ol.style.Style({
                fill: new ol.style.Fill({
                    color: 'rgba(255, 255, 255, 0.2)'
                }),
                stroke: new ol.style.Stroke({
                    color: '#ffcc33',
                    width: 2
                }),
                image: new ol.style.Circle({
                    radius: 7,
                    fill: new ol.style.Fill({
                        color: '#ffcc33'
                    })
                })
            })
        });

        var osm = new ol.layer.Tile({
            title:'OSM',
            type:'base',
               source: new ol.source.OSM()
         });

        var world_map = new ol.layer.Tile({
            tile:'world map',
            type:'base',
            source: new ol.source.TileJSON({
                url: 'http://api.tiles.mapbox.com/v3/mapbox.geography-class.jsonp'
            })
        });

        var tile_wms =
                new ol.layer.Tile({
                    title:'tile wms',
                    name: 'tiled layer',
                    type:'overlay',
          //  extent: [-13884991, 2870341, -7455066, 6338219],
            source: new ol.source.TileWMS(/** @type {olx.source.TileWMSOptions} */ ({
                url: 'http://localhost:8080/geoserver/disaster/wms',
                params: {'LAYERS': 'disaster:hazard0', 'TILED': true,'cql_filter':"subcategory='trapped'",
                //    'STYLES':null,
                    'SLD' :'styles/parpoint.sld.xml'
                },
                //styles:"",
                serverType: 'geoserver',
                request:'GetMap'

            }))
        });
     //   tile_wms.mergeNewParams({SLD :'http://localhost/ol3_testing/styles/parpoint.sld.xml' });
       // tile_wms.updateParams({'cql_filter':"subcategory='death'" });

        // Create a group for overlays. Add the group to the map when it's created
        // but add the overlay layers later
        var overlayGroup = new ol.layer.Group({
            title: 'Overlays',
            layers: [
            ]
        });

        function init() {
            // Create a map
                var map = new ol.Map({
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
                            layers: [raster,osm ]
                        }),
                        overlayGroup
                    ],
                view: new ol.View({
                //    projection:'EPSG:3857',
					zoom: 3,
                    center: ol.proj.transform([85,27], 'EPSG:4326', 'EPSG:3857')
                }),
                controls: ol.control.defaults().extend([
                    new ol.control.ScaleLine(
                        //{ target:document.getElementById("zoom")}
                    ),
                    new ol.control.FullScreen(),
                    new ol.control.LayerSwitcher(),
                    new ol.control.ZoomSlider()
				//	new ol.control.MousePosition()
                ])
            });

//            // Create a LayerSwitcher instance and add it to the map
//            var layerSwitcher = new ol.control.LayerSwitcher();
//            map.addControl(layerSwitcher);

            overlayGroup.getLayers().push(vector_layer);
            overlayGroup.getLayers().push(tile_wms);
         //   tile_wms.getSource().updateParams({'STYLES':undefined,'SLD' :'http://localhost/ol3_testing/styles/hazard.xml' });

            // make interactions global so they can later be removed
            var select_interaction,
                draw_interaction,
                modify_interaction;

            // get the interaction type
            var interaction_type = $('[name="interaction_type"]');
            // rebuild interaction when changed
            interaction_type.on('click', function(e) {
                // add new interaction
                if (this.value === 'draw') {
                    addDrawInteraction();
                } else if (this.value === 'modify') {
                    addModifyInteraction();
                } else {
                    map.removeInteraction(draw_interaction);
                    map.removeInteraction(modify_interaction);
                }
            });
            // get data type to save in
            data_type = $('#data_type');

            // build up modify interaction
            // needs a select and a modify interaction working together
            function addModifyInteraction() {
                // remove draw interaction
                map.removeInteraction(draw_interaction);
                // create select interaction
                select_interaction = new ol.interaction.Select({
                    // make sure only the desired layer can be selected
                    layers: function(vector_layer) {
                        return vector_layer.get('name') === 'my_vectorlayer';
                    }
                });
                map.addInteraction(select_interaction);

                // grab the features from the select interaction to use in the modify interaction
                var selected_features = select_interaction.getFeatures();
                // when a feature is selected...
                selected_features.on('add', function(event) {
                    // grab the feature
                    var feature = event.element;
                    // ...listen for changes and save them
                    feature.on('change', saveData);
                    // listen to pressing of delete key, then delete selected features
                    $(document).on('keyup', function(event) {
                        if (event.keyCode == 46) {
                            // remove all selected features from select_interaction and my_vectorlayer
                            selected_features.forEach(function(selected_feature) {
                                var selected_feature_id = selected_feature.getId();
                                // remove from select_interaction
                                selected_features.remove(selected_feature);
                                // features aus vectorlayer entfernen
                                var vectorlayer_features = vector_layer.getSource().getFeatures();
                                vectorlayer_features.forEach(function(source_feature) {
                                    var source_feature_id = source_feature.getId();
                                    if (source_feature_id === selected_feature_id) {
                                        // remove from my_vectorlayer
                                        vector_layer.getSource().removeFeature(source_feature);
                                        // save the changed data
                                        saveData();
                                    }
                                });
                            });
                            // remove listener
                            $(document).off('keyup');
                        }
                    });
                });
                // create the modify interaction
                modify_interaction = new ol.interaction.Modify({
                    features: selected_features,
                    // delete vertices by pressing the SHIFT key
                    deleteCondition: function(event) {
                        return ol.events.condition.shiftKeyOnly(event) &&
                            ol.events.condition.singleClick(event);
                    }
                });
                // add it to the map
                map.addInteraction(modify_interaction);
            }

            // creates a draw interaction
            function addDrawInteraction() {
                // remove other interactions
                map.removeInteraction(select_interaction);
                map.removeInteraction(modify_interaction);

                // create the interaction
                draw_interaction = new ol.interaction.Draw({
                    source: vector_layer.getSource(),
                    type: "Polygon" /** @type {ol.geom.GeometryType} */ // (geom_type.val())
                });
                // add it to the map
                map.addInteraction(draw_interaction);

                // when a new feature has been drawn...
                draw_interaction.on('drawend', function(event) {
                    // create a unique id
                    // it is later needed to delete features
                    var id = uid();
                    // give the feature this id
                    event.feature.setId(id);
                    // save the changed data
                    saveData();
                });
            }

            // add the draw interaction when the page is first shown
            //addDrawInteraction();

            // shows data in textarea
            // replace this function by what you need
            var wkt_polygon;

            function saveData() {
                // define a format the data shall be converted to
                var format = new ol.format.WKT();
                // this will be the data in the chosen format
                var data;

                try {
                    // convert the data of the vector_layer into the chosen format
				var vectorSource = vector_layer.getSource();
                   var features = [];
					  vectorSource.forEachFeature(function(feature) {
						var clone = feature.clone();
						clone.setId(feature.getId());  // clone does not set the id
						clone.getGeometry().transform('EPSG:3857', 'EPSG:4326');
						features.push(clone);
					  });
					  if(features.length===1){
						//feature[0]
					  }
					 //update feature i.e write only single feature
					  var string = format.writeFeatures(features);
					 	 wkt_polygon =string;
						// console.log(string);

				/*
					data = format.writeFeatures(vector_layer.getSource().getFeatures());
				var feature =  new ol.format.WKT().readFeature(data);
				feat_epsg4326=feature.getGeometry().transform('EPSG:3857', 'EPSG:4326');
			//	new ol.format.WKT().writeFeature(feat_epsg4326)
				//	 wkt_polygon =feat_epsg4326;
					 console.log(data);
				*/
                } catch (e) {
                    // at time of creation there is an error in the GPX format (18.7.2014)
                    $('#data').val(e.name + ": " + e.message);
                    return;
                }
            }

            // clear map when user clicks on 'Delete all features'
            $("#delete").click(function() {
                clearMap();
            });

            // clears the map and the output of the data
            function clearMap() {
                vector_layer.getSource().clear();
                if (select_interaction) {
                    select_interaction.getFeatures().clear();
                }
            }

            // creates unique id's
            function uid() {
                var id = 0;
                return function() {
                    if (arguments[0] === 0) {
                        id = 0;
                    }
                    return id++;
                }
            }

            map.on('click', function(evt) {
                var coordinate = evt.coordinate;
                // var hdms = ol.coordinate.toStringHDMS(ol.proj.transform(
                //    coordinate, 'EPSG:3857', 'EPSG:4326'));
                //var decimal =  ol.coordinate.toStringXY(coordinate, 4);
                var decimal = ol.coordinate.toStringXY(ol.proj.transform(
                    coordinate, 'EPSG:3857', 'EPSG:4326'), 4);
//alert(decimal);




            });

            function queryDatabase(e) {
                var url = "query/click_query.php";
                url += "?polygon=" + wkt_polygon;

                $.ajax({
                    type: "GET",
                    url: url
                })
                    .done(function(data) {
                        $('#test').html(data);
                    });

            };


            $("#analyse").click(function() {
                queryDatabase();

            });
        }

        init();
})(jQuery);
JS;
$this->registerJs($js,$this::POS_READY);
?>
<div id="map" class="map"></div>
<div>
    <label>Interaction type: &nbsp;</label>
    <label>draw</label>
    <input type="radio" id="interaction_type_draw" name="interaction_type" value="draw">
    <label>modify</label>
    <input type="radio" id="interaction_type_modify" name="interaction_type" value="modify">
    <label>pan</label>
    <input type="radio" id="interaction_type_disable" name="interaction_type" value="disable" checked>
</div>
<button id="delete">Delete</button>
<button id="analyse">Analyse</button>
<div id="test"></div>

<div class="event-report-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?php
            // Parent
            echo $form->field($reportItem, 'item_name')
                ->dropDownList($dropDownItemName,
                    ['id' => 'item_name', 'maxlength' => 25, 'prompt' => '--Select Event Name--']);
            ?>
        </div>
        <div class="col-md-6">
            <?php
            // Child # 1
            echo $form->field($reportItem, 'subtype_name')->widget(\kartik\depdrop\DepDrop::classname(), [
                'options' => ['id' => 'subtype_name'],
                'pluginOptions' => [
                    'depends' => ['item_name'],
                    'placeholder' => '--Select Event Sub-Type--',
                    'url' => \yii\helpers\Url::to(['/reporting/event-report/item-sub-type'])
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($reportItem, 'title')->textInput(['maxlength' => 75,]) ?>
            <?php echo $form->field($event, 'duration')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($reportItem, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <?php //$form->field($reportItem, 'tags')->textInput() ?>

    <?php //$form->field($reportItem, 'meta_hstore')->textInput() ?>

    <?php //$form->field($reportItem, 'meta_json')->textInput() ?>

    <?php // echo $form->field($event, 'timestamp_occurance')->textInput() ?>

    <?php
    echo $form->field($event, 'timestamp_occurance')->widget(\kartik\widgets\DateTimePicker::className(),
        [
            'options' => ['placeholder' => 'Enter event time ...'],
            'convertFormat' => true,
            'pluginOptions' => [
                'todayHighlight' => true,
                'todayBtn' => true,
                'format' => 'yyyy-dd-mm h:i:s',
                'autoclose' => true,
            ]
        ]);
    ?>
    <?php // echo$form->field($event, 'status')->textInput() ?>
    <?php
    echo $form->field($reportItem, 'tags')->widget(\kartik\widgets\Select2::className(),
        [
            'options' => ['placeholder' => 'tags'],
            'pluginOptions' => [
                'tags' => ["earthquake", "event", "damage", "incident", "need",],
                'maximumInputLength' => 10
            ],
        ]);

    ?>

    <div class="form-group">
        <?= Html::submitButton($reportItem->isNewRecord || $event->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $reportItem->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

