<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/31/15
 * Time: 9:28 PM
 */

namespace api\modules\reporting\controllers;


use yii\data\ActiveDataProvider;
use yii\web\Response;

class ItemTypeController extends \yii\rest\ActiveController
{
    public $modelClass = 'api\common\models\ItemType';
    public function init(){header("Access-Control-Allow-Origin: *");}


}