<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class IconsReportingAsset extends AssetBundle
{
    public $sourcePath = '@common/asset-files/icons-reporting';
    public $css = [
        'disaster_icons.css',
    ];
}