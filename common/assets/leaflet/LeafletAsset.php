<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets\leaflet;

use yii\web\AssetBundle;

class LeafletAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/leaflet';
    public $css = [
        'css/leaflet.css',
    ];
    public $js = [
        'js/leaflet.min.js',
    ];
    public $depends = [
    ];
}