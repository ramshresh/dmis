<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],

        ];
    }

    public function actionIndex()
    {
        if(Yii::$app->user->can('admin'))
            return $this->render('index');
        else
            $this->redirect(Url::to(['/site/login']));
    }

    public function actionLogin(){
        /** @var \common\modules\user\models\forms\LoginForm $model */

        // load post data and login
        $model = Yii::$app->getModule("user")->model("LoginForm");
        if(Yii::$app->request->isAjax){
            if ($model->load(Yii::$app->request->post()) && $model->login(Yii::$app->getModule("user")->loginDuration)) {
                return $this->goBack(Yii::$app->getModule("user")->loginRedirect);
            }else{
                $this->sendErrorResponseOnAjaxFormSubmit([$model]);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $model->login(Yii::$app->getModule("user")->loginDuration)) {
            return $this->goBack(Yii::$app->getModule("user")->loginRedirect);
        }

        // render
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Log user out and redirect
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        // redirect
        $logoutRedirect = Yii::$app->getModule("user")->logoutRedirect;
        if ($logoutRedirect === null) {
            return $this->goHome();
        }
        else {
            return $this->redirect($logoutRedirect);
        }
    }

    public function actionDashboard(){
        if(Yii::$app->request->isAjax){
            if(isset($_GET['view'])){
                return $this->renderAjax($_GET['view']);
            }
        }
        return $this->render('dashboard/main');
    }

    public function  actionTestUrl(){

        //echo AppHelper::getAppUrlToRoute('frontend',["/user/registration/confirm", "key" => 1234567898765432123456]);
        echo Yii::$app->urlManagerFrontEnd->createAbsoluteUrl(["/user/registration/confirm", "key" => 1234567898765432123456]);

    }
}
