<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets\icons\ionicons;

use yii\web\AssetBundle;

class IonIconsAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/icons/ionicons/asset-files';
    public $css = [
        'css/ionicons.min.css'
    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}