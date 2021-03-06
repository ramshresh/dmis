<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/31/2015
 * Time: 12:19 PM
 */

namespace api\modules\heritage_assessment\controllers;

use common\components\helpers\GeoJsonHelper;
use yii\helpers\Json;
use yii\web\Response;
use common\modules\heritage_assessment\models\search\HeritageSearch;
use common\modules\vdc\models\NepalVdc;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class HeritageController extends ActiveController
{
    public $modelClass = 'common\modules\heritage_assessment\models\Heritage';

    public function init()
    {
        parent::init();
        header("Access-Control-Allow-Origin: *");
    }
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/javascript'] = Response::FORMAT_JSONP;
        return $behaviors;
    }
    public function actions()
    {
        return ArrayHelper::merge(
            parent::actions(),
            [
                'create'=>[
                    'class'=>'common\modules\heritage_assessment\actions\rest\HeritageCreateAction',
                    'modelClass'=>$this->modelClass,
                ],
                'index' => [
                    'class' => 'yii\rest\IndexAction',
                    'modelClass' => $this->modelClass,
                    'prepareDataProvider' => function ($action) {
                        /* @var $model \common\modules\building_assessment\models\BuildingHousehold */
                        /* @var $model \yii\db\ActiveQuery */

                        $model = new $this->modelClass;
                        $query = $model::find();
                        $dataProvider = new ActiveDataProvider(['query' => $query]);
                        $queryParams = \Yii::$app->request->queryParams;

                        if (!empty($queryParams)) {
                            if (isset($queryParams['search_attribute']) && isset($queryParams['search_value'])) {
                                if ($model->hasAttribute($queryParams['search_attribute'])) {
                                    $query->andFilterWhere(['=', $queryParams['search_attribute'], $queryParams['search_value']]);
                                }
                            }

                            // Filter based on model attribute values with like operator
                            foreach ($queryParams as $key => $value) {
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

                            // checkbox list
                            /*if (isset($queryParams['occupancy_type'])) {
                                $query->andFilterWhere(['in', 'occupancy_type', $queryParams['occupancy_type']]);
                            }*/


                            // filter based on date
                            if (isset($queryParams['datefilter_from'])) {
                                $query->andWhere("timestamp_occurance >= '" . $queryParams['datefilter_from'] . "' ");
                            }
                            if (isset($queryParams['datefilter_to'])) {
                                $query->andWhere("timestamp_occurance <= '" . $queryParams['datefilter_to'] . "' ");
                            }

                            /*if (isset($queryParams['district_name'])) {
                                $subQuery = new ActiveQuery(NepalVdc::className());
                                $subQuery->addSelect(['dgeom' => 'ST_Union(geom)']);
                                $subQuery->andFilterWhere(['like', 'dname', $queryParams['district_name']]);

                                $query->leftJoin(['selDist' => $subQuery], [], []);

                                //$geom=$subQuery->createCommand()->queryOne()->geom;
                                $query->andWhere("(SELECT ST_Within(geom,st_collect)))");
                            }*/

                            if (isset($queryParams['dwithin'])) {
                                //$pointWkt="'POINT(81.5 29.5)'";
                                //$polygonWkt="'POLYGON((-81 -27,-81 27,181 27,81 -27,-81 -27))'";
                                $polygonWkt = $queryParams['dwithin'];
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
                        $dataProvider->pagination = false;
                        return $dataProvider;
                    }
                ]
            ]
        );
    }

    public function actionUnique()
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
        $query->andWhere(['IS NOT', $property, null]);

        $query->groupBy($propertyAlias);
        $query->orderBy([$countAlias => SORT_ASC]);

        return $query->all();
    }

    public function actionUniqueUsers(){
        /**
         * @var $model \common\modules\rapid_assessment\models\ReportItem
         */
        $model = new $this->modelClass;
        $relation = $model->getRelation('user');
        $relationModelClass=$relation->modelClass;
        $relationLink = $relation->link;
        $linksFrom = array_keys($relationLink);


        $linkFrom=null;
        $linkTo=null;


            if(sizeof($linksFrom)>1){
                throw new Exception('Cound not determine unique attribute because user is related by multiple foreign key');
            }else{
                $linkFrom = $linksFrom[0];
                $linkTo = $relationLink[$linkFrom];
            }

        $property=$linkTo;
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
        $query->andWhere(['IS NOT', $property, null]);
        $query->groupBy($propertyAlias);
        $query->orderBy([$countAlias => SORT_DESC]);

        $userCountMap=ArrayHelper::map($query->all(),$propertyAlias,$countAlias);

        $keysMap=array_keys($userCountMap);

        $query1= new ActiveQuery($relationModelClass);
        $query1->andFilterWhere(['in',$linkFrom,array_map(create_function('$value', 'return (int)$value;'),$keysMap)]); //@see: http://usrportage.de/archives/808-Convert-an-array-of-strings-into-an-array-of-integers.html
        $userEmailMap = ArrayHelper::map($query1->all(),$linkFrom,'email');
        return ['order'=>'SORT_DESC','keys'=>$keysMap,'count'=>$userCountMap,'email'=>$userEmailMap];
    }

    public function actionGalleryImages(){
        /**
         * @var $model \common\modules\heritage_assessment\models\Heritage
         */
        $model = new $this->modelClass;
        $query = $model::find();

        $queryParams = \Yii::$app->request->queryParams;

        if (isset($queryParams['dwithin'])) {
            //$pointWkt="'POINT(81.5 29.5)'";
            //$polygonWkt="'POLYGON((-81 -27,-81 27,181 27,81 -27,-81 -27))'";
           // echo $polygonWkt;

            $polygonWkt = "'".$queryParams['dwithin']."'";
           // echo $polygonWkt;exit;
            $srid = 4326;
            $query->andWhere("(SELECT ST_Within(geom,(select ST_GeomFromText($polygonWkt,$srid))))");

        }


        $heritages = $query->all();



        $galleryImages=[];
        foreach($heritages as $heritage){
            if(!empty($heritage->galleryImages)){
                /*foreach($heritage->galleryImages as $images){
                    $galleryImages[] = $images;
                }*/
                $galleryImages[] = $heritage->galleryImages[0];
            }
        }

        $provider = new ArrayDataProvider([
            'allModels' => $galleryImages,
            'sort' => [
                'attributes' => ['id'],
            ],
            'pagination' => false,
        ]);

        return $provider;

    }

    public function actionSearch(){

        /* @var $model \common\modules\heritage_assessment\models\Heritage */
        /* @var $query \yii\db\ActiveQuery */

        $model = new $this->modelClass;
        $query = $model::find(['scenario'=>'map']);

        $queryParams = \Yii::$app->request->queryParams;
      //  echo Json::encode($queryParams);exit;
        if (!empty($queryParams)) {
            if (isset($queryParams['search_attribute']) && isset($queryParams['search_value'])) {
                if ($model->hasAttribute($queryParams['search_attribute'])) {
                    $query->andFilterWhere(['=', $queryParams['search_attribute'], $queryParams['search_value']]);
                }
            }

            // Filter based on model attribute values with like operator
            foreach ($queryParams as $key => $value) {
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

            // checkbox list
            /*if (isset($queryParams['occupancy_type'])) {
                $query->andFilterWhere(['in', 'occupancy_type', $queryParams['occupancy_type']]);
            }*/


            // filter based on date
            if (isset($queryParams['datefilter_from'])) {
                $query->andWhere("timestamp_occurance >= '" . $queryParams['datefilter_from'] . "' ");
            }
            if (isset($queryParams['datefilter_to'])) {
                $query->andWhere("timestamp_occurance <= '" . $queryParams['datefilter_to'] . "' ");
            }

            /*if (isset($queryParams['district_name'])) {
                $subQuery = new ActiveQuery(NepalVdc::className());
                $subQuery->addSelect(['dgeom' => 'ST_Union(geom)']);
                $subQuery->andFilterWhere(['like', 'dname', $queryParams['district_name']]);

                $query->leftJoin(['selDist' => $subQuery], [], []);

                //$geom=$subQuery->createCommand()->queryOne()->geom;
                $query->andWhere("(SELECT ST_Within(geom,st_collect)))");
            }*/

            if (isset($queryParams['bbox'])) {

                /*SELECT *
                FROM "heritage_assessment".heritage h
WHERE h.geom && ST_MakeEnvelope(85.311838362075, 27.708511041836, 85.311838362075, 27.708511041838, 4326);
                */
                $srid = 4326;
                $bboxParam = explode(',',$queryParams['bbox']);
                $minLon = $bboxParam[0];
                $minLat = $bboxParam[1];
                $maxLon = $bboxParam[2];
                $maxLat = $bboxParam[3];
                /*
                 * @see: http://gis.stackexchange.com/questions/25797/select-bounding-box-using-postgis
                 */
                $query->andWhere("geom && ST_MakeEnvelope($minLon, $minLat, $maxLon, $maxLat, $srid)");
            }
            if (isset($queryParams['dwithin'])) {
                //'POLYGON((85.311838362073 27.708511041836,85.311838362073 27.708511041838,85.311838362075 27.708511041838,85.311838362075 27.708511041836,85.311838362073 27.708511041836))'
                //$pointWkt="'POINT(81.5 29.5)'";
                //$polygonWkt="'POLYGON((-81 -27,-81 27,181 27,81 -27,-81 -27))'";
                $polygonWkt = $queryParams['dwithin'];
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);

        if(isset($queryParams['format'])){
            switch(strtolower($queryParams['format'])){
                case 'jsonp':
                    if(!isset($_GET['callback'])){
                        throw new Exception('callback must be provided.');
                    }
                    $callback = isset($_GET['callback'])?$_GET['callback']:'getJson';
                    \Yii::$app->response->format = Response::FORMAT_JSONP;
                    $return= ['data'=>$this->serializeData($dataProvider),'callback'=>$callback];
                    break;
                case 'xml':
                    \Yii::$app->response->format = Response::FORMAT_XML;
                    $return =$dataProvider;
                    break;
                case 'geojson':
                    \Yii::$app->response->format = 'geoJson';
                    $return = $dataProvider;
                    break;
                case 'geojsonp':
                    if(!isset($_GET['callback'])){
                        throw new Exception('callback must be provided.');
                    }
                    $callback = isset($_GET['callback'])?$_GET['callback']:'getJson';
                    \Yii::$app->response->format = 'geoJsonp';
                    $return= ['data'=>$this->serializeData($dataProvider),'callback'=>$callback];
                    break;
                default:
                    \Yii::$app->response->format = Response::FORMAT_JSON;
                    $return = $dataProvider;
                    break;

            }
            return $return;
        }
        return $dataProvider;

    }
}