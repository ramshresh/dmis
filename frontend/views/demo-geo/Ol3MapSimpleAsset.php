<?php

use yii\web\AssetBundle;

/**
 * Asset bundle for Openlayers 3 simple map
 *
 * @author Ram Shrestha <sendmail4ram@gmail.com>
 */
class Ol3MapSimpleAsset extends AssetBundle
{
    public function init(){
        $this->sourcePath=__DIR__ . '/assets';
        $this->css= ['css/ol3-map-simple.css'];
        $this->js=['js/ol3-map-simple.js'];
        parent::init();
    }

}
