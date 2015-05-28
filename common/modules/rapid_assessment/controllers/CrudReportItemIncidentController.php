<?php

namespace common\modules\rapid_assessment\controllers;

use Yii;
use common\modules\rapid_assessment\models\ReportItemIncident;
use common\modules\rapid_assessment\models\search\ReportItemIncidentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CrudReportItemIncidentController implements the CRUD actions for ReportItemIncident model.
 */
class CrudReportItemIncidentController extends Controller
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
     * Lists all ReportItemIncident models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportItemIncidentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReportItemIncident model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ReportItemIncident model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReportItemIncident();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new ReportItemIncident();
            if (Yii::$app->request->getBodyParam('ReportItemEvent', [])) {
                //Loading $_POST data of related models
                $model->event = Yii::$app->request->post('ReportItemEvent', []);
            }
            if (Yii::$app->request->post('ReportItemImpact', [])) {
                //Loading $_POST data of related models
                $model->impacts = Yii::$app->request->post('ReportItemImpact', []);
            }
            if (Yii::$app->request->post('ReportItemNeed', [])) {
                //Loading $_POST data of related models
                $model->needs = Yii::$app->request->post('ReportItemNeed', []);
            }
            if (Yii::$app->request->post('ReportItemMultimedia', [])) {
                //Loading $_POST data of related models
                //$model->getReportItemMultimedia = Yii::$app->request->post('ReportItemMultimedia', []);
            }
            /*
                                $id='37';
                                $savedTemp=TempUploadedFile::find()
                                    ->where('id > :id', [':id' => $id])
                                    ->all();*/
            if(Yii::$app->request->post('ReportItemIncident')){
                if($model->load(Yii::$app->request->post()) && $model->save() ){
                    if(UploadedFile::getInstanceByName('photo')){
                        $photoData = (Yii::$app->request->post('photo_data'))?Yii::$app->request->post('photo_data'):null;
                        $model->getBehavior('galleryBehavior')->addUploadedImage('photo',$photoData);
                    }
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error','Error Saving Model');
                }
            }
        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ReportItemIncident model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ReportItemIncident model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ReportItemIncident model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ReportItemIncident the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReportItemIncident::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
