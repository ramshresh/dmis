<?php

class AdminController extends Controller
{
    //public $layout = '//layouts/column2';
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

    public static function assignImpacts($model, $items_posted)
    {
        $impacts = array();
        foreach ($items_posted as $item_post) {
            $impact = null;
            if (!empty($item_post['id'])) {
                $impact = DisasterIncidentHelper::findImpact($model, $item_post['id']);
            }
            if (is_null($impact)) {
                $impact = new Impact();
            }
            unset($item_post['id']);
            // Remove primary key
            $impact->attributes = $item_post;
            array_push($impacts, $impact);
        }
        return $impacts;
    }

    public static function assignNeeds($model, $items_posted)
    {

        $needs = array();
        foreach ($items_posted as $item_post) {
            $need = null;
            if (!empty($item_post['id'])) {
                $need = DisasterIncidentHelper::findNeed($model, $item_post['id']);
            }
            if (is_null($need)) {
                $need = new Need();
            }
            unset($item_post['id']);
            // Remove primary key
            $need->attributes = $item_post;
            array_push($needs, $need);
        }
        return $needs;
    }

    public static function findImpact($model, $id)
    {
        $impact = null;
        foreach ($model->impacts as $s) {
            if ($s->id == $id) {
                $impact = $s;
            }
        }
        return $impact;
    }

    public static function findNeed($model, $id)
    {
        $need = null;
        foreach ($model->needs as $s) {
            if ($s->id == $id) {
                $need = $s;
            }
        }
        return $need;
    }

    public static function getErrorInJSON($models)
    {
        return '{}';
    }

    /**
     * @return array action filters
     */

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'ajaxrequest', 'renderpartialgallery', 'test', 'rpg', 'upload'), 'users' => array('*'),
            ), array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'getgalleryhtml', 'creategallery'), 'users' => array('@'),
            ), array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'), 'users' => array('admin'),
            ), array(
                'deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     *
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        if ($id != null) {
            $model = $this->loadModel($id);
            $gallery = $model->gallery;

            $impactDataProvider = new CActiveDataProvider('Impact', array('criteria' => array('with' => array(DisasterIncident::model()->impacts), 'together' => 'true', 'condition' => 'id_rna_disaster_incident=:id', 'params' => array(':id' => $model->id),),));
            $needDataProvider = new CActiveDataProvider('Need', array('criteria' => array('with' => array(DisasterIncident::model()->needs), 'together' => 'true', 'condition' => 'id_rna_disaster_incident=:id', 'params' => array(':id' => $model->id),),));

            $allDataProvider = new CActiveDataProvider('DisasterIncident', array('criteria' => array('with' => array('Need'), 'condition' => 'id_rna_disaster_incident=:id', 'params' => array(':id' => $model->id),), 'pagination' => array('pageSize' => 20,),));
            //var_dump($allDataProvider);
            //$array=$model->convertModelToArray($models, $filterAttributes,$ignoreRelations);

            $array1 = $model->convertModelToArray($model);
            $array2 = $model->convertModelToArray($model->impacts);
            $array3 = $model->convertModelToArray($model->needs);

            //          //echo "{'DisasterIncident:'"+CJSON::encode($array1).', "":'.CJSON::encode($array2).CJSON::encode($array3).'}';
            //          //var_dump($array);
            //          foreach ($gallery->galleryPhotos as $photo){
            //              //var_dump($photo->getPreview());
            //              //          foreach($gallery->versions as $key=>$value){
            //              //              echo '<br>';
            //              //              echo $photo->getUrl($key);
            //              //              echo '</br>';
            //              //          }
            //              //var_dump($gallery->versions_data);
            //          }
            //          $galleryHTML = $this->renderPartial('form/_galleryManager',
            //          array('gallery'=>$gallery), TRUE, false
            //          );
            $this->render('view', array(
                'model' => $model, 'impactDataProvider' => $impactDataProvider, 'needDataProvider' => $needDataProvider,
                //'galleryHTML'=>$galleryHTML
            ));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     *
     * @param integer $id the ID of the model to be loaded
     *
     * @return DisasterIncident the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = DisasterIncident::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        //if (!isset($model)) {
        $model = new DisasterIncident;

        Yii::import("xupload.models.XUploadForm");
        $photos = new XUploadForm();
        $gallery = new Gallery();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['DisasterIncident'])) {
            $model->attributes = $_POST['DisasterIncident'];
            //Check if the form related to the Impact model has been submitted
            if (isset($_POST['Impact'])) {
                $model->impacts = DisasterIncidentHelper::assignImpacts($model, $_POST['Impact']);
            }
            //Check if the form related to the Need model has been submitted
            if (isset($_POST['Need'])) {
                $model->needs = DisasterIncidentHelper::assignNeeds($model, $_POST['Need']);
            }


            //Check if the form related to the Gallery model has been submitted
            if (isset($_POST['Gallery'])) {

                //Assign our safe attributes
                $gallery->attributes = $_POST['Gallery'];
                //Start a transaction in case something goes wrong
                $transaction = Yii::app()->db->beginTransaction();
                try {
                    //Save the model to the database
                    if ($gallery->save()) {
                        $model->gallery = $gallery;
                        $transaction->commit();
                    }
                } catch (Exception $e) {
                    $transaction->rollback();
                    Yii::app()->handleException($e);
                }
            }
            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                    //$this->renderPartial('_form_aftercreate', array('model' => $model, 'gallery' => $gallery, 'photos' => $photos), false, true);
                    echo "<h5>Saved</h5>";
                    Yii::app()->end();
                } else {
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }


        }

        //$this->render('create', array('model' => $model,));
        //$this->render('jquerymodalform/create',array('model' => $model,));

        $this->render('create',
            array(
                'model' => $model,
                'photos' => $photos,
                'gallery' => $gallery
            ));

        //}

    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $gallery = $model->gallery;

        // Uncomment the following line if AJAX validation is needed
        // $this -> performAjaxValidation($model);

        if (isset($_POST['Disasterincident'])) {
            $model->attributes = $_POST['Disasterincident'];
            if (isset($_POST['Impact'])) {
                $model->impacts = DisasterIncidentHelper::assignImpacts($model, $_POST['Impact']);
            }
            if (isset($_POST['Need'])) {
                $model->needs = DisasterIncidentHelper::assignNeeds($model, $_POST['Need']);
            }

            //$resultDisasterIncident = CActiveForm::validate($model);

            if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                $model->save();
                echo $model->id;
                Yii::app()->end();
            } else {

                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array('model' => $model, 'gallery'=>$gallery));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     *
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('DisasterIncident');
        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new DisasterIncident('search');
        $model->unsetAttributes();
        // clear any default values
        if (isset($_GET['DisasterIncident']))
            $model->attributes = $_GET['DisasterIncident'];
        $this->render('admin', array('model' => $model,));
    }

    /**
     * Manages all models.
     */
    public function actionRpg()
    {
        if (isset($_POST['modelid'])) {
            $modelid = $_POST['modelid'];
            var_dump(CJSON::encode($modelid));
            Yii::app()->end();
            $model = $this->loadModel($modelid);

            if ($modelid != null) {

                if (isset($model->gallery)) {
                    echo CJSON::encode(array('response' => array('msg' => 'gallery already created')));
                    Yii::app()->end();
                } else {
                    $gallery = new Gallery();
                    $gallery->versions = $model->GALLERY_VERSIONS_DEFAULTS;
                    //$gallery->save();
                    //      $galleryHTML = $this->renderPartial('form/_galleryManager',
                    //            array('gallery'=>$gallery), false, true
                    //            );
                    $galleryHTML = $this->renderPartial('form/_galleryManager', array('gallery' => $gallery, 'model' => $model), true, true);

                    //              $galleryHTML=$this->render('test',array(
                    //                  'galleryHTML'=>$galleryHTML
                    //              ));
                    //echo $galleryHTML;

                    //echo CJSON::encode(array( '_galleryManager' => $galleryHTML)); //I echo as Json as I will need that in my ajax javascript functions later on.
                    echo CJSON::encode(array('response' => array('status' => 'OK', 'html' => $galleryHTML)));
                    Yii::app()->end();
                }

                //              $photos=GalleryPhoto::model()->findByPk($modelid);
                //              if($photos!=null){
                //                  foreach ($photos as $photo){
                //                      if($photo->latitude==null){
                //                          $photo->latitude=$model->latitude;
                //                      }
                //                      if($photo->longitude==null){
                //                          $photo->longitude=$model->longitude;
                //                      }
                //                  }}

                $model->gallery = $gallery;
                $model->gallery_id = $gallery->id;
                $model->save();
            } else {
                echo CJSON::encode(array('response' => array('status' => 'its empty')));
            }
        }
    }

    public function actionRenderPartialGallery()
    {
        if (isset($_POST['modelid'])) {
            $modelid = $_POST['modelid'];

            if ($modelid != null) {

                $model = $this->loadModel($modelid);
                if (isset($model->gallery)) {
                    $galleryHTML = $this->renderPartial('form/_galleryManager', array('gallery' => $model->gallery, 'model' => $model), true, true);
                    echo CJSON::encode(array('response' => array('status' => 'OK', 'html' => $galleryHTML)));
                    Yii::app()->end();
                } else {
                    $gallery = new Gallery();
                    $gallery->versions = $model->GALLERY_VERSIONS_DEFAULTS;
                    $galleryHTML = $this->renderPartial('form/_galleryManager', array('gallery' => $gallery, 'model' => $model), true, true);
                    echo CJSON::encode(array('response' => array('status' => 'OK', 'html' => $galleryHTML)));
                    Yii::app()->end();
                }

                $model->gallery = $gallery;
                $model->gallery_id = $gallery->id;
                $model->save();
            } else {
                echo CJSON::encode(array('response' => array('status' => 'its empty')));
            }
        }
    }

    public function actionGetGalleryHTML($modelid = null)
    {
        if (isset($_POST['modelid'])) {
            $modelid = $_POST['modelid'];
            if ($modelid != null) {
                $model = $this->loadModel($modelid);
                $gallery = null;
                if ($model->gallery != null) {
                    $gallery = $model->gallery;
                } else {
                    $gallery = new Gallery();
                    $gallery->versions = $model->GALLERY_VERSIONS_DEFAULTS;
                    $gallery->save();
                }

                $photos = GalleryPhoto::model()->findByPk($modelid);
                if ($photos != null) {
                    foreach ($photos as $photo) {
                        if ($photo->latitude == null) {
                            $photo->latitude = $model->latitude;
                        }
                        if ($photo->longitude == null) {
                            $photo->longitude = $model->longitude;
                        }
                    }
                }

                $model->gallery = $gallery;
                $model->gallery_id = $gallery->id;
                $model->save();

                //      $galleryHTML = $this->renderPartial('form/_galleryManager',
                //            array('gallery'=>$gallery), false, true
                //            );
                $galleryHTML = $this->renderPartial('form/_galleryManager', array('gallery' => $gallery, 'model' => $model), true, true);

                //              $galleryHTML=$this->render('test',array(
                //                  'galleryHTML'=>$galleryHTML
                //              ));
                //echo $galleryHTML;

                echo CJSON::encode(array('html' => $galleryHTML));
                //I echo as Json as I will need that in my ajax javascript functions later on.
                Yii::app()->end();
            } else {
                echo "its empty";
            }
        }
    }

    public function actionCreateGallery()
    {
        if (isset($_POST['modelid']) && $_POST['modelid'] != null) {
            $modelid = $_POST['modelid'];
            $model = $this->loadModel($modelid);
            $gallery = new Gallery();
            $gallery->versions = $model->GALLERY_VERSIONS_DEFAULTS;
            $gallery->save();
            $model->gallery = $gallery;
            $model->save();
            $galleryHTML = $this->renderPartial('form/_galleryManager', array('gallery' => $gallery, 'model' => $model), true, true);
            echo $galleryHTML;
            Yii::app()->end();
        } else {
            echo "DisasterIncident Model is not instantiated!";
            Yii::app()->end();
        }

    }

    public function actionAjaxRequest()
    {
        $val1 = $_POST['val1'];
        $val2 = $_POST['val2'];

        //
        // Perform processing
        //

        //
        // echo the AJAX response
        //
        echo "some sort of response";

        Yii::app()->end();
    }

    public function actionAssignGallery($modelid = null)
    {
        if ($modelid != null) {

        }
    }

    public function actionUpload()
    {
        Yii::import("xupload.models.XUploadForm");
        //Here we define the paths where the files will be stored temporarily
        $path = realpath(Yii::app()->getBasePath() . "/../images/uploads/tmp/") . "/";
        $publicPath = Yii::app()->getBaseUrl() . "/images/uploads/tmp/";

        //This is for IE which doens't handle 'Content-type: application/json' correctly
        header('Vary: Accept');
        if (isset($_SERVER['HTTP_ACCEPT'])
            && (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)
        ) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }

        //Here we check if we are deleting and uploaded file
        if (isset($_GET["_method"])) {
            if ($_GET["_method"] == "delete") {
                if ($_GET["file"][0] !== '.') {
                    $file = $path . $_GET["file"];
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                echo json_encode(true);
            }
        } else {
            $model = new XUploadForm;
            $model->file = CUploadedFile::getInstance($model, 'file');
            
            //We check that the file was successfully uploaded
            if ($model->file !== null) {
                //Grab some data
                $model->mime_type = $model->file->getType();
                $model->size = $model->file->getSize();
                $model->name = $model->file->getName();
                //(optional) Generate a random name for our file
                $filename = md5(Yii::app()->user->id . microtime() . $model->name);
                $filename .= "." . $model->file->getExtensionName();
                if ($model->validate()) {
                    //Move our file to our temporary dir
                    $model->file->saveAs($path . $filename);
                    chmod($path . $filename, 0777);
                    //here you can also generate the image versions you need
                    //using something like PHPThumb
                    Yii::import('application.extensions.image.Image');
                    $image = Yii::app()->image->load($path . $filename);
                    $image->resize(100, 100);
                    $image->save($path . "thumbs/" . $filename);
                    chmod($path . "thumbs/" . $filename, 0777);

                    //Now we need to save this path to the user's session
                    if (Yii::app()->user->hasState('images')) {
                        $userImages = Yii::app()->user->getState('images');
                    } else {
                        $userImages = array();
                    }
                    $userImages[] = array(
                        "path" => $path . $filename,
                        //the same file or a thumb version that you generated
                        "thumb" => $path . "thumbs/" . $filename,
                        "filename" => $filename,
                        'size' => $model->size,
                        'mime' => $model->mime_type,
                        'name' => $model->name,
                    );
                    Yii::app()->user->setState('images', $userImages);

                    //Now we need to tell our widget that the upload was succesfull
                    //We do so, using the json structure defined in
                    // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                    echo json_encode(array(
                        array(
                            "name" => $model->name,
                            "type" => $model->mime_type,
                            "size" => $model->size,
                            "url" => $publicPath . $filename,
                            "thumbnail_url" => $publicPath . "thumbs/$filename",
                            "delete_url" => $this->createUrl("upload", array(
                                "_method" => "delete",
                                "file" => $filename
                            )),
                            "delete_type" => "POST"
                        )
                    ));
                } else {
                    //If the upload failed for some reason we log some data and let the widget know
                    echo json_encode(array(
                        array(
                            "error" => $model->getErrors('file'),
                        )
                    ));
                    Yii::log("XUploadAction: " . CVarDumper::dumpAsString($model->getErrors()),
                        CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction"
                    );
                }
            } else {
                throw new CHttpException(500, "Could not upload file");
            }
        }
    }

    /**
     * Performs the AJAX validation.
     *
     * @param DisasterIncident $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'disaster-incident-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


}
