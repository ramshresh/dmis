<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/13/15
 * Time: 2:20 AM
 */

namespace common\modules\reporting\models;

use common\modules\reporting\models\query\ReportItemQuery;

class ReportItemEvent extends ReportItem{
    const TYPE = ReportItem::TYPE_EVENT;
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->type=self::TYPE;
    }

    public static function find()
    {
        return new ReportItemQuery(get_called_class(), ['type' => self::TYPE]);
    }
}