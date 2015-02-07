<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/31/15
 * Time: 9:31 PM
 */
namespace api\common\models;
class ItemType extends \common\modules\reporting\models\ItemType{
    public function extraFields()
    {
        return ['itemName','itemChildren'];
    }
}