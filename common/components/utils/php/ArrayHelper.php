<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/15/15
 * Time: 6:54 AM
 */

namespace common\components\utils\php;


class ArrayHelper extends \yii\helpers\ArrayHelper {
    /**
     * Remove each instance of a value within an array
     * @param array $array
     * @param mixed $value
     * @return array
     */
    public static function array_remove(&$array, $value)
    {
        return array_filter($array, function($a) use($value) {
            return $a !== $value;
        });
    }

    /**
     * Remove each instance of an object within an array (matched on a given property, $prop)
     * @param array $array
     * @param mixed $value
     * @param string $prop
     * @return array
     */
    public static function array_remove_object(&$array, $value, $prop)
    {
        return array_filter($array, function($a) use($value, $prop) {
            return $a->$prop !== $value;
        });
    }
}