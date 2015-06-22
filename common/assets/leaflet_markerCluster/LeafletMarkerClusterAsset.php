<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/24/15
 * Time: 7:08 PM
 */

namespace common\assets\leaflet_markerCluster;

use yii\web\AssetBundle;

class LeafletMarkerClusterAsset extends AssetBundle
{
    public $sourcePath = '@common/assets/leaflet_markerCluster';
    public $css = [
        'css/MarkerCluster.css',
    ];
    public $js = [
        'js/leaflet.markercluster.js',
    ];
    public $depends = [
        'common\assets\leaflet\LeafletAsset',
    ];
}