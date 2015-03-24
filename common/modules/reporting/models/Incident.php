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
class Incident extends ReportItem
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
        return [
            [
                'class' => 'mdm\behaviors\ar\IsABehavior',
                'relationClass' => ReportItem::className(),
                'relationKey' => ['reportitem_id' => 'id'],
            ],
        ];
    }

    //{{{ Getters based on model Relationship
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportitem()
    {
        return $this->hasOne(Reportitem::className(), ['id' => 'reportitem_id']);
    }
    //}}} ./Getters based on model Relationship

    public static function getDropDownItemName(){
        return \yii\helpers\ArrayHelper::map(ItemType::find()
            ->where('type=:type',[':type'=>ReportItem::TYPE_INCIDENT])
            ->all(), 'item_name', 'item_name');
    }

    //{{{ Initializing model
    public function loadDefaultValues(){
        $this->type = ItemType::TYPE_INCIDENT;
    }

    public function init()
    {
        parent::init();
        $this->loadDefaultValues();
    }
    //}}} ./Initializing model

}
