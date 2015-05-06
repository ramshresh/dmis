<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/22/15
 * Time: 9:42 AM
 */

namespace api\modules\reporting\controllers;



use common\modules\reporting\models\Damage;
use common\modules\reporting\models\EmergencySituation;
use common\modules\reporting\models\Event;
use common\modules\reporting\models\Incident;
use common\modules\reporting\models\Need;
use common\modules\reporting\models\ReportItem;
use Symfony\Component\Console\Helper\TableHelper;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\ColumnSchema;
use yii\db\pgsql\Schema;
use yii\helpers\Json;

class ReportItemController extends \yii\rest\ActiveController
{
    public $modelClass = 'api\common\models\ReportItem';
    public function init(){
        parent::init();
        header("Access-Control-Allow-Origin: *");
    }
    public function actions(){
        return array_merge(parent::actions(), [
            'create' => null, // Disable create
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function ($action) {
                    /* @var $model  \api\common\models\ReportItem */
                    /* @var $query \yii\db\Query */
                    $model = new $this->modelClass;
                    $query = $model::find();
                    //$query->joinWith('event');
                    //$query->joinWith('incident');
                    //$query->joinWith('need');
                    //$query->joinWith('damage');
                   // $query->joinWith('geometries');
                    $dataProvider = new ActiveDataProvider(['query' => $query]);

                   // $query->andFilterWhere(['=', 'event.timestamp_occurance', "2015-02-12 02:30:40"]);
                   // $query->andWhere(['=','event.id','256']);


                  //  $query->andWhere(['=','geometry.id','134']);

                    if (!empty($_GET)) {
                        // Filter based on model attribute values with = operator
                        foreach ($_GET as $key => $value) {

                            //Compare with model attributes
                            if ($model->hasAttribute($key)) {
                                $query->andFilterWhere(['=', $key, $value]);
                            }else{
                                //try exploding attributes
                                $param = explode('->',$key,2);
                                if(in_array($param[0],$model->extraFields())){
                                    if($model->getRelation($param[0])->multiple){
                                        //The relation is: current model has_many related models
                                        //@todo Implement
                                    }else{
                                        //The relation is: current model has_one related models
                                        $query->joinWith($param[0]);
                                        $key = $param[0].'.'.$param[1];
                                        $query->andFilterWhere(['=', $key, $value]);
                                    }

                                }
                            }
                        }
                        // filter based on date
                        if(isset($_GET['datefilter_from']))
                            {
                                $query->andWhere("timestamp_created >= '".$_GET['datefilter_from']."' ");
                            }
                        if(isset($_GET['datefilter_to']))
                            {
                                $query->andWhere("timestamp_created <= '".$_GET['datefilter_to']."'");
                            }
                        }
                    return $dataProvider;
                }
            ]
        ]);
    }

    public function actionDescribeFeatureType(){
        if(!isset($_GET['type'])){
            throw new Exception('parameter < type > must be specified! ie 0,1,2,3,4 for Emergency Situation, Event,...,Need ');
        }
        switch($_GET['type']){
            case ReportItem::TYPE_EMERGENCY_SITUATION:
                return EmergencySituation::getTableSchema()->getColumnNames();
            case ReportItem::TYPE_EVENT:
                return Event::getTableSchema()->getColumnNames();
            case ReportItem::TYPE_EMERGENCY_SITUATION:
                return EmergencySituation::getTableSchema()->getColumnNames();
            case ReportItem::TYPE_INCIDENT:
                return Incident::getTableSchema()->getColumnNames();
            case ReportItem::TYPE_DAMAGE:
                return Damage::getTableSchema()->getColumnNames();
            case ReportItem::TYPE_NEED:
                return Need::getTableSchema()->getColumnNames();

        }
    }


}