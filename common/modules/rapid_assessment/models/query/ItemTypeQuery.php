<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/13/15
 * Time: 2:16 AM
 *
 * Single Table Inheritance Query  Class
 * @github-referencs https://github.com/samdark/yii2-cookbook/blob/master/book/ar-single-table-inheritance.md
 */

namespace common\modules\rapid_assessment\models\query;


use yii\db\ActiveQuery;

class ItemTypeQuery extends ActiveQuery{
    public $type;

    public function prepare($builder)
    {
        if ($this->type !== null) {
            $this->andWhere(['type' => $this->type]);
        }
        return parent::prepare($builder);
    }
}