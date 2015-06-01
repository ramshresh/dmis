<?php

namespace common\modules\building_assessment\models;

use Yii;

/**
 * This is the model class for table "building_assessment.building_household".
 *
 * @property string $id
 * @property string $owner_name
 * @property string $owner_contact
 * @property string $occupancy_type
 * @property string $current_condition
 * @property string $income_source
 * @property string $income_level
 * @property string $construction_type
 * @property string $current_income_status
 * @property string $damage_type
 * @property integer $user_id
 * @property integer $no_of_occupants
 * @property string $event_name
 * @property string $timestamp_created_at
 * @property string $timestamp_updated_at
 * @property string $timestamp_occurance
 * @property double $longitude
 * @property double $latitude
 * @property string $geom
 * @property string $wkt
 * @property string $address
 * @property integer $c_code
 * @property integer $z_code
 * @property integer $d_code
 * @property integer $v_code
 * @property integer $ward_no
 * @property integer $impact_death
 * @property integer $impact_injured
 * @property integer $impact_missing
 * @property integer $impact_displaced
 * @property integer $impact_orphaned
 * @property string $tags
 *
 * @property User $user
 */
class BuildingHousehold extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'building_assessment.building_household';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['occupancy_type', 'income_source', 'construction_type', 'geom', 'wkt', 'tags'], 'string'],
            [['user_id', 'no_of_occupants', 'c_code', 'z_code', 'd_code', 'v_code', 'ward_no', 'impact_death', 'impact_injured', 'impact_missing', 'impact_displaced', 'impact_orphaned'], 'integer'],
            [['timestamp_created_at', 'timestamp_updated_at', 'timestamp_occurance'], 'safe'],
            [['longitude', 'latitude'], 'number'],
            [['owner_name', 'owner_contact', 'address'], 'string', 'max' => 128],
            [['current_condition', 'income_level', 'event_name'], 'string', 'max' => 64],
            [['current_income_status', 'damage_type'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'owner_name' => Yii::t('app', 'Owner Name'),
            'owner_contact' => Yii::t('app', 'Owner Contact'),
            'occupancy_type' => Yii::t('app', 'Occupancy Type'),
            'current_condition' => Yii::t('app', 'Current Condition'),
            'income_source' => Yii::t('app', 'Income Source'),
            'income_level' => Yii::t('app', 'Income Level'),
            'construction_type' => Yii::t('app', 'Construction Type'),
            'current_income_status' => Yii::t('app', 'Current Income Status'),
            'damage_type' => Yii::t('app', 'Damage Type'),
            'user_id' => Yii::t('app', 'User ID'),
            'no_of_occupants' => Yii::t('app', 'No Of Occupants'),
            'event_name' => Yii::t('app', 'Event Name'),
            'timestamp_created_at' => Yii::t('app', 'Timestamp Created At'),
            'timestamp_updated_at' => Yii::t('app', 'Timestamp Updated At'),
            'timestamp_occurance' => Yii::t('app', 'Timestamp Occurance'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'geom' => Yii::t('app', 'Geom'),
            'wkt' => Yii::t('app', 'Wkt'),
            'address' => Yii::t('app', 'Address'),
            'c_code' => Yii::t('app', 'C Code'),
            'z_code' => Yii::t('app', 'Z Code'),
            'd_code' => Yii::t('app', 'D Code'),
            'v_code' => Yii::t('app', 'V Code'),
            'ward_no' => Yii::t('app', 'Ward No'),
            'impact_death' => Yii::t('app', 'Impact Death'),
            'impact_injured' => Yii::t('app', 'Impact Injured'),
            'impact_missing' => Yii::t('app', 'Impact Missing'),
            'impact_displaced' => Yii::t('app', 'Impact Displaced'),
            'impact_orphaned' => Yii::t('app', 'Impact Orphaned'),
            'tags' => Yii::t('app', 'Tags'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
