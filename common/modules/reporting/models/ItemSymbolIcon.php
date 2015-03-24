<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.item_symbol_icon".
 *
 * @property integer $id
 * @property string $item_name
 * @property integer $symbol_id
 * @property boolean $is_default
 *
 * @property Item $itemName
 * @property SymbolIcon $symbol
 */
class ItemSymbolIcon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.item_symbol_icon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['symbol_id'], 'required'],
            [['symbol_id'], 'integer'],
            [['is_default'], 'boolean'],
            [['item_name'], 'string', 'max' => 75],
            [['item_name', 'symbol_id'], 'unique', 'targetAttribute' => ['item_name', 'symbol_id'], 'message' => 'The combination of Item Name and Symbol ID has already been taken.']
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
            'symbol_id' => Yii::t('app', 'Symbol ID'),
            'is_default' => Yii::t('app', 'Is Default'),
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
    public function getSymbol()
    {
        return $this->hasOne(SymbolIcon::className(), ['id' => 'symbol_id']);
    }
}
