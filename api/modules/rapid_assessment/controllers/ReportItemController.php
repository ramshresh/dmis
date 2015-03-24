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

class ReportItemController extends \yii\rest\ActiveController
{
    public $modelClass = 'common\modules\rapid_assessment\models\ReportItem';

    public function init()
    {
        parent::init();
        header("Access-Control-Allow-Origin: *");
    }

    public function actions()
    {
        return array_merge(parent::actions(), [
            'create'=>[
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

                        if(isset($_GET['dwithin'])){
                            //$pointWkt="'POINT(81.5 29.5)'";
                            //$polygonWkt="'POLYGON((-81 -27,-81 27,181 27,81 -27,-81 -27))'";
                            $polygonWkt=$_GET['dwithin'];
                            $srid =4326;
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

                    }return $query->createCommand()->queryAll();
                    return $dataProvider;
                }
            ],
        ]);
    }


    public function actionUnique(){
        /**
         * @var $model \common\modules\rapid_assessment\models\ReportItem
         */
        $model = new $this->modelClass;
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
        $query->from([$model::tableName()]);
        $query->groupBy($propertyAlias);
        $query->orderBy([$countAlias=>SORT_ASC]);

        return $query->all();
    }

    public function actionAttributes(){
        /**
         * @var $model \common\modules\rapid_assessment\models\ReportItem
         */
        $model = new $this->modelClass;
        $model->scenario = 'search';
        return $model->getAttributes();
    }
}