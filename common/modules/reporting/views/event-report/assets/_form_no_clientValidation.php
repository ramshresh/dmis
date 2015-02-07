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
//$this->registerAssetBundle(\common\assets\Ol3Asset::className(), $this::POS_END);
//$this->registerAssetBundle(\common\assets\Ol3LayerSwitcherAsset::className(), $this::POS_END);
?>
<?php
/*$css = <<<CSS
        #map {
            width: 100%;
            height: 300px;
        }
        .ol-attribution ul,
        .ol-attribution a,
        .ol-attribution a:not([ie8andbelow]) {
            color: black !important;
        }
        #marker {
            width: 20px;
            height: 20px;
            border: 1px solid #088;
            border-radius: 10px;
            background-color: #0FF;
            opacity: 0.5;
        }
CSS;
$this->registerCss($css);*/
?>

<?php
/*$js = <<<JS
(function($){
    function init() {

            // Create a map
            map = new ol.Map({
                target: 'map',
                layers: [
                    new ol.layer.Tile({
                        source: new ol.source.OSM()
                    }),

                ],
                view: new ol.View({
                    zoom: 2,
                    center: [0, 0]
                }),
                controls: ol.control.defaults().extend([
                    new ol.control.ScaleLine(),
                    new ol.control.FullScreen(),
                    new ol.control.ZoomSlider()
                ])
            });




            var parseMapquestReverseGeocode = function(data) {
                var location = data.results[0].locations[0];
                var fullAddress = '';
                var comp = [];
                if (location.adminArea6) {
                    comp.push(location.adminArea6);
                }
                if (location.street) {
                    comp.push(location.street);
                }
                if (location.adminArea5) {
                    comp.push(location.adminArea5);
                }
                if (location.adminArea6) {
                    comp.push(location.adminArea4);
                }
                if (location.adminArea3) {
                    comp.push(location.adminArea3);
                }
                if (location.adminArea2) {
                    comp.push(location.adminArea2);
                }
                if (location.adminArea1) {
                    comp.push(location.adminArea1);
                }
                for (i = 0; i < comp.length; i++) {
                    if (i == 0) {
                        fullAddress += comp[i];
                    } else {
                        fullAddress += ',' + comp[i];
                    }
                }
                console.log(fullAddress);
                return {
                    status: 'OK',
                    fullAddress: fullAddress
                };
            };




            var reverseGeocode = function(lon, lat) {
                var self = this;
                var lat = lat;
                var lon = lon;
                ////http://www.mapquestapi.com/geocoding/v1/reverse?key=Fmjtd|luur20a729%2Cb0%3Do5-9a15qr&callback=renderReverse&location=27.7067577,85.3153407
                $.ajax(
                    'http://www.mapquestapi.com/geocoding/v1/reverse?', {
                        dataType: 'jsonp',
                        jsonpCallback: 'fnCallbackSuccess',
                        jsonp: 'callback',
                        data: {
                            key: 'Fmjtd|luur20a729%2Cb0%3Do5-9a15qr',
                            location: lat + ',' + lon
                        },

                        success: function(data) {
                            var fullAddress = parseMapquestReverseGeocode(data);
                            $("#iplacename").val(fullAddress.fullAddress);

                        },

                        error: function(jqXHR, textStatus, errorThrown) {
                            return {
                                status: 'OK',
                                fullAddress: '',
                                jqXHR: jqXHR
                            }

                        }
                    }
                )
            };

            var pickPointHandler = function(evt) {
                var temp_coor = evt.coordinate;
                var coordinate = ol.proj.transform(temp_coor, 'EPSG:3857', 'EPSG:4326');
                ilon = coordinate[0].toFixed(5);
                ilat = coordinate[1].toFixed(5);
                var style = new ol.style.Style({
                    symbolizers: [
                        new ol.style.Icon({
                            url: 'icons/activity_assessment_32px_icon.png'
                        })
                    ]
                });
                // Vienna marker
                var marker = new ol.Overlay({
                    position: temp_coor,
                    positioning: 'center-center',
                    element: document.getElementById('marker'),
                    stopEvent: false
                });
                map.addOverlay(marker);

                $("#ilon").val(ilon);
                $("#ilat").val(ilat);
                reverseGeocode(ilon, ilat);
            }

            map.on('click', pickPointHandler);

            //    var layerSwitcher = new ol.control.LayerSwitcher();
            //    map.addControl(layerSwitcher);
        }
        init();
})(jQuery);
JS;
$this->registerJs($js,$this::POS_READY);*/
?>
<!--<div id="map" class="map"></div>
<input type="text" id="ilat" />
<input type="text" id="ilon" />
<input type="text" id="iplacename" />
<div id="marker"></div>
-->


<div class="event-report-item-form">
    <?php $form = ActiveForm::begin([
        'id'=>'eventReportForm']
    ); ?>
    <div class="row">
        <?= $form->field($reportItem, 'item_name') ?>
        <!--<div class="col-md-6">
            <?php
/*            // Parent
            echo $form->field($reportItem, 'item_name')
                ->dropDownList($dropDownItemName,
                    ['id' => 'item_name', 'maxlength' => 25, 'prompt' => '--Select Event Name--']);
            */?>
        </div>
        <div class="col-md-6">
            <?php
/*            // Child # 1
            echo $form->field($reportItem, 'subtype_name')->widget(\kartik\depdrop\DepDrop::classname(), [
                'options' => ['id' => 'subtype_name'],
                'pluginOptions' => [
                    'depends' => ['item_name'],
                    'placeholder' => '--Select Event Sub-Type--',
                    'url' => \yii\helpers\Url::to(['/reporting/event-report/item-sub-type'])
                ]
            ]);
            */?>
        </div>-->
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
                'format' => 'yyyy-dd-MM h:i:s',
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

<?php
$loginFormJs = <<<JS
(function($){
//{{{
    /**
    * Enabling ajax submission
    * prevents normal submission of form by overriding on-submit event of form
    * prevents normal on-click event of <button type='submit'>
    */

    /**
    * Disabling form submission by yiiActiveForm by unbinding the 'submit.yiiActiveForm' event
    * @see line:196 of JavaScript widget used by the ActiveForm widget. which is:
    * line:196 | .on('submit.yiiActiveForm', methods.submitForm);
    */

    $('#eventReportForm').on('beforeSubmit', function () {
        var form=this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:$(form).serialize(),
                success:function(data){
                    data = JSON.parse(data);
                    if(data.status=='error'){
                        /*<data> must be as: by controller/action with following content. SiteController-actionLogin
                        {
                            "status":-1,
                            "msg":"Model validation error",
                            "errors":[{"password":"Incorrect username or password"}]
                        }
                        */
                        if(data.errors!=undefined){
                            errorsModels =data.errors;
                            for(var k=0;k<errorsModels.length;k++ ){
                                errors=errorsModels[k];
                                errKeys = Object.keys(errors);
                            yiiActiveForm=$(form).data('yiiActiveForm');
                            errAttr=[];

                            for(i=0;i<errKeys.length;i++){
                                for(j = 0;j<yiiActiveForm.attributes.length;j++){
                                    if(yiiActiveForm.attributes[j].name in errors){
                                        errAttr.push(
                                            {
                                            formAttribute:yiiActiveForm.attributes[j],
                                            errorMessage:errors[errKeys[i]]
                                            }
                                        );

                                    }
                                }
                            }


                            for(i = 0;i<errAttr.length;i++){
                                formAttribute = errAttr[i].formAttribute;
                                errorMessage = errAttr[i].errorMessage;

                                containerClass =formAttribute.container;
                                errorClass=formAttribute.error;
                                errSelector= containerClass+' '+errorClass;

                                $(errSelector).html(errorMessage);
                                $(containerClass).addClass(yiiActiveForm.settings.errorCssClass)
                            }
                            console.log(yiiActiveForm);
                            }
                        }
                    }
                    console.log('success')
                }
            })
            .done(function(result){
                console.log('done');
                console.log(result)
            })
            .fail(function(){
                console.log('failed');
                console.log('server error');
            });
        return false;
    });
//}}}
})(jQuery);
JS;
$this->registerJs($loginFormJs, $this::POS_READY);
?>
