<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/24/2015
 * Time: 12:18 PM
 *
 */

namespace common\modules\reporting\widgets\event;



use yii\base\Exception;
use yii\base\Widget;
use yii\helpers\Json;
use yii\web\View;

class TabularInput extends Widget
{
    /**
     * @var $models \common\modules\reporting\models\Event[]
     */
    public $model;
    public $models;
    public $widgetId;
    public $clientOptions;


    public function  init()
    {
        if(!$this->model){
            throw new Exception('property $model must be defined!');
        }

        if(!$this->models){
            $this->models=$this->model->events;
        }


        $this->widgetId=($this->widgetId)?$this->widgetId:$this->id;

        $this->clientOptions['widgetId']=$this->widgetId;
        $this->clientOptions = Json::encode($this->clientOptions);

        $this->registerClientScripts();
    }

    public function run()
    {
        return $this->render('tabular-input',
            [
                'models'=>$this->models,
                'widgetId'=>$this->widgetId,
            ]);

    }
    public function registerClientScripts(){
        \common\assets\YiiAjaxFormTabularInputAsset::register($this->getView());
        $this->getView()->registerJs("$('#$this->widgetId').yiiAjaxFormTabularInputWidget($this->clientOptions);", View::POS_READY);
    }
}