<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/6/15
 * Time: 12:57 AM
 */

/**
 * @var $this yii\web\View
 */
\common\assets\Ol3Asset::register($this,$this::POS_END);
\frontend\assets\DemoGeo_Ol3MapSimpleAsset::register($this,$this::POS_READY);
?>
<div id="map" class="map"></div>
<input type="text" id="ilat" />
<input type="text" id="ilon" />
<input type="text" id="iplacename" />
<div id="marker"></div>

