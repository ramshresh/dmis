<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class Ol3LayerSwitcherAsset extends AssetBundle
{
    public $sourcePath = '@common/asset-files/openlayers/ol3';
    public $css = [
        'lib/css/ol3-layerswitcher.css',
    ];
    public $js = [
        'lib/js/ol3-layerswitcher.js',
    ];
    public $depends = [
        'common\assets\Ol3Asset',
    ];

}