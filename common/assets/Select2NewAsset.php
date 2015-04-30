<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets;


use yii\web\AssetBundle;


class Select2NewAsset extends AssetBundle
{
    public $sourcePath = '@common/asset-files/select2';
    public $css = [
        'select2.min.css',
    ];
    public $js = [
        'select2.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}