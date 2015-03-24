<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/24/2015
 * Time: 12:18 PM
 */

namespace common\modules\reporting\widgets\need;


use common\modules\reporting\models\search\Need;
use yii\base\Exception;
use yii\base\Widget;
use yii\helpers\Json;
use yii\web\View;


class Create extends Widget
{
    public $actionRoute;
    public $model;
    public $mapDivId;
    public $widgetId;
    public $clientOptions;
    public $juiDialogOptions;
    public $jqToggleBtnSelector;
    public $formId;
    public $jQueryFormSelector;
    public function  init()
    {
        if(!$this->actionRoute){
            throw new Exception(
                    'route to the action to which the form to be submitted must be specified! Example :: /girc/dmis/frontend/web/site/event-create'
            );
        }
        $this->formId=($this->formId)?$this->formId:'formEventCreate';
        $this->jQueryFormSelector = '#'.$this->formId;
        $this->widgetId=($this->widgetId)?$this->widgetId:$this->id;

        $this->clientOptions['formId']=$this->formId;
        $this->clientOptions['actionRoute']=$this->actionRoute;
        $this->clientOptions['widgetId']=$this->widgetId;
        $this->clientOptions['jqToggleBtnSelector']=$this->jqToggleBtnSelector;
        $this->clientOptions = Json::encode($this->clientOptions);
        $this->registerClientScripts();
    }

    public function run()
    {
        $this->model = new Need();

        return $this->render('_form',
            [
                'model'=>$this->model,
                'formId'=>$this->formId,
                'jQueryFormSelector'=>$this->jQueryFormSelector,
                'actionRoute'=>$this->actionRoute,
                'widgetId'=>$this->widgetId,
                'jqToggleBtnSelector'=>$this->jqToggleBtnSelector,
                'clientOptions'=>$this->clientOptions,
            ]);

    }
    public function registerClientScripts(){
        \common\assets\YiiAjaxFormSubmitAsset::register($this->getView());
        $this->getView()->registerJs("$('#$this->widgetId').yiiAjaxFormWidget($this->clientOptions);", View::POS_READY);
    }
}