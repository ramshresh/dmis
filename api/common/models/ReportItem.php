<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 1/31/15
 * Time: 9:31 PM
 */
namespace api\common\models;
class ReportItem extends \common\modules\reporting\models\ReportItem
{
    public function extraFields()
    {
        return ['event','incident','damage','need','geometries','user'];
    }
}