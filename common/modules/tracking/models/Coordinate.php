<?php

namespace common\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "tracking.coordinate".
 *
 * @property string $device_id
 * @property string $longitude
 * @property string $latitude
 * @property string $speed
 * @property string $id
 *
 * @property Driver $driver
 */
class Coordinate extends \yii\db\ActiveRecord
{
    public function extraFields()
    {
        return ['driver'];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tracking.coordinate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['device_id'], 'required'],
            [['device_id', 'longitude', 'latitude', 'speed'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'device_id' => Yii::t('app', 'Device ID'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'speed' => Yii::t('app', 'Speed'),
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['IMEI' => 'device_id']);
    }
}
