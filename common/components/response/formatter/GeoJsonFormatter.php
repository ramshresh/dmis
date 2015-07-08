<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 7/7/2015
 * Time: 2:14 AM
 *
 * https://github.com/samdark/yii2-cookbook/blob/master/book/using-yii-in-third-party-apps.md
 */


namespace common\components\response\formatter;


use common\components\response\formatter\geojson\GeoJson;
use common\components\response\formatter\geojson\models\Point;
use yii\helpers\Json;
use yii\helpers\VarDumper;
use yii\web\Response;
use yii\web\ResponseFormatterInterface;

class GeoJsonFormatter implements ResponseFormatterInterface{
    /**
     * @var string the Content-Type header for the response
     */
    public $contentType = 'application/json';
    /**
     * @var string the XML version
     */
    public $version = '1.0';
    /**
     * @var string the XML encoding. If not set, it will use the value of [[Response::charset]].
     */
    public $encoding;
    /**
     * @var string
     */
    public $type='FeatureCollection';
    /**
     * @var string
     */
    public $featureGeometryType='Point';

    /**
     * Formats the specified response.
     * @param Response $response the response to be formatted.
     */
    public function format($response)
    {
        $charset = $this->encoding === null ? $response->charset : $this->encoding;
        if (stripos($this->contentType, 'charset') === false) {
            $this->contentType .= '; charset=' . $charset;
        }
        $response->getHeaders()->set('Content-Type', $this->contentType);
        if ($response->data !== null) {
            $geoJson = new GeoJson();
            $this->buildGeoJson($geoJson,$response->data);
            $response->content = Json::encode($geoJson->output());
        }

    }

    public function buildGeoJson($geoJson,$data){
        if (is_object($data)) {
           // echo '1';
            if ($data instanceof Arrayable) {
             //   echo '1a';
            } else {
               // echo '1b';
                echo Json::encode($data);
                $array = [];
                foreach ($data as $name => $value) {
                    $array[$name] = $value;
                }
                $this->buildGeoJson($geoJson,$array);
            }
        } elseif (is_array($data)) {
            //echo '2';
            foreach ($data as $name => $value) {
                if (is_int($name) && is_object($value)) {
              //      echo '2a';
                    $point= new Point();
                    $point->value=[$value->longitude, $value->latitude];
                    $point->extendedData = $value->getAttributes();
                    $geoJson->add($point);
                    //$this->buildGeoJson($geoJson,$value);
                } elseif (is_array($value) || is_object($value)) {
                //    echo '2b';
                    $point= new Point();
                    $point->value=[$value['longitude'], $value['latitude']];
                    $point->extendedData = $value;
                    $geoJson->add($point);
                    //$this->buildGeoJson($geoJson,$value);
                } else {
                  //  echo '2c';
                    $point= new Point();
                    $coordinates=[];
                    if($name=='latitude'){
                        $coordinates['latitude']=$value;
                    }elseif($name=='longitude'){
                        $coordinates['longitude']=$value;
                    }else{
                    //    echo '2cI';
                        echo Json::encode($value);
                        $point->extendedData=[$name=>$value];
                    }

                    echo '*********************';
                    $geoJson->add($point);
                }
            }
        } else {
           // echo '3';
        }
    }
}