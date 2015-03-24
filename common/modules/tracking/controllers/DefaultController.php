<?php

namespace common\modules\tracking\controllers;

use common\modules\tracking\models\Coordinate;
use common\modules\tracking\models\Driver;
use common\modules\tracking\models\Location;
use common\modules\tracking\models\search\Status;
use yii\helpers\Json;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionTest(){
        $driver = new Driver();
        echo '<br><h5>Driver</h5><br>';
        echo Json::encode($driver->attributes);

        $coordinate = new Coordinate();
        echo '<br><h5>Coordinate</h5><br>';
        echo Json::encode($coordinate->attributes);

        $location = new Location();
        echo '<br><h5>Location</h5><br>';
        echo Json::encode($location->attributes);

        $status = new Status();
        echo '<br><h5>Status</h5><br>';
        echo Json::encode($status->attributes);
    }
}
