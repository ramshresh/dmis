<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/22/2015
 * Time: 10:05 AM
 */

namespace common\modules\rapid_assessment\controllers;
use common\modules\rapid_assessment\models\search\ReportItemSearch;
use yii\web\Controller;
use Yii;
class AdminReportItemController extends Controller
{
    public function actionIndex()
    {
        $actions = [
            'list'=>'list',
        ];
        return $this->render('index',['actions'=>$actions]);
    }

    public function actionList(){
        $searchModel = new ReportItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(Yii::$app->request->isPjax){
            return $this->renderPartial('list',
                [
                    'searchModel'=>$searchModel,
                    'dataProvider'=>$dataProvider,
                    'time' => date('H:i:s'),
                ]);
        }

        return $this->render('list',
            [
                'searchModel'=>$searchModel,
                'dataProvider'=>$dataProvider,
                'time' => date('H:i:s'),
            ]);
    }
}