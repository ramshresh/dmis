<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.emergency_situation".
 *
 * @property integer $id
 * @property integer $reportitem_id
 * @property integer $primary_event_id
 * @property string $timestamp_declared
 * @property string $declared_by
 * @property integer $status
 *
 * @property Event $primaryEvent
 * @property ReportItem $reportItem
 * @property Event[]    $events
 */
class EmergencySituation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.emergency_situation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reportitem_id', 'primary_event_id'], 'required'],
            [['reportitem_id', 'primary_event_id', 'status'], 'integer'],
            [['timestamp_declared'], 'safe'],
            [['declared_by'], 'string', 'max' => 75]
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
            'primary_event_id' => Yii::t('app', 'Primary Event ID'),
            'timestamp_declared' => Yii::t('app', 'Timestamp Declared'),
            'declared_by' => Yii::t('app', 'Declared By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrimaryEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'primary_event_id']);
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
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['reportitem_id' => 'reportitem_id']);
    }
}
