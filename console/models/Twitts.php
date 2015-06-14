<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "twitts".
 *
 * @property string $tweet_id
 * @property string $code
 * @property integer $is_processed
 * @property string $created_at
 */
class Twitts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'twitts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tweet_id'], 'required'],
            [['tweet_id', 'code'], 'string'],
            [['is_processed'], 'integer'],
            [['created_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tweet_id' => Yii::t('app', 'Tweet ID'),
            'code' => Yii::t('app', 'Code'),
            'is_processed' => Yii::t('app', 'Is Processed'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
