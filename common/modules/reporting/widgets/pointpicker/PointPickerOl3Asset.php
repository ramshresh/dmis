<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\modules\reporting\widgets\pointpicker;


use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PointPickerOl3Asset extends AssetBundle
{
    public $sourcePath = '@common/modules/reporting/widgets/pointpicker/assets';

    public $css = [
        'css/ol3-point-picker.css',
        'css/jui-point-picker-with-ol3.css',
    ];
    public $js = [
        'js/html5-geolocation.js',
        'js/ol3-point-picker.js',
        'js/jui-point-picker-with-ol3.js',
        'js/pointpicker-ol3-map.js'
    ];
    public $depends = [
       'common\assets\MustacheAsset',
    ];
}
