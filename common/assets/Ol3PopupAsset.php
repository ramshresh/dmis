<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets;

use yii\web\AssetBundle;
class Ol3PopupAsset extends AssetBundle
{
    public $sourcePath = '@common/asset-files/openlayers/ol3-popup';
    public $css = [
        'css/ol3-popup.css',
    ];
    public $js = [
        'js/ol3-popup.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'common\assets\Ol3Asset',
    ];
}