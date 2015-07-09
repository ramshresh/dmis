<?php

namespace frontend\modules\heritage_assessment\controllers;

use common\components\utils\php\ArrayHelper;
use common\modules\heritage_assessment\models\search\HeritageSearch;
use kartik\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;

class ReportsController extends Controller
{
    public function actionIndex(){
        $this->layout='map/main';
        $searchModel = new HeritageSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}

