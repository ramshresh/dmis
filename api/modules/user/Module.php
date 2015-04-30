<?php

namespace api\modules\user;

class Module extends \common\modules\user\Module
{
    public $controllerNamespace = 'api\modules\user\controllers';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
