<?php

namespace common\modules\tracking\models\sql_views;

use Yii;

/**
 * This is the model class for table "tracking.tracking_driver".
 *
 * @property string $Firstname
 * @property string $Lastname
 * @property string $Ambulance_Number
 * @property string $Gender
 * @property double $longitude
 * @property double $latitude
 * @property string $status
 * @property string $geom
 */
class TrackingDriver extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tracking.tracking_driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['longitude', 'latitude'], 'number'],
            [['geom'], 'string'],
            [['Firstname', 'Lastname'], 'string', 'max' => 255],
            [['Ambulance_Number'], 'string', 'max' => 25],
            [['Gender'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Firstname' => Yii::t('app', 'Firstname'),
            'Lastname' => Yii::t('app', 'Lastname'),
            'Ambulance_Number' => Yii::t('app', 'Ambulance  Number'),
            'Gender' => Yii::t('app', 'Gender'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'status' => Yii::t('app', 'Status'),
            'geom' => Yii::t('app', 'Geom'),
        ];
    }
}
