<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets\pointpicker_ol2;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PointPickerAsset extends AssetBundle
{
    public $sourcePath = '@common/widgets/pointpicker_ol2/assets';

    public $css = [

    ];
    public $js = [
        'js/html5-geolocation.js',
        'js/pointpicker-openlayers-map.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset',
    ];
}
