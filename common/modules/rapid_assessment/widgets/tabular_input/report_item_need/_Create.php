<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/24/2015
 * Time: 12:18 PM
 */

namespace common\modules\rapid_assessment\widgets\tabular_input\report_item_need;



use common\modules\rapid_assessment\models\ReportItem;
use common\modules\rapid_assessment\models\ReportItemNeed;
use yii\base\Widget;
use yii\helpers\Json;


class _Create extends Widget
{
    // These properties must be when Widget is created
    public $form;
    public $allModels;
    public $modelClass;

    //These properties are auto-generated
    public $widgetId;
    //These properties are derived
    public $model;
    public $clientOptions;

    public function  init()
    {
        // Auo-generating properties
        $this->widgetId=($this->widgetId)?$this->widgetId:$this->id;

        // Generating derived properties
        $this->model = new $this->modelClass;

        $this->clientOptions['widgetId']=$this->widgetId;

        $this->clientOptions = Json::encode($this->clientOptions);
    }

    public function run()
    {
        $this->model = new ReportItemNeed();

        return $this->render('table',
            [
                'form'=>$this->form,
                'model'=>$this->model,
                'allModels'=>$this->allModels,
                'widgetId'=>$this->widgetId,
                'clientOptions'=>$this->clientOptions,
            ]);

    }
}