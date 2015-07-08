<?php
namespace common\components\response\formatter\kml\models;

use Yii;
use yii\base\Model as YiiModel;

/**
 * A geojson abstract model object
 */
abstract class Model extends YiiModel
{
    /**
     * Type of object
     * @var mixed
     */
    public $type;

    /**
     * Value of object
     * @var mixed
     */
    public $value;

    /**
     * Custom properties
     * @var array
     */
    public $extendedData = [];

    /**
     * Validation rule for object
     * @uses model errors
     * @return void
     */
    abstract protected function validateObject();

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'validateObject'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'value' => 'KML Object',
        ];
    }

    /**
     * Generate the output of geo object
     * @return string
     */
    abstract public function output();
}
