<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.rating".
 *
 * @property integer $id
 * @property integer $reportitem_id
 * @property integer $rating
 * @property string $comment
 * @property boolean $is_valid
 * @property integer $user_id
 * @property string $timestamp_created
 * @property string $timestamp_updated
 *
 * @property Reportitem $reportitem
 * @property User $user
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reportitem_id', 'user_id'], 'required'],
            [['reportitem_id', 'rating', 'user_id'], 'integer'],
            [['is_valid'], 'boolean'],
            [['timestamp_created', 'timestamp_updated'], 'safe'],
            [['comment'], 'string', 'max' => 225],
            [['reportitem_id', 'user_id'], 'unique', 'targetAttribute' => ['reportitem_id', 'user_id'], 'message' => 'The combination of Reportitem ID and User ID has already been taken.']
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
            'rating' => Yii::t('app', 'Rating'),
            'comment' => Yii::t('app', 'Comment'),
            'is_valid' => Yii::t('app', 'Is Valid'),
            'user_id' => Yii::t('app', 'User ID'),
            'timestamp_created' => Yii::t('app', 'Timestamp Created'),
            'timestamp_updated' => Yii::t('app', 'Timestamp Updated'),
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
