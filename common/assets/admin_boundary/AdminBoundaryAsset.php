<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets\admin_boundary;

use yii\web\AssetBundle;

class AdminBoundaryAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/admin_boundary';
    public $js = [
        'js/adminExtents.js'
    ];
}