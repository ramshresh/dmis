<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class PlaceAutocompleteAsset extends AssetBundle
{
    public $sourcePath = '@common/asset-files/place-autocomplete';

    public $js = [
        'ol3-place-autocomplete.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapAsset',
        'common\assets\Ol3Asset',
    ];
}