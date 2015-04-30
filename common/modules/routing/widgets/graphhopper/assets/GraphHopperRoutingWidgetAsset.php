<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/5/2015
 * Time: 2:40 PM
 */

namespace common\modules\routing\widgets\graphhopper\assets;


use yii\web\AssetBundle;

class GraphHopperRoutingWidgetAsset extends AssetBundle{

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->sourcePath=__DIR__."/routing_widget";
        $this->js=[
            'js/routing.js',
        ];
    }
}