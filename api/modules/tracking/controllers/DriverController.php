<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/22/15
 * Time: 9:42 AM
 */

namespace api\modules\tracking\controllers;



use common\modules\reporting\models\Damage;
use common\modules\reporting\models\EmergencySituation;
use common\modules\reporting\models\Event;
use common\modules\reporting\models\Geometry;
use common\modules\reporting\models\Incident;
use common\modules\reporting\models\Need;
use common\modules\reporting\models\ReportItem;
use common\modules\tracking\actions\rest\DriverRegistrationAction;
use common\modules\tracking\models\Coordinate;
use common\modules\tracking\models\Driver;
use common\modules\tracking\models\Status;
use Symfony\Component\Console\Helper\TableHelper;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\ColumnSchema;
use yii\db\pgsql\Schema;
use yii\db\Query;
use yii\helpers\Json;

class DriverController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\modules\tracking\models\Driver';
    public function init(){
        parent::init();
        header("Access-Control-Allow-Origin: *");
    }
    public function actions(){
        return array_merge(parent::actions(), [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function ($action) {
                    /* @var $model  \common\modules\tracking\models\Driver */
                    /* @var $query \yii\db\ActiveQuery */
                    $model = new $this->modelClass;
                    $query = $model::find();
                    $dataProvider = new ActiveDataProvider(['query' => $query]);
                    if (!empty($_GET)) {
                        // Filter based on model attribute values with like operator
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
                    }
                    return $dataProvider;
                }
            ],
            'update' => [
                'class' => 'common\modules\tracking\actions\rest\DriverUpdateAction',
                'modelClass' => $this->modelClass,
                //'checkAccess' => [$this, 'checkAccess'],
                //'scenario' => SCENARIO_UPDATE,
            ],
            'registration' => [
                'class' => 'common\modules\tracking\actions\rest\DriverRegistrationAction',
            ]
        ]);
    }

    public function actionUnique(){
        $property = $_GET['property'];
        $propertyAlias=(isset($_GET['property_alias']))?$_GET['property_alias']:$property;
        $count = (isset($_GET['count']))?$_GET['count']:true;
        $countAlias = (isset($_GET['count_alias']))?$_GET['count_alias']:'count';
        /*SELECT COUNT(*), "status" FROM  "tracking"."status" GROUP BY "status" ORDER BY "status" DESC*/
        $query = new Query();
        if($count) {
            $query->addSelect([$countAlias=>'COUNT(*)']);
        }
        $query->addSelect([$propertyAlias=>$property]);
        $query->from([Driver::tableName()]);
        $query->groupBy($propertyAlias);
        $query->orderBy([$countAlias=>SORT_ASC]);
        return $query->all();
    }
}