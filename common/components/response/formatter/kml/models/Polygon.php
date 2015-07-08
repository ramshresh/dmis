<?php
namespace common\components\response\formatter\kml\models;

class Polygon extends Model
{
    /**
     * @inheritdoc
     */
    public $type = 'Polygon';

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
            $this->addError('value', 'Invalid variable value');
        }

        if(count($this->value) == 0){
            $this->addError('value', 'Invalid coordinates');
        }

        foreach($this->value as $object) {
            if(!$object->validate()) {
                $this->addError('value', 'Invalid variable type');
                break;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'value' => 'Polygon',
        ];
    }

    /**
     * Generate the output of geo object
     * @return mixed(array|null)
     */
    public function output()
    {
        if(!$this->type || !$this->validate()) {
            return null;
        }

        $coordinates = '';
        foreach($this->value as $point) {
            $coordinates .= (float) $point->value[0] . ',' . (float) $point->value[1] . ','  . 0 . ' ';
        }

        return $coordinates;
    }
}
