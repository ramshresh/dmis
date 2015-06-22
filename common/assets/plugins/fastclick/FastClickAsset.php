<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets\plugins\fastclick;

use yii\web\AssetBundle;

class FastClickAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/plugins/fastclick';
    public $css = [

    ];
    public $js = [
        'fastclick.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}