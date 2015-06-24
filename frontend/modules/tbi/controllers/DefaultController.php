<?php

namespace frontend\modules\tbi\controllers;

use common\modules\tbi\models\search\BuildingSearch;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $this->layout='map/main';
        $searchModel = new BuildingSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
