<?php

namespace frontend\modules\testtabularinput\controllers;

use Yii;
use frontend\modules\testtabularinput\models\Course;
use frontend\modules\testtabularinput\models\CourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminCourseController implements the CRUD actions for Course model.
 */
class AdminCourseController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Course models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Course model.
     * @param string $code_title
     * @param integer $code_no
     * @return mixed
     */
    public function actionView($code_title, $code_no)
    {
        return $this->render('view', [
            'model' => $this->findModel($code_title, $code_no),
        ]);

    }

    /**
     * Creates a new Course model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Course();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'code_title' => $model->code_title, 'code_no' => $model->code_no]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Course model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $code_title
     * @param integer $code_no
     * @return mixed
     */
    public function actionUpdate($code_title, $code_no)
    {
        $model = $this->findModel($code_title, $code_no);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'code_title' => $model->code_title, 'code_no' => $model->code_no]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Course model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $code_title
     * @param integer $code_no
     * @return mixed
     */
    public function actionDelete($code_title, $code_no)
    {
        $this->findModel($code_title, $code_no)->delete();


        return $this->redirect(['index']);
    }



    /**
     * Finds the Course model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $code_title
     * @param integer $code_no
     * @return Course the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($code_title, $code_no)
    {
        if (($model = Course::findOne(['code_title' => $code_title, 'code_no' => $code_no])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
