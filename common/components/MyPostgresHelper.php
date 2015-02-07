<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/22/15
 * Time: 9:22 AM
 */

namespace common\components;


use yii\base\Component;

class MyPostgresHelper extends Component
{
    public static function unescape_hstore($hstore)
    {
        $hstore = preg_replace('/([$])/', "\\\\$1", $hstore);
        $unescapedHStore = array();
        eval('$unescapedHStore = array(' . $hstore . ');');
        return $unescapedHStore;
    }

}