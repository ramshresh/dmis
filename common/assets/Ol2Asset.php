<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class Ol2Asset extends AssetBundle
{
    public $sourcePath = '@common/asset-files/openlayers/ol2';
    public $css = [
        'green_theme/style.css',
    ];
    public $js = [
        'lib/OpenLayers.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}