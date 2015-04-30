<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/22/15
 * Time: 9:42 AM
 */

namespace api\modules\rapid_assessment\controllers;


use common\modules\rapid_assessment\models\ItemClass;
use common\modules\rapid_assessment\models\ItemType;
use common\modules\rapid_assessment\models\ReportItem;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\helpers\Json;

class ReportItemController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\modules\rapid_assessment\models\ReportItem';

    public function actions()
    {
        return array_merge(
            parent::actions(), [
                'create' => [
                    'class' => 'common\modules\rapid_assessment\actions\ReportItemCreateAction',
                    'modelClass' => $this->modelClass,
                ],
                'index' => [
                    'class' => 'yii\rest\IndexAction',
                    'modelClass' => $this->modelClass,
                    'prepareDataProvider' => function ($action) {
                        /* @var $model  \common\modules\tracking\models\search\Status */
                        /* @var $query \yii\db\ActiveQuery */
                        $model = new $this->modelClass;
                        $query = $model::find();
                        $dataProvider = new ActiveDataProvider(['query' => $query]);
                        if (!empty($_GET)) {
                            // Filter based on model attribute values with like operator
                            foreach ($_GET as $key => $value) {
                                if ($model->hasAttribute($key)) {
                                    //Compare with model attributes
                                    if (strpos($value, ',')) {
                                        // Comma separated values is exploded to array  to make OR WHERE
                                        $values = explode(',', $value);
                                        foreach ($values as $value) {
                                            $query->orWhere([$key => $value]);
                                        }
                                    }else {
                                        // Single Value
                                        $query->andFilterWhere(['=', $key, $value]);
                                    }
                                }else {
                                    //try exploding attributes
                                    $param = explode('->', $key, 2);
                                    if (in_array($param[0], $model->extraFields())) {
                                        if ($model->getRelation($param[0])->multiple) {
                                            //The relation is: current model has_many related models
                                            //@todo Implement
                                        }else {
                                            //The relation is: current model has_one related models
                                            $query->joinWith($param[0]);
                                            $key = $param[0] . '.' . $param[1];
                                            if (strpos($value, ',')) {
                                                // Comma separated values is exploded to array  to make OR WHERE
                                                $values = explode(',', $value);
                                                foreach ($values as $value) {
                                                    $query->orWhere([$key => $value]);
                                                }
                                            }else {
                                                $query->andFilterWhere(['=', $key, $value]);
                                            }
                                        }
                                    }
                                }
                            }

                            if (isset($_GET['dwithin'])) {
                                //$pointWkt="'POINT(81.5 29.5)'";
                                //$polygonWkt="'POLYGON((-81 -27,-81 27,181 27,81 -27,-81 -27))'";
                                $polygonWkt = $_GET['dwithin'];
                                $srid = 4326;
                                /*SELECT ST_Within(
                                    (select ST_GeomFromText('POINT(81.5 29.5)',4326))
                                    ,(select ST_GeomFromText('POLYGON((81 29,81 30,85 30,85 29,81 29))',4326))
                                ) As point_within_polygon*/
                                /* select *from "tracking".tracking_driver as driver
     where(
         SELECT ST_Within(
                                     driver.geom
                                     ,(select ST_GeomFromText('POLYGON((-180 -90,-180 90,180 90,180 -90,-180 -90))',4326))
         ) As point_within_polygon
     )*/
                                /*
                                 WITH driver AS ( SELECT *,ST_Within(geom,(select ST_GeomFromText('POLYGON((-180 -90,-180 90,180 90,180 -90,-180 -90))',4326))) as if_within_polygon from "tracking".tracking_driver)
                                SELECT * FROM driver where driver.if_within_polygon=true;
                                 */


                                $query->andWhere("(SELECT ST_Within(geom,(select ST_GeomFromText($polygonWkt,$srid))))");

                            }
                        }

                        /*           $result = [];
                                   // return $query->createCommand()->sql;
                                   $with_ids = true;
                                   if ($with_ids) {
                                       $ids = [];
                                       foreach ($query->createCommand()->queryAll() as $single) {
                                           $ids[] = $single['id'];
                                       }
                                   }
                                   $property = 'type';
                                   $query = new Query();
                                   $query->addSelect(['count' => 'COUNT(*)']);
                                   $query->addSelect(['value' => $property]);
                                   $query->from([$model::tableName()]);
                                   $query->groupBy($property);
                                   $query->orderBy(['count' => SORT_ASC]);

                                   return ['ids' => $ids, 'data' => $query->createCommand()->queryAll()];*/

                        return $dataProvider;
                    }
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

    public
    function actionUnique()
    {
        /**
         * @var $model \common\modules\rapid_assessment\models\ReportItem
         */
        $model = new $this->modelClass;
        $property = $_GET['property'];
        $propertyAlias = (isset($_GET['property_alias'])) ? $_GET['property_alias'] : 'value';
        $count = (isset($_GET['count'])) ? $_GET['count'] : true;
        $countAlias = (isset($_GET['count_alias'])) ? $_GET['count_alias'] : 'count';
        /*SELECT COUNT(*), "status" FROM  "tracking"."status" GROUP BY "status" ORDER BY "status" DESC*/
        $query = new Query();
        if ($count) {
            $query->addSelect([$countAlias => 'COUNT(*)']);
        }
        $query->addSelect([$propertyAlias => $property]);
        $query->from([$model::tableName()]);
        $query->groupBy($propertyAlias);
        $query->orderBy([$countAlias => SORT_ASC]);

        return $query->all();
    }

    public
    function actionAttributes()
    {
        /**
         * @var $model \common\modules\rapid_assessment\models\ReportItem
         */
        $model = new $this->modelClass;
        $model->scenario = 'search';
        return $model->safeAttributes();
    }


    public function actionItemClass()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                //$out = self::getSubCatList($cat_id);
                $items = ItemClass::find()
                    ->where('item_name=:item_name', [':item_name' => $cat_id])
                    ->all();

                foreach ($items as $item) {
                    $row = [];
                    $row['id'] = $item->attributes['name'];
                    $row['name'] = $item->attributes['name'];
                    array_push($out, $row);
                }

// the getSubCatList function will query the database based on the
// cat_id and return an array like below:
// [
// ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
// ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
// ]
                echo Json::encode(['output' => $out, 'selected' => '']);
                \Yii::$app->end();
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionGetDropDownItemChildrenNames()
    {
        /**
         * @var $model \common\modules\rapid_assessment\models\ItemType
         */
        $query = new ActiveQuery(ItemType::className());
        if (isset($_GET['parent_type'])) {
            $query->where('LOWER(type)=:type', [':type' => strtolower($_GET['parent_type'])]);
        }
        if (isset($_GET['parent_name'])) {
            $query->andWhere(['LIKE', 'LOWER(item_name)', strtolower($_GET['parent_name'])]);
        }
        $model = $query->one();

        if ($model) {
            $childrenQuery = $model->getChildren();
            if (isset($_GET['item_name'])) {
                $childrenQuery->andWhere(['LIKE', 'LOWER(item_name)', strtolower($_GET['item_name'])]);
            }

            return \yii\helpers\ArrayHelper::map(
                $childrenQuery->all(), 'item_name', 'item_name');
        }else {
            return [];
        }
    }

    public function actionGetDropDownItemNames()
    {
        $query = new ActiveQuery(ItemType::className());
        if (isset($_GET['item_name'])) {
            $query->where('LOWER(type)=:type', [':type' => strtolower($_GET['item_type'])]);
        }
        if (isset($_GET['item_name'])) {
            $query->andWhere(['LIKE', 'LOWER(item_name)', strtolower($_GET['item_name'])]);
        }

        return \yii\helpers\ArrayHelper::map(
            $query->all(), 'item_name', 'item_name');
    }

    public function actionTimeLine(){
        $tableName =ReportItem::tableName();
        if(!isset($_GET['type'])){
            throw new Exception('timeline type must be set!');
        }
        $type = $_GET['type'];

        if(!isset($_GET['attribute'])){
            throw new Exception('attribute to count and group by must be set!');
        }
        $attribute =$_GET['attribute'];

        switch(strtolower($_GET['type'])){
            case 'interval':
                if(!isset($_GET['interval'])){
                    throw new Exception('Interval must be set to count and group by must be set!');
                }
                $interval =$_GET['interval'];

                $sql= <<<SQL
            WITH groupedby_timestamp AS (
                SELECT  date_trunc(:interval, timestamp_occurance::TIMESTAMP), count($attribute)
                                    FROM "rapid_assessment".report_item
                                    GROUP BY date_trunc(:interval, timestamp_occurance::TIMESTAMP)
                                    ORDER BY date_trunc(:interval, timestamp_occurance::TIMESTAMP)
            )
            select date_part('epoch', date_trunc) AS unixtime ,groupedby_timestamp.count AS count FROM groupedby_timestamp ;
SQL;
                $query = \Yii::$app->db->createCommand($sql)
                    ->bindParam(':interval',$interval)
                    ->queryAll();
                break;
            case 'continuous':
                break;
            default:
                'break';
        }

        return $query;

        /*
            WITH groupedby_timestamp AS (
                SELECT date_trunc('minute', timestamp_occurance::TIMESTAMP), count(id)
                                    FROM "rapid_assessment".report_item
                                    GROUP BY date_trunc('minute', timestamp_occurance::TIMESTAMP)
                                    ORDER BY date_trunc('minute', timestamp_occurance::TIMESTAMP)
            )
            select date_part('epoch', date_trunc) AS unixtime ,groupedby_timestamp.count AS count FROM groupedby_timestamp ;
         */
    }

}