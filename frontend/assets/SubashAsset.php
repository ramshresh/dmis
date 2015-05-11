<?php
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Ram Shrestha <sendmail4ram@gmail.com>
 */
class SubashAsset extends AssetBundle
{
    public $basePath = '@webroot/lib/subash';
    public $baseUrl = '@web/lib/subash';
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $css = [
        //"assets/css/bootstrap-custom.css",

        "assets/css/neon-core.css",
        "assets/css/neon-theme.css",
        "assets/css/neon-forms.css",

        "lib/disaster_icons.css",
        /*"lib/ol.css",
        "lib/ol3-layerswitcher.css",
        "lib/ol3-popup.css",*/
        "assets/js/select2/select2-bootstrap.css",
        "assets/js/select2/select2.css",
        "assets/js/selectboxit/jquery.selectBoxIt.css",
        "assets/js/daterangepicker/daterangepicker-bs3.css",
        "assets/js/icheck/skins/minimal/_all.css",
        "assets/js/icheck/skins/square/_all.css",
        "assets/js/icheck/skins/flat/_all.css",
        "assets/js/icheck/skins/futurico/futurico.css",
        "assets/js/icheck/skins/polaris/polaris.css",


        //"assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css",
        "assets/css/font-icons/entypo/css/entypo.css",
        //"assets/css/font-icons/entypo/css/entypo.css",
        "http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic",
        "assets/css/font-icons/font-awesome/css/font-awesome.min.css",

        "assets/css/custom.css",
        "assets/css/style.css",
    ];
    public $js = [
        //"assets/js/bootstrap.js",
        //"lib/ol-debug.js",
        //"lib/ol3-layerswitcher.js",
        //"lib/js/jquery.js",

        //"lib/ol3-popup.js",
        //"assets/js/jquery-1.11.0.min.js",
        "assets/js/gsap/main-gsap.js",
        "assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js",

        "assets/js/joinable.js",
        "assets/js/resizeable.js",
        "assets/js/neon-api.js",
        //"assets/js/select2/select2.min.js",
        //"assets/js/bootstrap-tagsinput.min.js",
        //"assets/js/typeahead.min.js",
        "assets/js/selectboxit/jquery.selectBoxIt.min.js",

        "assets/js/bootstrap-datepicker.js",

        //"assets/js/bootstrap-timepicker.min.js",
        //"assets/js/bootstrap-colorpicker.min.js",
        //"assets/js/daterangepicker/moment.min.js",
        //"assets/js/daterangepicker/daterangepicker.js",
       // "assets/js/jquery.multi-select.js",
        //"assets/js/icheck/icheck.min.js",
        "assets/js/neon-chat.js",
        "assets/js/neon-custom.js",
        //"assets/js/neon-demo.js",
    ];
    public $depends = [
        "yii\web\JqueryAsset",
        "yii\bootstrap\BootstrapAsset",
        "yii\bootstrap\BootstrapPluginAsset",
//       / "frontend\assets\AppAsset",
        //"yii\web\YiiAsset",
    ];
}
