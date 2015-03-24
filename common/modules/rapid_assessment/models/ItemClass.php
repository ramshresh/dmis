<?php

namespace common\modules\rapid_assessment\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rapid_assessment.item_class".
 *
 * @property string $id
 * @property string $item_name
 * @property string $basis
 * @property string $name
 * @property string $display_name
 * @property double $range
 * @property string $range_units
 * @property string $standard
 * @property string $description
 * @property boolean $is_verified
 *
 * @property Item $itemName
 */
class ItemClass extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rapid_assessment.item_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'basis', 'name'], 'required'],
            [['range'], 'number'],
            [['is_verified'], 'boolean'],
            [['item_name', 'basis', 'name', 'display_name', 'range_units', 'standard', 'description'], 'string', 'max' => 255],
            [['item_name', 'basis', 'name'], 'unique', 'targetAttribute' => ['item_name', 'basis', 'name'], 'message' => 'The combination of Item Name, Basis and Name has already been taken.']
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
            'basis' => Yii::t('app', 'Basis'),
            'name' => Yii::t('app', 'Name'),
            'display_name' => Yii::t('app', 'Display Name'),
            'range' => Yii::t('app', 'Range'),
            'range_units' => Yii::t('app', 'Range Units'),
            'standard' => Yii::t('app', 'Standard'),
            'description' => Yii::t('app', 'Description'),
            'is_verified' => Yii::t('app', 'Is Verified'),
        ];
    }
    function scenarios()
    {
        $scenarios =[
            //This scenario is to be used for Search Model by instance , or any vhild
            'search'=> ['item_name','basis','name','display_name','range','range_units','standard','description', 'is_verified'],
        ];
        return ArrayHelper::merge(parent::scenarios(),$scenarios);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(Item::className(), ['name' => 'item_name']);
    }
}
