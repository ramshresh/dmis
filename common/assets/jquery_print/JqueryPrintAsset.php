<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/18/2015
 * Time: 7:27 AM
 */

namespace common\assets\jquery_print;

use yii\web\AssetBundle;

class JqueryPrintAsset extends AssetBundle {
    public $sourcePath = '@common/assets/jquery_print';
    public $css = [

    ];
    public $js = [
        'js/jQuery.print.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}