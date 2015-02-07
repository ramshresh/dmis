<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.damage".
 *
 * @property integer $id
 * @property integer $reportitem_id
 * @property integer $quantity
 * @property string $units_shortname
 * @property string $units_displayname
 * @property integer $status
 *
 * @property Reportitem $reportitem
 * @property Units $unitsDisplayname
 */
class Damage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.damage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'quantity'], 'required'],
            [['reportitem_id', 'quantity', 'status'], 'integer'],
            [['units_shortname', 'units_displayname'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reportitem_id' => Yii::t('app', 'Reportitem ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'units_shortname' => Yii::t('app', 'Units Shortname'),
            'units_displayname' => Yii::t('app', 'Units Displayname'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportitem()
    {
        return $this->hasOne(Reportitem::className(), ['id' => 'reportitem_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsDisplayname()
    {
        return $this->hasOne(Units::className(), ['displayname' => 'units_displayname', 'shortname' => 'units_shortname']);
    }
}
