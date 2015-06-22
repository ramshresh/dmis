<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets\leaflet_easyPrint;

use yii\web\AssetBundle;

class LeafletEasyPrintAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/leaflet_easyPrint';
    public $css = [
        'css/easyPrint.css',
    ];
    public $js = [
        'js/leaflet.easyPrint.js',
    ];
    public $depends = [
        'common\assets\jquery_print\JqueryPrintAsset'
    ];
}