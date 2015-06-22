<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 *
 * @ref: http://vadimg.com/twitter-bootstrap-wizard-example/examples/basic-tabsleft.html
 */

namespace common\assets\bootstrap_vertical_tabs;
use yii\web\AssetBundle;

class BootstrapVerticalTabsAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/bootstrap_vertical_tabs';
    public $css = [
        'css/bootstrap.vertical-tabs.min.css',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}