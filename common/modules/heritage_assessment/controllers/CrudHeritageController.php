<?php

namespace common\modules\heritage_assessment\controllers;

use common\components\utils\php\ArrayHelper;
use ramshresh\yii2\galleryManager\GalleryImageAr;
use ramshresh\yii2\galleryManager\GalleryManagerAction;
use Yii;
use common\modules\heritage_assessment\models\Heritage;
use common\modules\heritage_assessment\models\search\HeritageSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CrudHeritageController implements the CRUD actions for Heritage model.
 */
class CrudHeritageController extends Controller
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
     * Lists all Heritage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HeritageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Heritage model.
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
     * Creates a new Heritage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Heritage();
        $galleryImage = new GalleryImageAr();
        if ($model->load(Yii::$app->request->post())){
            $transaction = Yii::$app->db->beginTransaction();
            if( $model->save()){

                if(UploadedFile::getInstancesByName('photo')){
                    $photos = (UploadedFile::getInstancesByName('photo'));
                    foreach($photos as $photo){
                        echo Json::encode($photos);
                        Yii::$app->end();
                        $model->getBehavior('galleryBehavior')->addImage($photo->tempName,[]);
                    }
                }

                /*if (UploadedFile::getInstanceByName('photo')) {
                    //$photoData = (Yii::$app->request->post('photo_data')) ? Yii::$app->request->post('photo_data') : null;
                    $model->getBehavior('galleryBehavior')->addUploadedImage('photo', $photoData);
                }*/
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->session->setFlash('error', 'Error Saving Model');
                $transaction->rollBack();
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'galleryImage' => $galleryImage,
            ]);
        }
    }

    /**
     * Updates an existing Heritage model.
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
     * Deletes an existing Heritage model.
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
     * Finds the Heritage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Heritage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Heritage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actions()
    {
        return ArrayHelper::merge(
            parent::actions(),
            [
                'galleryApi' => [
                    'class' => GalleryManagerAction::className(),
                    // mappings between type names and model classes (should be the same as in behaviour)
                    'types' => [
                        'heritage_assessment' => Heritage::className()
                    ]
                ]
            ]); // TODO: Change the autogenerated stub
    }
}
