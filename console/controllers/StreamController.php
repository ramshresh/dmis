<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/14/2015
 * Time: 12:48 AM
 */

namespace console\controllers;


use yii\console\Controller;

class StreamController extends Controller{
    public function actionIndex()
    {/* @var $stream \richweber\twitter\streaming\lib\Stream*/
        $stream =\Yii::$app->stream;
        $stream->consume();
    }
}