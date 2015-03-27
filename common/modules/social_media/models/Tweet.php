<?php

namespace common\modules\social_media\models;

use Yii;

/**
 * This is the model class for table "social_media.tweet".
 *
 * @property string $id
 * @property string $tweets
 * @property string $geom
 * @property string $status_json
 * @property string $date
 * @property string $hashtags
 * @property string $tweet_location
 * @property string $screen_name
 * @property string $user_id
 * @property string $date_utc
 * @property boolean $verified
 * @property string $user_address
 * @property string $tweet_long
 * @property string $tweet_lat
 * @property string $user_long
 * @property string $user_lat
 * @property string $user_geom
 * @property string $media_url
 */
class Tweet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_media.tweet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tweets', 'geom', 'status_json', 'date', 'hashtags', 'tweet_location', 'screen_name', 'date_utc', 'user_address', 'tweet_long', 'tweet_lat', 'user_long', 'user_lat', 'user_geom', 'media_url'], 'string'],
            [['user_id'], 'integer'],
            [['verified'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tweets' => Yii::t('app', 'Tweets'),
            'geom' => Yii::t('app', 'Geom'),
            'status_json' => Yii::t('app', 'Status Json'),
            'date' => Yii::t('app', 'Date'),
            'hashtags' => Yii::t('app', 'Hashtags'),
            'tweet_location' => Yii::t('app', 'Tweet Location'),
            'screen_name' => Yii::t('app', 'Screen Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'date_utc' => Yii::t('app', 'Date Utc'),
            'verified' => Yii::t('app', 'Verified'),
            'user_address' => Yii::t('app', 'User Address'),
            'tweet_long' => Yii::t('app', 'Tweet Long'),
            'tweet_lat' => Yii::t('app', 'Tweet Lat'),
            'user_long' => Yii::t('app', 'User Long'),
            'user_lat' => Yii::t('app', 'User Lat'),
            'user_geom' => Yii::t('app', 'User Geom'),
            'media_url' => Yii::t('app', 'Media Url'),
        ];
    }
}
