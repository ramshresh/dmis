<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use common\assets\Ol3Asset;
use yii\bootstrap\Widget;

class Ol3Map extends Widget
{
    public $mapDivId;

    public function init()
    {
        parent::init();
        Ol3Asset::register($this->getView());
    }

    public function run(){

    }
}
