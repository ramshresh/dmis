<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/22/15
 * Time: 9:42 AM
 */

namespace api\controllers;

use common\modules\reporting\models\Event;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class EventController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\modules\reporting\models\Event';

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionTestCreate()
    {
        $model = new Event();
        if (Yii::$app->request->post()) {
            //Loading $_POST data of related models
            $model->geometries = Yii::$app->request->post('Geometry', []);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $model;
        } else {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
    }

    /**
     * Updates an existing Event model.
     * If update is successful, returns model
     * @param integer $id
     * @return mixed
     *
     * REQUEST TYPE is POST and Header with Content-Type : application/json and data
     *
     * {
     * "_csrf":"MzZwUHJkVlNcdERnLS49NWZACGg8Mi4.VHk9Z0QdLGIDVTcXJgk4NQ==",
     * "Event":   {"item_name":"Fire","timestamp_occurance":"2015-02-12 02:30:40"},
     * "Geometry":   {
     * "123":{"type":"123UPDATED","wkt":"LINESTRING(85.496535 27.632798,27.632798 87.65)"},
     * "143":{"type":"143UPDATED","wkt":"POINT(87 55)"},
     * "new1":{"type":"new1Added","wkt":"POINT(87 55)"},
     * }
     * }
     */
    public function actionTestUpdate($id)
    {
        /**
         * @var  $oldmodels \yii\db\ActiveRecord[]
         */
        $model = $this->findModel($id);

        if (Yii::$app->request->post('Geometry') && $model->geometries) {
            //Loading $_POST data of related models
            $model->geometries = \Yii::$app->request->post('Geometry', []);
        }

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $model;
        } else {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
    }

    public function actionTestManage()
    {
        $model = new Event();
        if (Yii::$app->request->post()) {
            //Loading $_POST data of related models
            $model->geometries = Yii::$app->request->post('Geometry', []);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $model;
        } else {
            throw new ServerErrorHttpException('Failed to execute request for unknown reason. This message is generated at Line: ' . __LINE__ . ' of  File:' . __FILE__);
        }
    }


    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}