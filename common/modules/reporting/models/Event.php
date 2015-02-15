<?php

namespace common\modules\reporting\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "reporting.event".
 *
 * @property integer $id
 * @property integer $reportitem_id
 * @property string $timestamp_occurance
 * @property string $duration
 * @property integer $status
 *
 * @property ReportItem $reportitem
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
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(),[
            [//For Event IS_A ReportItem Relationship.
                'class' => 'mdm\behaviors\ar\IsABehavior',
                'relationClass' => ReportItem::className(),
                'relationKey' => ['reportitem_id' => 'id'],
            ],
        ]);
    }

    //{{{ Getters based on model Relationship
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportitem()
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
    //}}} ./Getters based on model Relationship

    public static function getDropDownItemName(){
        return \yii\helpers\ArrayHelper::map(ItemType::find()
            ->where('type=:type',[':type'=>ReportItem::TYPE_EVENT])
            ->all(), 'item_name', 'item_name');
    }

    public function loadDefaultValues(){
        $this->type = ItemType::TYPE_EVENT;
    }

    //{{{ Initializing model
    public function init()
    {
        parent::init();
        $this->loadDefaultValues();
    }
    //}}} ./Initializing model
}
