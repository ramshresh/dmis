<?php

namespace common\modules\user\controllers;

use common\components\MyBaseContoller;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\ActiveForm;

//use yii\web\Controller;

/**
 * Default controller for User module
 */
class DefaultController extends MyBaseContoller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'confirm', 'resend'],
                        'allow'   => true,
                        'roles'   => ['?', '@'],
                    ],
                    [
                        'actions' => ['account', 'profile', 'resend-change', 'cancel', 'logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                    [
                        'actions' => ['login', 'register', 'forgot', 'reset'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Display index - debug page, login page, or account page
     */
    public function actionIndex()
    {
        if (defined('YII_DEBUG') && YII_DEBUG) {
            $actions = Yii::$app->getModule("user")->getActions();
            return $this->render('index', ["actions" => $actions]);
        } elseif (Yii::$app->user->isGuest) {
            return $this->redirect(["/user/login"]);
        } else {
            return $this->redirect(["/user/account"]);
        }
    }




}