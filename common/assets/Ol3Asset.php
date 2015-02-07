<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class Ol3Asset extends AssetBundle{
    public $sourcePath = '@common/asset-files/openlayers/ol3';
    public $css = [
        'ol.css',
    ];
    public $js = [
        'ol.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}