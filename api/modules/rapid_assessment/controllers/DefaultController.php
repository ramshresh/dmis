<?php

namespace api\modules\rapid_assessment\controllers;

use yii\rest\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return [1,2,3];
    }
}
