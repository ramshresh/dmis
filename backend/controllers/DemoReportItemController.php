<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * DemoReportItem controller
 */
class DemoReportItemController extends Controller
{


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $links = [];
        $link=['name'=>'assign report item child','url'=>Url::toRoute('assign-child')];
        array_push($links,$link);
        return $this->render('index',['links'=>$links]);
    }
    public function actionAssignChild(){
        return $this->render('assign-child');
    }
}
