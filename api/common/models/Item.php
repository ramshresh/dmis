<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/31/15
 * Time: 9:31 PM
 */
namespace api\common\models;
class Item extends \common\modules\reporting\models\Item
{
    public function extraFields()
    {
        return ['itemTypes'];
    }
}