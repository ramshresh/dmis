<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/24/2015
 * Time: 12:18 PM
 */

namespace common\modules\rapid_assessment\widgets\report_item;



use common\modules\rapid_assessment\models\ReportItem;
use common\modules\rapid_assessment\models\ReportItemEmergencySituation;
use common\modules\rapid_assessment\models\ReportItemEvent;
use common\modules\rapid_assessment\models\ReportItemImpact;
use common\modules\rapid_assessment\models\ReportItemIncident;
use common\modules\rapid_assessment\models\ReportItemNeed;
use yii\base\Exception;
use yii\base\Widget;
use yii\helpers\Json;


class Create extends Widget
{
    public $reportItemType;
    public $viewFile;
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
                'route to the action to which the form to be submitted must be specified! Example :: /girc/dmis/frontend/web/site/damage-create'
            );
        }

        switch(strtolower($this->reportItemType)){
            case strtolower(ReportItem::TYPE_EMERGENCY_SITUATION):
                $this->model = new ReportItemEmergencySituation();
                $this->viewFile = 'emergency-situation/_form';
                $this->actionRoute = [$this->actionRoute,'model'=>'ReportItemEmergencySituation'];
                break;
            case strtolower(ReportItem::TYPE_EVENT):
                $this->model = new ReportItemEvent();
                $this->viewFile = 'event/_form';
                $this->actionRoute = [$this->actionRoute,'model'=>'ReportItemEvent'];
                break;
            case strtolower(ReportItem::TYPE_INCIDENT):
                $this->model = new ReportItemIncident();
                $this->viewFile = 'incident/_form';
                $this->actionRoute = [$this->actionRoute,'model'=>'ReportItemIncident'];
                break;
            case strtolower(ReportItem::TYPE_IMPACT):
                $this->model = new ReportItemImpact();
                $this->viewFile = 'impact/_form';
                $this->actionRoute = [$this->actionRoute,'model'=>'ReportItemImpact'];
                break;
            case strtolower(ReportItem::TYPE_NEED):
                $this->model = new ReportItemNeed();
                $this->viewFile = 'need/_form';
                $this->actionRoute = [$this->actionRoute,'model'=>'ReportItemNeed'];;
                break;
            default:
                $this->model = new ReportItem();
                $this->viewFile = 'default/_form';
                break;
        }


        $this->widgetId=($this->widgetId)?$this->widgetId:$this->id;
        $this->formId=($this->formId)?$this->formId:$this->widgetId.'-form';
        $this->jQueryFormSelector = '#'.$this->formId;

        $this->clientOptions['formId']=$this->formId;
        $this->clientOptions['actionRoute']=$this->actionRoute;
        $this->clientOptions['widgetId']=$this->widgetId;
        $this->clientOptions['jqToggleBtnSelector']=$this->jqToggleBtnSelector;
        $this->clientOptions = Json::encode($this->clientOptions);
        $this->registerClientScripts();
    }

    public function run()
    {
        //$this->model = new ReportItem();

        return $this->render($this->viewFile,
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
        $this->getView()->registerJs("$('#$this->widgetId').yiiAjaxFormWidget($this->clientOptions);", \yii\web\View::POS_READY);
    }
}