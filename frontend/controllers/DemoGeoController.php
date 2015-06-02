<?php
namespace frontend\controllers;

use common\components\MyBaseContoller;
use common\modules\rapid_assessment\models\ItemType;
use common\components\AppHelper;
use Yii;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * DemoGeo controller
 */
class DemoGeoController extends MyBaseContoller
{


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
            'event-create'=>[
              'class'=>'common\modules\reporting\actions\EventCreateAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $links = [];
        $links[] = ['url' => Url::to(['demo-geo/place-autocomplete-widget']), 'title' => 'Place Autocomplete Widget'];
        $links[] = ['url' => Url::to(['demo-geo/point-picker-widget']), 'title' => 'PointPickerWidget'];
        $links[] = ['url' => Url::to(['demo-geo/point-picker-ol3-widget']), 'title' => 'PointPicker Widget with Openlayers 3 and Jquery Ui Dialog'];
        $links[] = ['url' => Url::to(['demo-geo/point-picker-ol3-bootstrap-modal-widget']), 'title' => 'PointPicker Widget with Openlayers 3 and Bootstrap Modal'];
        $links[] = ['url' => Url::to(['demo-geo/ol3-map-simple']), 'title' => 'Simple Openlayers 3 Map'];
        $links[] = ['url' => Url::to(['demo-geo/ol3-map-custom-controls']), 'title' => 'Custom Controls North button to map'];
        $links[] = ['url' => Url::to(['demo-geo/ol3-map-with-widget-form']), 'title' => 'Openlayers 3 Map with widget form of Yii 2!'];

        return $this->render('index', ['links' => $links]);
    }

    public function actionPlaceAutocompleteWidget()
    {
        return $this->render('placeautocompletewidget');
    }

    public function actionPointPickerWidget()
    {
        return $this->render('point-picker-widget');
    }

    public function actionPointPickerOl3Widget()
    {
        return $this->render('point-picker-ol3-widget');
    }

    public function actionPointPickerOl3BootstrapModalWidget()
    {
        return $this->render('point-picker-ol3-bootstrap-modal-widget');
    }

    public function actionOl3MapSimple()
    {
        return $this->render('ol3-map-simple');
    }

    public function actionOl3MapCustomControls()
    {
        return $this->render('ol3-map-custom-controls');
    }

    public function actionOl3MapWithWidgetForm()
    {
        return $this->render('ol3-map-with-widget-form');
    }

    public function actionTest()
    {
        /**
         * @var $urlManagerFrontEnd \yii\web\UrlManager
         * @var $urlManagerBackEnd \yii\web\UrlManager
         */
        $urlManagerFrontEnd=Yii::$app->urlManagerFrontEnd;
        $urlManagerBackendEnd=Yii::$app->urlManagerBackEnd;
        $urlManager= Yii::$app->urlManager;
        $url = $urlManagerFrontEnd->createUrl(['user/registration/confirm','key'=>'jhgfd']);
        $url = Yii::$app->urlManager->getScriptUrl();
        echo json_encode(AppHelper::getApplicationConfig('backend'));

    }

    public function actionMove(){

        $prefix = 'temp_';
        $basePath = '/var/www/html/girc/dmis/uploads/images/building_assessment';
        $path = $basePath.DIRECTORY_SEPARATOR.'gallery';
        $tempPath = $basePath.DIRECTORY_SEPARATOR.'temp';
        $pathXmlFile =$basePath.DIRECTORY_SEPARATOR.'new_old_id.xml';

        $xml = simplexml_load_file($pathXmlFile);

        $oldIds = [];
        $newIds = [];
        $oldNew = [];
        foreach($xml->records->row as $row){
            foreach($row->column as  $column){
                switch($column['name']){
                    case 'id':
                        $newIds[]=(string)$column;
                        break;
                    case 'old_id':
                        $oldIds[]=(string)$column;
                        break;
                    default:
                        break;
                }

            }
            $oldNew[(string)$row->column[1]]=(string)$row->column[0];
        }


        if(!is_dir($tempPath)){
            mkdir($tempPath);
        }
        $oldFolderNames=[];
        $oldFolderPaths=[];
        $newFolderPaths=[];
        $newTempFolderPaths=[];
        if ($handle = opendir($path)) {
            $blacklist = array('.', '..', 'somedir', 'somefile.php');
            while (false !== ($file = readdir($handle))) {
                if (!in_array($file, $blacklist)) {
                    $oldFolderNames[]=$file;
                    $oldFolderPath = $path.DIRECTORY_SEPARATOR.$file;

                    $newFolderPath = $path.DIRECTORY_SEPARATOR.$prefix.$oldNew[$file];
                    $newTempFolderPath = $tempPath.DIRECTORY_SEPARATOR.$prefix.$oldNew[$file];

                    $oldFolderPaths[]=$oldFolderPath;
                    $newFolderPaths[]=$newFolderPath;
                    $newTempFolderPaths[]=$newTempFolderPath;

                    echo $newFolderPath;


                }
            }
            closedir($handle);
        }
        echo rename('/var/www/html/girc/dmis/uploads/images/building_assessment/gallery/temp_111','/var/www/html/girc/dmis/uploads/images/building_assessment/gallery/temp_10');
        echo 'done';


    }
}

