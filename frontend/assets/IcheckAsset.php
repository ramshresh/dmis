<?php
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Ram Shrestha <sendmail4ram@gmail.com>
 * @since 2.0
 */
class IcheckAsset extends AssetBundle
{
    public $basePath = '@webroot/lib/icheck';
    public $baseUrl = '@web/lib/icheck';
    public $css = [
        'skins/minimal/_all.css',
        'skins/square/_all.css',
        'skins/flat/_all.css',
        'skins/futurico/futurico.css',
        'skins/polaris/polaris.css',
    ];
    public $js = [
        'icheck.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\YiiAsset',
    ];
}
