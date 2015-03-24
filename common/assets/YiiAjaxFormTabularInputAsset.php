<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class YiiAjaxFormTabularInputAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/yii-ajax-form-tabular-input';

    public $js = [
        'js/yii-ajax-form-tabular-input-widget.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}