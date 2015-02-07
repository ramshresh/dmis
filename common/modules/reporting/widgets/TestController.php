<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/3/15
 * Time: 4:09 AM
 */

namespace common\modules\user\widgets;


use yii\rest\Controller;

class TestController extends Controller{
public function actionIndex(){
    return [1,2,3];
}
}