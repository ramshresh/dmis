<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class JqueryBlueimpGalleryAsset extends AssetBundle
{
    public $sourcePath = '@common/asset-files/jquery-blueimp-gallery';
    public $css = [
        'css/blueimp-gallery.min.css',
    ];
    public $js = [
        'js/jquery.blueimp-gallery.min.js'
    ];
    public $depends=[
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset'
    ];
}