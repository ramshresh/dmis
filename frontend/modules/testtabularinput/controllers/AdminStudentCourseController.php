<?php

namespace frontend\modules\testtabularinput\controllers;

use Yii;
use frontend\modules\testtabularinput\models\StudentCourse;
use frontend\modules\testtabularinput\models\StudentCourseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminStudentCourseController implements the CRUD actions for StudentCourse model.
 */
class AdminStudentCourseController extends Controller
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
     * Lists all StudentCourse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentCourseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StudentCourse model.
     * @param string $student_registration_no
     * @param string $course_code_title
     * @param integer $course_code_no
     * @return mixed
     */
    public function actionView($student_registration_no, $course_code_title, $course_code_no)
    {
        return $this->render('view', [
            'model' => $this->findModel($student_registration_no, $course_code_title, $course_code_no),
        ]);
    }

    /**
     * Creates a new StudentCourse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentCourse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'student_registration_no' => $model->student_registration_no, 'course_code_title' => $model->course_code_title, 'course_code_no' => $model->course_code_no]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StudentCourse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $student_registration_no
     * @param string $course_code_title
     * @param integer $course_code_no
     * @return mixed
     */
    public function actionUpdate($student_registration_no, $course_code_title, $course_code_no)
    {
        $model = $this->findModel($student_registration_no, $course_code_title, $course_code_no);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'student_registration_no' => $model->student_registration_no, 'course_code_title' => $model->course_code_title, 'course_code_no' => $model->course_code_no]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StudentCourse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $student_registration_no
     * @param string $course_code_title
     * @param integer $course_code_no
     * @return mixed
     */
    public function actionDelete($student_registration_no, $course_code_title, $course_code_no)
    {
        $this->findModel($student_registration_no, $course_code_title, $course_code_no)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentCourse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $student_registration_no
     * @param string $course_code_title
     * @param integer $course_code_no
     * @return StudentCourse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($student_registration_no, $course_code_title, $course_code_no)
    {
        if (($model = StudentCourse::findOne(['student_registration_no' => $student_registration_no, 'course_code_title' => $course_code_title, 'course_code_no' => $course_code_no])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
