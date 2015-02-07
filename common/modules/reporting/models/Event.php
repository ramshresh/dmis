<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.event".
 *
 * @property integer $id
 * @property integer $reportitem_id
 * @property string $timestamp_occurance
 * @property string $duration
 * @property integer $status
 *
 * @property ReportItem $reportItem
 * @property EmergencySituation[] $emergencySituations
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

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
    public function getReportItem()
    {
        return $this->hasOne(ReportItem::className(), ['id' => 'reportitem_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmergencySituations()
    {
        return $this->hasMany(EmergencySituation::className(), ['primary_event_id' => 'id']);
    }

}
