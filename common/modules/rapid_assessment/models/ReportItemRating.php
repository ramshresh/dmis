<?php

namespace common\modules\rapid_assessment\models;

use Yii;

/**
 * This is the model class for table "rapid_assessment.report_item_rating".
 *
 * @property string $id
 * @property string $report_item_id
 * @property integer $rating
 * @property string $comment
 * @property boolean $is_valid
 * @property string $user_id
 * @property string $timestamp_created_at
 * @property string $timestamp_updated_at
 *
 * @property ReportItem $reportItem
 * @property User $user
 */
class ReportItemRating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rapid_assessment.report_item_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_item_id', 'rating', 'user_id'], 'required'],
            [['report_item_id', 'rating', 'user_id'], 'integer'],
            [['is_valid'], 'boolean'],
            [['timestamp_created_at', 'timestamp_updated_at'], 'safe'],
            [['comment'], 'string', 'max' => 225],
            [['report_item_id', 'user_id'], 'unique', 'targetAttribute' => ['report_item_id', 'user_id'], 'message' => 'The combination of Report Item ID and User ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'report_item_id' => Yii::t('app', 'Report Item ID'),
            'rating' => Yii::t('app', 'Rating'),
            'comment' => Yii::t('app', 'Comment'),
            'is_valid' => Yii::t('app', 'Is Valid'),
            'user_id' => Yii::t('app', 'User ID'),
            'timestamp_created_at' => Yii::t('app', 'Timestamp Created At'),
            'timestamp_updated_at' => Yii::t('app', 'Timestamp Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportItem()
    {
        return $this->hasOne(ReportItem::className(), ['id' => 'report_item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
