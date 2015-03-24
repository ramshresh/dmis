<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/13/15
 * Time: 2:20 AM
 */

namespace common\modules\reporting\models;

use common\modules\reporting\models\query\GeometryQuery;

class GeometryLinestring extends Geometry{
    const TYPE = Geometry::TYPE_LINESTRING;
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->type=self::TYPE;
    }
    public static function find()
    {
        return new GeometryQuery(get_called_class(), ['type' => self::TYPE]);
    }
}