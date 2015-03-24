<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/25/2015
 * Time: 7:39 AM
 */

namespace common\modules\reporting\widgets\reportitem;



use yii\web\Controller;

class WidgetEventController extends Controller{
    public function actions(){
        return [
            'create'=>[
                'class'=>'common\modules\reporting\actions\EventCreateAction',
            ],
        ];
    }
}