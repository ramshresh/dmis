<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/22/15
 * Time: 9:42 AM
 */

namespace api\controllers;



class DriverController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\modules\tracking\models\Driver';
    public function init(){
        parent::init();
        header("Access-Control-Allow-Origin: *");
    }
    public function actions(){
        return array_merge(parent::actions(), [
            'registration' => [
                'class' => 'common\modules\tracking\actions\rest\DriverRegistrationAction',            ]
        ]);
    }
}