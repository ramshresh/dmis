<?php

namespace common\modules\social_media\controllers;

use common\modules\social_media\components\TwitterRestApi;
use Yii;
use common\modules\social_media\models\TwitterStatus;
use common\modules\social_media\models\search\TwitterStatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TwitterStatusAdminController implements the CRUD actions for TwitterStatus model.
 */
class TwitterStatusAdminController extends Controller
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
     * Lists all TwitterStatus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TwitterStatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TwitterStatus model.
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
     * Creates a new TwitterStatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TwitterStatus();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $settings = [
                'oauth_access_token' => "714037699-NEhlB359yt4ghdMLYIvrQLJn7f0jhGDMq5zd63XF",
                'oauth_access_token_secret' => "nfwIUZ1HGp2dt9wUMnBb8py2X90OSs3rEFx641Dwcc1mA",
                'consumer_key' => "fq9NcxFeu5qE6yjQJAV6pukf5",
                'consumer_secret' => "oPAovWEA8aHBgqhan7MZMST439RccyEIPvaJVfFnJsJP9KkT4i"
            ];
            $postFields = array(
                'status'=>$model->status,
                'in_reply_to_status_id'=>$model->in_reply_to_status_id,
                'lat'=>$model->lat,
                'long'=>$model->long,
            );

            $twitterApi = new TwitterRestApi();
            $twitterApi->updateStatus($postFields,$settings);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TwitterStatus model.
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
     * Deletes an existing TwitterStatus model.
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
     * Finds the TwitterStatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TwitterStatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TwitterStatus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
