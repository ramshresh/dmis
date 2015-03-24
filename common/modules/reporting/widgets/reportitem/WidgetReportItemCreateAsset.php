<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\modules\reporting\widgets\reportitem;
use yii\web\AssetBundle;

class WidgetReportItemCreateAsset extends  AssetBundle{
    public $sourcePath = '@common/modules/reporting/widgets/reportitem/assets';
    public $css = [
        'test.css',
    ];
    public $js = [
        'test.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapAsset',
        'common\assets\Ol3Asset',
    ];
}