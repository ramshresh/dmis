<?php

namespace common\modules\rapid_assessment\models;

use Yii;

/**
 * This is the model class for table "rapid_assessment.item_type".
 *
 * @property string $id
 * @property string $item_name
 * @property integer $type
 * @property string $description
 * @property boolean $is_verified
 *
 * @property Item $itemName
 * @property ItemChild[] $itemChildren
 * @property ItemType $parent
 * @property ItemType[] $children
 */
class ItemType extends \yii\db\ActiveRecord
{
    const TYPE_EMERGENCY_SITUATION = 'emergency_situation';
    const TYPE_EVENT = 'event';
    const TYPE_INCIDENT = 'incident';
    const TYPE_IMPACT = 'impact';
    const TYPE_NEED = 'need';
    /**
     * Single table inheritance
     * @github-reference https://github.com/samdark/yii2-cookbook/blob/master/book/ar-single-table-inheritance.md
     * @param array $row
     * @return Geometry|GeometryLinestring|GeometryPoint|GeometryPolygon
     */
    /*public static function instantiate($row)
    {
        switch ($row['type']) {
            case self::TYPE_EMERGENCY_SITUATION:
                return new ReportItemEmergencySituation();
            case self::TYPE_EVENT:
                return new ReportItemEvent();
            case self::TYPE_INCIDENT:
                return new ReportItemIncident();
            case self::TYPE_IMPACT:
                return new ReportItemImpact();
            case self::TYPE_NEED:
                return new ReportItemNeed();
            default:
                return new self;
        }
    }*/
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rapid_assessment.item_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'type'], 'required'],
            [['is_verified'], 'boolean'],
            [['type','item_name', 'description'], 'string', 'max' => 255],
            [['item_name', 'type'], 'unique', 'targetAttribute' => ['item_name', 'type'], 'message' => 'The combination of Item Name and Type has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_name' => Yii::t('app', 'Item Name'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'is_verified' => Yii::t('app', 'Is Verified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(Item::className(), ['name' => 'item_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemChildren()
    {
        return $this->hasMany(ItemChild::className(), ['parent_name' => 'item_name', 'parent_type' => 'type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getChildren() {
        return $this->hasMany(ItemType::className(), ['item_name' => 'child_name','type' => 'child_type'])
            // ->onCondition(['type'=>ReportItem::TYPE_IMPACT])
            // ->viaTable(ReportItemChild::tableName(), ['parent_id' => 'id','parent_type' => 'type']);
            ->via('itemChildren');
    }
}
