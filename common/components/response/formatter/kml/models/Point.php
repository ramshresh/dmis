<?php
namespace common\components\response\formatter\kml\models;

class Point extends Model
{
    /**
     * @inheritdoc
     */
    public $type = 'Point';

    /**
     * @inheritdoc
     */
    public $value;

    /**
     * @inheritdoc
     */
    public $extendedData = [];

    /**
     * @inheritdoc
     */
    public function validateObject()
    {
        if(!is_array($this->value)) {
            $this->addError('value', 'Invalid variable type');
        }

        if(
            count($this->value) != 2 ||
            (!isset($this->value[0]) || !isset($this->value[1])) ||
            (!is_numeric($this->value[0]) || !is_numeric($this->value[1]))
        ){
            $this->addError('value', 'Invalid coordinates');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'value' => 'Point',
        ];
    }

    /**
     * @inheritdoc
     */
    public function output()
    {
        if(!$this->type || !$this->validate()) {
            return null;
        }

        return (float) $this->value[0] . ',' . (float) $this->value[1] . ','  . 0 . ' ';
    }
}
