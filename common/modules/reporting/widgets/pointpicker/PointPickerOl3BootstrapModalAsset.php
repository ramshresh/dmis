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
class PointPickerOl3BootstrapModalAsset extends AssetBundle
{
    public $sourcePath = '@common/modules/reporting/widgets/pointpicker/assets';

    public $css = [

    ];
    public $js = [
        'js/html5-geolocation.js',
        'js/pointpicker-ol3-bootstrap-modal-map.js'
    ];
    public $depends = [
    ];

}
