<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/5/15
 * Time: 2:15 AM
 */
use \yii\helpers\Html;
?>
<blockquote>PointPicker Widget</blockquote>

<button id="triggerpointpicker-modalmap">Point Picker - Modal Map</button>
<!--<button id="triggerpointpicker-externalmap">Point Picker - External Map</button>-->

<input id="latitude" type="text" placeholder="latitude">
<input id="longitude" type="text" placeholder="longitude">
<input id="placename" type="text" placeholder="placename">


<?php

echo \common\modules\reporting\widgets\pointpicker\PointPickerWidget::widget(
    [
        'latitudeId' => 'latitude',
        'longitudeId' => 'longitude',
        'placenameId' => 'placename',
        //'openlayersPackName' => 'openlayers', //'openlayerslPack' //,
        'triggerId'=>'triggerpointpicker-modalmap',
        //'externalMapDivId'=>'map',
        ]);
?>


