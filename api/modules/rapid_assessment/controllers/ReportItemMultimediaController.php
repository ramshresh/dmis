<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/22/15
 * Time: 9:42 AM
 */

namespace api\modules\rapid_assessment\controllers;


use yii\data\ActiveDataProvider;
use yii\db\Query;

class ReportItemMultimediaController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\modules\rapid_assessment\models\ReportItemMultimedia';

    public
    function actions()
    {
        return array_merge(
            parent::actions(), [
                'create' => [
                    'class' => 'common\modules\rapid_assessment\actions\ReportItemMultimediaCreateAction',
                    'modelClass' => $this->modelClass,
                ],
            ]
        );
    }

    public
    function init()
    {
        parent::init();
        header("Access-Control-Allow-Origin: *");
    }
}