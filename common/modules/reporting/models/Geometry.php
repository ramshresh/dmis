<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.geometry".
 *
 * @property integer $id
 * @property integer $reportitem_id
 * @property string $geom
 * @property string $wkt
 * @property string $srid
 * @property string $type
 * @property string $bbox
 * @property double $perimeter_meter
 * @property double $area_sqmeter
 * @property double $length
 * @property double $center_latitude
 * @property double $center_longitude
 *
 * @property Reportitem $reportitem
 * @property Geocode[] $geocodes
 */
class Geometry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.geometry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reportitem_id'], 'required'],
            [['reportitem_id'], 'integer'],
            [['geom', 'wkt', 'bbox'], 'string'],
            [['perimeter_meter', 'area_sqmeter', 'length', 'center_latitude', 'center_longitude'], 'number'],
            [['srid', 'type'], 'string', 'max' => 15],
            [['reportitem_id', 'type'], 'unique', 'targetAttribute' => ['reportitem_id', 'type'], 'message' => 'The combination of Reportitem ID and Type has already been taken.']
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
            'geom' => Yii::t('app', 'Geom'),
            'wkt' => Yii::t('app', 'Wkt'),
            'srid' => Yii::t('app', 'Srid'),
            'type' => Yii::t('app', 'Type'),
            'bbox' => Yii::t('app', 'Bbox'),
            'perimeter_meter' => Yii::t('app', 'Perimeter Meter'),
            'area_sqmeter' => Yii::t('app', 'Area Sqmeter'),
            'length' => Yii::t('app', 'Length'),
            'center_latitude' => Yii::t('app', 'Center Latitude'),
            'center_longitude' => Yii::t('app', 'Center Longitude'),
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
    public function getGeocodes()
    {
        return $this->hasMany(Geocode::className(), ['geometry_id' => 'id']);
    }
}
