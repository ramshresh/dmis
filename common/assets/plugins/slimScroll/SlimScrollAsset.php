<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets\plugins\slimScroll;

use yii\web\AssetBundle;

class SlimScrollAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/plugins/fastclick';
    public $css = [

    ];
    public $js = [
        'jquery.slimscroll.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}