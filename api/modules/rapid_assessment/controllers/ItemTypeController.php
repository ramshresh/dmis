<?php

namespace api\modules\rapid_assessment\controllers;

use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\db\Query;
use yii\rest\Controller;

class ItemTypeController extends Controller
{
    public $modelClass = 'common\modules\rapid_assessment\models\ItemType';

    public function init()
    {
        parent::init();
        header("Access-Control-Allow-Origin: *");
    }

    public function actions()
    {
        return array_merge(parent::actions(), [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => function ($action) {
                    /* @var $model  \common\modules\tracking\models\search\Status */
                    /* @var $query \yii\db\ActiveQuery */
                    $model = new $this->modelClass;
                    $query = $model::find();

                    if (!empty($_GET)) {
                        // Filter based on model attribute values with like operator
                        foreach ($_GET as $key => $value) {

                            //Compare with model attributes
                            if ($model->hasAttribute($key)) {
                                $query->andFilterWhere(['=', $key, $value]);
                            } else {
                                //try exploding attributes
                                $param = explode('->', $key, 2);
                                if (in_array($param[0], $model->extraFields())) {
                                    if ($model->getRelation($param[0])->multiple) {
                                        //The relation is: current model has_many related models
                                        //@todo Implement
                                    } else {
                                        //The relation is: current model has_one related models
                                        $query->joinWith($param[0]);
                                        $key = $param[0] . '.' . $param[1];
                                        $query->andFilterWhere(['=', $key, $value]);
                                    }

                                }
                            }
                        }
                    }
                    $dataProvider = new ActiveDataProvider(['query' => $query]);
                    return $dataProvider;
                }
            ],

        ]);
    }

    public function actionUnique()
    {
        /**
         * @var $model \common\modules\tracking\models\sql_views\TrackingDriver
         */
        $model = new $this->modelClass;
       // $model->scenario = 'search';

        $attribute =$_GET['attribute'];
        $attributeAlias = (isset($_GET['attribute_alias'])) ? $_GET['attribute_alias'] : 'value';
        $count = (isset($_GET['count'])) ? $_GET['count'] : true;
        $countAlias = (isset($_GET['count_alias'])) ? $_GET['count_alias'] : 'count';
        $meta=(isset($_GET['meta'])) ? $_GET['meta'] : false;
        $result=[];
        if(strtolower($attribute)=='all'){
            foreach($model->safeAttributes() as $attribute){
                $dbColumn=$model::getTableSchema()->getColumn($attribute);
                $dbColumnName=$dbColumn->name;
                $dbColumnType=$dbColumn->dbType;
                if(in_array($dbColumnType,['json','hstore','_varchar'])){
                    break;
                }
                    $query = new Query();
                    if ($count) {
                        $query->addSelect([$countAlias => 'COUNT(*)']);
                    }
                    $query->addSelect([$attributeAlias => $dbColumnName]);
                    $query->from([$model::tableName()]);
                    $query->groupBy($attributeAlias);
                    $query->orderBy([$countAlias => SORT_DESC]);
                    $ir = [];
                    $ir['attribute'] = $attribute;
                    $ir['unique_values'] = $query->all();
                if($meta){
                    $ir['db_column']=$dbColumn;
                }
                    array_push($result, $ir);

            }
        }else{
            $dbColumn=$model::getTableSchema()->getColumn($attribute);
            $dbColumnName=$dbColumn->name;
            $dbColumnType=$dbColumn->dbType;
            if(in_array($dbColumnType,['json','hstore','_varchar'])){
                throw new Exception('Cannot count unique value of column');
            }
            /*SELECT COUNT(*), "status" FROM  "tracking"."status" GROUP BY "status" ORDER BY "status" DESC*/
            $query = new Query();
            if ($count) {
                $query->addSelect([$countAlias => 'COUNT(*)']);
            }
            $query->addSelect([$attributeAlias => $dbColumnName]);
            $query->from([$model::tableName()]);
            $query->groupBy($attributeAlias);
            $query->orderBy([$countAlias => SORT_DESC]);

            $ir = [];
            $ir['attribute'] = $attribute;
            $ir['unique_values'] = $query->all();
            if($meta){
                $ir['db_column']=$dbColumn;
            }
            array_push($result, $ir);
        }

        return $result;

    }

    public function actionAttributes()
    {
        /**
         * @var $model \common\modules\tracking\models\search\Status
         */
        $propertyAlias = (isset($_GET['property_alias'])) ? $_GET['property_alias'] : 'value';
        $countAlias = (isset($_GET['count_alias'])) ? $_GET['count_alias'] : 'count';
        $model = new $this->modelClass;
        return $model::getTableSchema()->getColumnNames();

    }

    public function actionInfo()
    {
        /**
         * @var $model \common\modules\tracking\models\search\Status
         */
        $propertyAlias = (isset($_GET['property_alias'])) ? $_GET['property_alias'] : 'value';
        $countAlias = (isset($_GET['count_alias'])) ? $_GET['count_alias'] : 'count';
        $model = new $this->modelClass;
        $model->scenario = 'search';
        foreach($model->safeAttributes() as $attribute){
            $dbColumnName=$model::getTableSchema()->getColumn($attribute);
            return $dbColumnName;
        }
        return $model->safeAttributes();
        $columnNames = $model::getTableSchema()->getColumnNames();
        $result = [];
        foreach ($columnNames as $column) {
            $query = new Query();
            $query->addSelect([$countAlias => 'COUNT(*)']);
            $query->addSelect([$propertyAlias => $column]);
            $query->from([$model::tableName()]);
            $query->groupBy($propertyAlias);
            $query->orderBy([$countAlias => SORT_ASC]);
            if (in_array($model::getTableSchema()->getColumn($column)->dbType, ['json'])) {
                break;
            }
            $query->createCommand()->queryAll();
            $ir = [];
            $ir['column_name'] = $column;
            $ir['unique_values'] = $query->all();
            array_push($result, $ir);
        }
        return $result;
    }
}
