<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class MustacheAsset extends AssetBundle
{
    public $sourcePath = '@common/asset-files/mustache';
    public $css = [

    ];
    public $js = [
        'mustache.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}