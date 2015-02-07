<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/31/15
 * Time: 9:31 PM
 */
namespace api\common\models;
class ItemSubType extends \common\modules\reporting\models\ItemSubType{
    public function extraFields()
    {
        return [];
        //return ['reportItems'];
    }
}