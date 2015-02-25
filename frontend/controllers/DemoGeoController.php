<?php
namespace frontend\controllers;

use common\components\MyBaseContoller;
use common\modules\reporting\models\Damage;
use common\modules\reporting\models\Geometry;
use Yii;
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
        $links[] = ['url' => Url::to('place-autocomplete-widget'), 'title' => 'Place Autocomplete Widget'];
        $links[] = ['url' => Url::to('point-picker-widget'), 'title' => 'PointPickerWidget'];
        $links[] = ['url' => Url::to('point-picker-ol3-widget'), 'title' => 'PointPicker Widget with Openlayers 3 and Jquery Ui Dialog'];
        $links[] = ['url' => Url::to('point-picker-ol3-bootstrap-modal-widget'), 'title' => 'PointPicker Widget with Openlayers 3 and Bootstrap Modal'];
        $links[] = ['url' => Url::to('ol3-map-simple'), 'title' => 'Simple Openlayers 3 Map'];
        $links[] = ['url' => Url::to('ol3-map-custom-controls'), 'title' => 'Custom Controls North button to map'];
        $links[] = ['url' => Url::to('ol3-map-with-widget-form'), 'title' => 'Openlayers 3 Map with widget form of Yii 2!'];

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
        $model = new Damage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo 'saved!';
            $g1 = new Geometry();
            $g1->type = 'POINT';
            $g1->reportitem_id = $model->reportitem_id;
            $g1->save();
            $g2 = new Geometry();
            $g2->type = 'POLYGON';
            $g2->reportitem_id = $model->reportitem_id;
            $g2->save();
            $g3 = new Geometry();
            $g3->type = 'linestring';
            $g3->reportitem_id = $model->reportitem_id;
            $g3->save();

            foreach ($model->geometries as $geometry) {
                var_dump($geometry->attributes);
            }

        } else {

            return $this->render('test', [
                'model' => $model,
            ]);
        }

    }

}
