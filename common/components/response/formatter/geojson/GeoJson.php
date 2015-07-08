<?php
namespace common\components\response\formatter\geojson;

use Yii;

/**
 * Interface to generate geojson file
 */
class GeoJson
{
    /**
     * List of items to output
     * @var array
     */
    private $_items = [];

    /**
     * @param Object $object
     * @return void
     */
    public function add($object)
    {
        $class = get_class($object);
        if(!$object->validate()) {
            return false;
        }

        $this->_items[] = $object;
    }

    /**
     * @return XML response
     */
    public function output()
    {
        $features = [];

        foreach($this->_items as $object) {

            $features[] = [
                'type' => 'Feature',
                'properties' => [
                ],
                'geometry' => $object->output(),
                'properties' => $object->extendedData,
            ];
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];
    }
}
