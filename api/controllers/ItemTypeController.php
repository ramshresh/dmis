<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/31/15
 * Time: 9:28 PM
 */

namespace api\controllers;


use yii\data\ActiveDataProvider;
use yii\web\Response;

class ItemTypeController extends \yii\rest\ActiveController
{
    public $modelClass = 'api\common\models\ItemType';

    public function actions()
    {
        return array_merge(parent::actions(), [
            'create' => null, // Disable create
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider'],

            ]
        ]);
    }

   public function prepareDataProvider(){

       /* @var $modelClass \yii\db\BaseActiveRecord */
       $modelClass = $this->modelClass;

       $data=
           $modelClass::find()->all();


    //$data = [1,2];
       $callback=(\Yii::$app->request->get('callback'))?\Yii::$app->request->get('callback'):null;

       // retrieve data to be returned

       // set "fomat" property
       \Yii::$app->getResponse()->format =
           (is_null($callback)) ?
               Response::FORMAT_JSON :
               Response::FORMAT_JSONP;
       // return data
       return (is_null($callback)) ?
           $data :
           array(
               'data'     => $data,
               'callback' => $callback
           );
    }
    function actionJson(
        $callback = null
    ) {
        // retrieve data to be returned
        $data = [1,2];
        // set "fomat" property
        \Yii::$app->getResponse()->format =
            (is_null($callback)) ?
                Response::FORMAT_JSON :
                Response::FORMAT_JSONP;
        // return data
        return (is_null($callback)) ?
            $data :
            array(
                'data'     => $data,
                'callback' => $callback
            );
    }
}