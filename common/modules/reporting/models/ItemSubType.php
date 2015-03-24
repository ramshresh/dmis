<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.item_subtype".
 *
 * @property integer $id
 * @property string $item_name
 * @property string $name
 * @property string $description
 *
 * @property Reportitem[] $reportitems
 */
class ItemSubType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.item_subtype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name'], 'string', 'max' => 75],
            [['name'], 'string', 'max' => 25],
            [['description'], 'string', 'max' => 255],
            [['item_name', 'name'], 'unique', 'targetAttribute' => ['item_name', 'name'], 'message' => 'The combination of Item Name and Name has already been taken.']
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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportitems()
    {
        return $this->hasMany(Reportitem::className(), ['item_name' => 'item_name', 'subtype_name' => 'name']);
    }
}
