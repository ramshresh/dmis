<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/31/15
 * Time: 9:28 PM
 */

namespace api\modules\reporting\controllers;


use yii\data\ActiveDataProvider;

class ItemChildController extends \yii\rest\ActiveController
{
    public $modelClass = 'api\common\models\ItemChild';
    public function init(){header("Access-Control-Allow-Origin: *");}
}