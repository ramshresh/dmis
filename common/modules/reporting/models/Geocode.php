<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.geocode".
 *
 * @property integer $id
 * @property string $api_name
 * @property integer $geometry_id
 * @property integer $reportitem_id
 * @property string $full_address
 * @property string $place_name
 * @property string $country_name
 * @property string $state_name
 * @property string $county_name
 * @property string $city_name
 * @property string $neighborhood_name
 * @property string $street_address
 * @property string $provided_location
 * @property integer $postal_code
 * @property string $type
 * @property string $display_latlng
 * @property string $geocode_quality
 * @property string $meta_hstore
 * @property string $meta_json
 *
 * @property Geometry $geometry
 * @property Reportitem $reportitem
 */
class Geocode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.geocode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['geometry_id', 'reportitem_id'], 'required'],
            [['geometry_id', 'reportitem_id', 'postal_code'], 'integer'],
            [['full_address', 'provided_location', 'type', 'display_latlng', 'geocode_quality', 'meta_hstore', 'meta_json'], 'string'],
            [['api_name'], 'string', 'max' => 25],
            [['place_name', 'country_name', 'state_name', 'county_name', 'city_name', 'neighborhood_name', 'street_address'], 'string', 'max' => 75]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'api_name' => Yii::t('app', 'Api Name'),
            'geometry_id' => Yii::t('app', 'Geometry ID'),
            'reportitem_id' => Yii::t('app', 'Reportitem ID'),
            'full_address' => Yii::t('app', 'Full Address'),
            'place_name' => Yii::t('app', 'Place Name'),
            'country_name' => Yii::t('app', 'Country Name'),
            'state_name' => Yii::t('app', 'State Name'),
            'county_name' => Yii::t('app', 'County Name'),
            'city_name' => Yii::t('app', 'City Name'),
            'neighborhood_name' => Yii::t('app', 'Neighborhood Name'),
            'street_address' => Yii::t('app', 'Street Address'),
            'provided_location' => Yii::t('app', 'Provided Location'),
            'postal_code' => Yii::t('app', 'Postal Code'),
            'type' => Yii::t('app', 'Type'),
            'display_latlng' => Yii::t('app', 'Display Latlng'),
            'geocode_quality' => Yii::t('app', 'Geocode Quality'),
            'meta_hstore' => Yii::t('app', 'Meta Hstore'),
            'meta_json' => Yii::t('app', 'Meta Json'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeometry()
    {
        return $this->hasOne(Geometry::className(), ['id' => 'geometry_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportitem()
    {
        return $this->hasOne(Reportitem::className(), ['id' => 'reportitem_id']);
    }
}
