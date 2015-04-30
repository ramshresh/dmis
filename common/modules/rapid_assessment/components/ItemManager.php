<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/29/2015
 * Time: 8:22 PM
 */

namespace common\modules\rapid_assessment\components;


use common\modules\rapid_assessment\models\ItemChild;
use common\modules\rapid_assessment\models\ItemType;
use yii\base\Component;
use yii\db\ActiveQuery;

class ItemManager extends Component{

    /**
     * @inheritdoc
     */
    public static function getChildren($item_name, $type)
    {
        $model=ItemType::findOne(['item_name'=>$item_name,'type'=>$type]);
        return $model->children;
    }

    /**
     * Checks whether there is a loop in the authorization item hierarchy.
     *
     * @param Item $parent parent item
     * @param Item $child the child item that is to be added to the hierarchy
     * @return boolean whether a loop exists
     */
    protected function detectLoop($parent, $child)
    {
        if ($child->name === $parent->name) {
            return true;
        }
        if (!isset($this->children[$child->name], $this->items[$parent->name])) {
            return false;
        }
        foreach ($this->children[$child->name] as $grandchild) {
            /* @var $grandchild Item */
            if ($this->detectLoop($parent, $grandchild)) {
                return true;
            }
        }

        return false;
    }
}