<?php

namespace common\modules\social_media\models;

use Yii;

/**
 * This is the model class for table "social_media.twitter_status".
 *
 * @property string $id
 * @property string $user_id
 * @property string $location
 * @property double $latitude
 * @property double $longitude
 * @property string $in_reply_to
 * @property string $status
 * @property string $in_reply_to_status_id
 * @property boolean $possibly_sensitive
 * @property double $lat
 * @property double $long
 * @property string $place_id
 * @property boolean $display_coordinates
 * @property string $media_ids
 * @property boolean $is_verified
 */
class TwitterStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_media.twitter_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['location', 'in_reply_to', 'status', 'in_reply_to_status_id', 'place_id', 'media_ids'], 'string'],
            [['latitude', 'longitude', 'lat', 'long'], 'number'],
            [['status'], 'required'],
            [['possibly_sensitive', 'display_coordinates', 'is_verified'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'location' => Yii::t('app', 'Location'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'in_reply_to' => Yii::t('app', 'In Reply To'),
            'status' => Yii::t('app', 'Status'),
            'in_reply_to_status_id' => Yii::t('app', 'In Reply To Status ID'),
            'possibly_sensitive' => Yii::t('app', 'Possibly Sensitive'),
            'lat' => Yii::t('app', 'Lat'),
            'long' => Yii::t('app', 'Long'),
            'place_id' => Yii::t('app', 'Place ID'),
            'display_coordinates' => Yii::t('app', 'Display Coordinates'),
            'media_ids' => Yii::t('app', 'Media Ids'),
            'is_verified' => Yii::t('app', 'Is Verified'),
        ];
    }
}
