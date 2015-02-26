<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/31/15
 * Time: 9:31 PM
 */
namespace api\common\models;
class Event extends \common\modules\reporting\models\Event
{
    public function extraFields()
    {
        return ['reportitem'];
    }
}