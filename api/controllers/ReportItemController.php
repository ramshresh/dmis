<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/22/15
 * Time: 9:42 AM
 */

namespace api\controllers;


class ReportItemController extends \yii\rest\ActiveController
{
    public $modelClass = 'api\common\models\ReportItem';
    public function init(){
        parent::init();
        header("Access-Control-Allow-Origin: *");
    }
}