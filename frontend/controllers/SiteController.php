<?php
namespace frontend\controllers;

use common\components\MyBaseContoller;
use common\modules\rapid_assessment\models\ReportItem;
use frontend\models\ContactForm;
use Yii;
use yii\bootstrap\BootstrapAsset;
use yii\helpers\Json;


/**
 * Site controller
 */
class SiteController extends MyBaseContoller
{
    public $layout = 'main';
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
            'emergency-situation-create' => [
                'class' => 'common\modules\reporting\actions\EmergencySituationCreateAction',
            ],
            'event-create' => [
                'class' => 'common\modules\reporting\actions\EventCreateAction',
            ],
            'incident-create' => [
                'class' => 'common\modules\reporting\actions\IncidentCreateAction',
            ],
            'damage-create' => [
                'class' => 'common\modules\reporting\actions\DamageCreateAction',
            ],
            'need-create' => [
                'class' => 'common\modules\reporting\actions\NeedCreateAction',
            ],
            'register-driver' => [
                'class' => 'common\modules\tracking\actions\rest\DriverRegistrationAction',
            ],
            'report-item-create' => [
                'class' => 'common\modules\rapid_assessment\actions\ReportItemCreateAction',
            ],
            'rapid_assessment-file-upload'=>[
                'class'=>'common\modules\rapid_assessment\actions\FileUploadAction',
            ],
        ];
    }

    public function actionWidget()
    {
        if (Yii::$app->request->get('name')) {
            $widgetName = Yii::$app->request->get('name');
            switch ($widgetName) {
                case 'event-report-create':
                    return $this->renderAjax('widgets/event-report-create');
                    break;
                default:
                    break;
            }

        }
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
            return $this->render(
                'contact',
                [
                    'model' => $model,
                ]
            );
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionHelloWidget()
    {
        return $this->render('hellowidget');
    }

    public function actionGraphhopper()
    {
        return $this->render('graphhopper');
    }

    public function actionTest()
    {
        echo Json::encode(Re::find()->all());
        echo '<br>';

    }


    public function actionInitReporting()
    {
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

    public function actionGeometryPicker()
    {
        return $this->renderAjax('geometry_picker', []);
    }

    public function actionRapidAssessment()
    {
        // creating new
        /*$a = new \common\modules\rapid_assessment\models\ReportItemEmergencySituation();
        $b = new \common\modules\rapid_assessment\models\ReportItemEvent();
        $c = new \common\modules\rapid_assessment\models\ReportItemIncident();
        $d = new \common\modules\rapid_assessment\models\ReportItemImpact();
        $e = new \common\modules\rapid_assessment\models\ReportItemNeed();

        $a->type=ReportItem::TYPE_EMERGENCY_SITUATION;
        $a->item_name='ES 1';
        $b->type=ReportItem::TYPE_EVENT;
        $b->item_name='EV 1';
        $c->type=ReportItem::TYPE_INCIDENT;
        $c->item_name='INC 1';
        $d->type=ReportItem::TYPE_IMPACT;
        $d->item_name='IMP 1';
        $e->type=ReportItem::TYPE_NEED;
        $e->item_name='ND 1';
        $a->save();
        $b->save();
        $c->save();
        $d->save();
        $e->save();*/

        //retrieving one
        $a = \common\modules\rapid_assessment\models\ReportItemEmergencySituation::find()->one();
        $b = \common\modules\rapid_assessment\models\ReportItemEvent::find()->one();
        $c = \common\modules\rapid_assessment\models\ReportItemIncident::find()->one();
        $d = \common\modules\rapid_assessment\models\ReportItemImpact::find()->one();
        $e = \common\modules\rapid_assessment\models\ReportItemNeed::find()->one();

        /*$a->wkt='POINT(81 27)';
        $a->title = 'Earthquake emergency situation in Nepal (2015)';
        $a->declared_by ='UNOCHA';
        $a->timestamp_declared_at ='2015-02-15 10:00:00';
        $a->item_name='Emergency Situation';
        $a->class_basis='Extent';
        $a->class_name='Regional';

        $b->wkt='POINT(81.5 27.5)';
        $b->title = 'Earthquake Hits Central Nepal';
        $b->item_name='Earthquake';
        $b->class_basis='Magnitude';
        $b->class_name='Major';
        $b->magnitude = '8.5';
        $b->units ='RH Scale';
        $b->timestamp_occurance='2015-02-15 05:15:00';
        $b->address='Kathmandu, Central Region, Nepal';



        $c->wkt='POINT(81.1 25.1)';
        $c->title = 'An old 5 storied building collapsed near Patan Durbar Square';
        $c->item_name='Building Damage';
        $c->class_basis='Type of Damage';
        $c->class_name='Residential Complete';
        $c->magnitude = '1';
        $c->units ='Nos';
        $c->timestamp_occurance='2015-02-15 05:15:00'; //equalto event if not defined
        $c->address='Lalitpur, Central Region, Nepal';

        $d->wkt='POINT(81.1001 25.103)';
        $d->title='5 people dead';
        $d->item_name='Death';
        $d->class_basis='Cause';
        $d->class_name='Falling Debris';
        $d->magnitude = '5';
        $d->units ='Person';
        $d->timestamp_occurance='2015-02-15 05:15:00'; //equal to incident if not set
        $d->address='Lalitpur, Central Region, Nepal'; //equal to incident if not set

        $e->wkt='POINT(81.1001 25.103)'; // inherit impact or incident or event or emergency situation
        $e->title='Need Tents for homeless';
        $e->item_name='Tent';
        $e->class_basis='Use Type';
        $e->class_name='Shelter';
        $e->magnitude = '5';
        $e->units ='Nos';
        $e->timestamp_occurance='2015-02-15 05:15:00'; //equal to incident if not set
        $e->address='Lalitpur, Central Region, Nepal'; //equal to incident if not set*/


        //saving
        /*$a->save();
        $b->save();
        $c->save();
        $d->save();
        $e->save();*/


//$eventModel = \common\modules\rapid_assessment\models\ReportItemEvent::find()->one();
//$es = \common\modules\rapid_assessment\models\ReportItemEmergencySituation::find()->one();

        //Linking
        /*$e->link('impact',$d);
        $e->link('incident',$c);
        $e->link('event',$b);
        $e->link('emergencySituation',$a);

        $d->link('incident',$c);
           $d->link('event',$b);
        $d->link('emergencySituation',$a);

       $c->link('event',$b);
        $c->link('emergencySituation',$a);

        $b->link('emergencySituation',$a);*/

        echo '<h2> Emergency Situation Children';
        echo '<br><h5><b>Events:</b></h5>';
        echo Json::encode($a->events);
        echo '<br><h5><b>Incidents:</b></h5>';
        echo Json::encode($a->incidents);
        echo '<br><h5><b>Impacts:</b></h5>';
        echo Json::encode($a->impacts);
        echo '<br><h5><b>Needs:</b></h5>';
        echo Json::encode($a->needs);
        echo '</h2>';

        echo '<h2> Event  Children';
        echo '<br><h5><b>Incidents:</b></h5>';
        echo Json::encode($b->incidents);
        echo '<br><h5><b>Impacts:</b></h5>';
        echo Json::encode($b->impacts);
        echo '<br><h5><b>Needs:</b></h5>';
        echo Json::encode($b->needs);
        echo '</h2>';

        echo '<h2> Incident  Children';
        echo '<br><h5><b>Impacts:</b></h5>';
        echo Json::encode($c->impacts);
        echo '<br><h5><b>Needs:</b></h5>';
        echo Json::encode($c->needs);
        echo '</h2>';


        echo '<h2> Impact  Children';
        echo '<br><h5><b>Needs:</b></h5>';
        echo Json::encode($d->needs);
        echo '</h2>';


        echo '<h2> Need parent';
        echo '<br><h5><b>EmergencySituation:</b></h5>';
        echo Json::encode($e->emergencySituation);
        echo '<br><h5><b>Event:</b></h5>';
        echo Json::encode($e->event);
        echo '<br><h5><b>Incident:</b></h5>';
        echo Json::encode($e->incident);
        echo '<br><h5><b>Impact:</b></h5>';
        echo Json::encode($e->impact);
        echo '</h2>';

        echo '<h2> Impact parent';
        echo '<br><h5><b>EmergencySituation:</b></h5>';
        echo Json::encode($d->emergencySituation);
        echo '<br><h5><b>Event:</b></h5>';
        echo Json::encode($d->event);
        echo '<br><h5><b>Incident:</b></h5>';
        echo Json::encode($d->incident);

        echo '<h2> Incident parent';
        echo '<br><h5><b>EmergencySituation:</b></h5>';
        echo Json::encode($c->emergencySituation);
        echo '<br><h5><b>Event:</b></h5>';
        echo Json::encode($c->event);

        echo '<h2> Event parent';
        echo '<br><h5><b>EmergencySituation:</b></h5>';
        echo Json::encode($b->emergencySituation);
    }

    public function actionFilterReportItem()
    {
        return $this->renderAjax('filter-report-item/view', []);
    }
    public function actionSocialMediaGalleryWidget(){
      //  return $this->renderAjax('social-media/gallery-widget');
    }
}
