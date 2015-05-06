<?php
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Ram Shrestha <sendmail4ram@gmail.com>
 * @since 2.0
 */
class GsapAsset extends AssetBundle
{
    public $basePath = '@webroot/lib/gsap';
    public $baseUrl = '@web/lib/gsap';
    public $css = [

    ];
    public $js = [
        'main-gsap.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\YiiAsset',
    ];
}
