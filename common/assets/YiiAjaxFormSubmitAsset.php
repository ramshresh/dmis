<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class YiiAjaxFormSubmitAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/yii-ajax-form-submit';

    public $js = [
        'js/yii-ajax-form-submit-widget.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}