<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/31/15
 * Time: 9:31 PM
 */
namespace api\common\models;
class ItemChild extends \common\modules\reporting\models\ItemChild
{
    public function extraFields()
    {
        return ['childName','parentName'];
    }
}