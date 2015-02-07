<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.item_child".
 *
 * @property integer $id
 * @property string $parent_name
 * @property string $child_name
 * @property integer $parent_type
 * @property integer $child_type
 *
 * @property ItemType $childName
 * @property ItemType $parentName
 */
class ItemChild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.item_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_type', 'child_type'], 'required'],
            [['parent_type', 'child_type'], 'integer'],
            [['parent_name', 'child_name'], 'string', 'max' => 75]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_name' => Yii::t('app', 'Parent Name'),
            'child_name' => Yii::t('app', 'Child Name'),
            'parent_type' => Yii::t('app', 'Parent Type'),
            'child_type' => Yii::t('app', 'Child Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildName()
    {
        return $this->hasOne(ItemType::className(), ['item_name' => 'child_name', 'type' => 'child_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentName()
    {
        return $this->hasOne(ItemType::className(), ['item_name' => 'parent_name', 'type' => 'parent_type']);
    }
}
