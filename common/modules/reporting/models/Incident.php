<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.incident".
 *
 * @property integer $id
 * @property integer $reportitem_id
 * @property string $timestamp_occurance
 * @property string $duration
 * @property integer $status
 *
 * @property Reportitem $reportitem
 */
class Incident extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.incident';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reportitem_id'], 'required'],
            [['reportitem_id', 'status'], 'integer'],
            [['timestamp_occurance'], 'safe'],
            [['duration'], 'string']
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
            'timestamp_occurance' => Yii::t('app', 'Timestamp Occurance'),
            'duration' => Yii::t('app', 'Duration'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportitem()
    {
        return $this->hasOne(Reportitem::className(), ['id' => 'reportitem_id']);
    }
}
