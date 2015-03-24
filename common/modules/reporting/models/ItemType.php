<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.item_type".
 *
 * @property integer $id
 * @property string $item_name
 * @property integer $type
 * @property string $description
 *
 * @property Item $itemName
 * @property ItemChild[] $itemChildren
 *
 *
 */
class ItemType extends \yii\db\ActiveRecord
{
    const TYPE_EMERGENCY_SITUATION=0;
    const TYPE_EVENT=1;
    const TYPE_INCIDENT=2;
    const TYPE_DAMAGE=3;
    const TYPE_NEED=4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.item_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'integer'],
            [['item_name'], 'string', 'max' => 75],
            [['description'], 'string', 'max' => 255],
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
        //return $this->hasMany(ItemChild::className(), ['parent_name' => 'item_name', 'parent_type' => 'type']);
        return $this->hasMany(ItemType::className(),
            ['item_name' => 'child_name', 'type' => 'child_type'])
            ->viaTable(ItemChild::tableName(),['parent_name' => 'item_name', 'parent_type' => 'type']);
    }
}
