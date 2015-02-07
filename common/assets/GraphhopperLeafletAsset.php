<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 8:44 PM
 */

namespace common\assets;


use yii\web\AssetBundle;

class GraphhopperLeafletAsset extends AssetBundle {
    public $sourcePath = '@common/asset-files/graphhopper';
    public $css = [
        'css/leaflet.css?v=0.7.3',
        'css/leaflet.contextmenu.css',
        'css/Leaflet.Elevation-0.0.2.css',
        'css/leaflet.loading.css',
        'css/style.css',
    ];
    public $js = [
        'js/leaflet.js?v=0.7.3',
        'js/leaflet.loading.js',
        'js/d3.min.js',
        'js/Leaflet.Elevation-0.0.2.min.js',
        'js/leaflet.contextmenu.js',
        'js/jquery-2.1.0.min.js',
        'js/jquery-ui-1.10.4.custom.min.js',
        'js/jquery.history.js',
        'js/jquery.autocomplete.js',
        'js/ghrequest.js?v=0.4.4',
        'js/main.js?v=0.4.4'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}