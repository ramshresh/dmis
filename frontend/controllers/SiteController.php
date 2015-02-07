<?php
namespace frontend\controllers;

use common\modules\reporting\models\Damage;
use common\modules\reporting\models\EmergencySituation;
use common\modules\reporting\models\Event;
use common\modules\reporting\models\Incident;
use common\modules\reporting\models\ItemType;
use common\modules\reporting\models\ReportItem;
use Yii;
use common\components\MyBaseContoller;
use frontend\models\ContactForm;


/**
 * Site controller
 */
class SiteController extends MyBaseContoller
{
    /**
     * @inheritdoc
     */
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionHelloWidget(){
        return $this->render('hellowidget');
    }

    public function actionGraphhopper(){
        return $this->render('graphhopper');
    }


    public function actionInitReporting(){
        //$event=new Event();

        /*$re1 = new ReportItem();
        $re1->type = ReportItem::TYPE_EVENT;
        $re1->item_name='Fire';
        $re1->subtype_name='Forest Fire';
        $re1->title='Chitwan Forest Fire ';
        $re1->description='Forest fire at Chitwan NP';
        $re1->is_verified=true;
        $re1->save();
        $e1 = new Event();
        $e1->link('reportitem',$re1);
        $e1->status=0;
        $e1->save();

        $res1 = new ReportItem();
        $res1->type = ReportItem::TYPE_EMERGENCY_SITUATION;
        $res1->item_name='Emergency Situation';
        $res1->subtype_name='Local';
        $res1->title='Chitwan Forest Fire Emergency Situation';
        $res1->description='Forest fire at Chitwan NP';
        $res1->is_verified=true;
        $res1->save();
        $es1=new EmergencySituation();
        $es1->declared_by='ICIMOD';
        $es1->status=0;
        $es1->link('reportItem',$res1);
        $es1->link('primaryEvent',$e1);

        $es1->save();*/

        /*
        $res1->link('reportItemChildren',$re1);

        $ri1 = new ReportItem();
        $ri1->type = ReportItem::TYPE_INCIDENT;
        $ri1->item_name='Building Damage';
        $ri1->subtype_name='Residential Complete';
        $ri1->title='Residential building burn';
        $ri1->description='Housed destroyed at Chitwan NP';
        $ri1->is_verified=true;
        $ri1->save();
        $i1 = new Incident();
        $i1->link('reportitem',$ri1);
        $i1->status=0;
        $i1->save();
        $re1->link('reportItemChildren',$ri1);

        $rd1 = new ReportItem();
        $rd1->type = ReportItem::TYPE_DAMAGE;
        $rd1->item_name='Death';
        $rd1->subtype_name='On Spot';
        $rd1->title='Death due to fire burn';
        $rd1->description='10 people died in fire';
        $rd1->is_verified=true;
        $rd1->save();
        $d1 = new Incident();
        $d1->link('reportitem',$rd1);
        $d1->status=0;
        $d1->save();
        $ri1->link('reportItemChildren',$rd1);*/

/*
        $itemTypes = ItemType::find()->where('item_name=:item_name',[':item_name'=>'Building Damage'])->all();
        foreach($itemTypes as $itemType){
            $itemChildren=$itemType->itemChildren;
            foreach($itemChildren as $itemChild){
                print_r($itemChild->item_name);
            }
        }*/
    }
}
