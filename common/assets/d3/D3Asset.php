<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/18/2015
 * Time: 7:21 AM
 */

namespace common\assets\d3;


use yii\web\AssetBundle;

class D3Asset extends AssetBundle{
    public $sourcePath = '@common/assets/d3';
    public $css = [

    ];
    public $js = [
        'js/d3.min.js',
    ];
    public $depends = [
    ];
}
