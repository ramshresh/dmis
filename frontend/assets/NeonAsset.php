<?php
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Ram Shrestha <sendmail4ram@gmail.com>
 * @since 2.0
 */
class NeonAsset extends AssetBundle
{
    public $basePath = '@webroot/lib/neon';
    public $baseUrl = '@web/lib/neon';
    public $css = [
        'css/neon.css',
        'css/neon-core.css',
        'css/neon-theme.css',
        'css/neon-forms.css',
    ];
    public $js = [
        'js/neon-api.js',
        'js/neon-chat.js',
        'js/neon-custom.js',
        'js/neon-demo.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\YiiAsset',
    ];
}
