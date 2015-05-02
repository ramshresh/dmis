<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.need".
 *
 * @property integer $id
 * @property integer $reportitem_id
 * @property integer $quantity
 * @property string $units_shortname
 * @property string $units_displayname
 * @property integer $status
 *
 * @property Reportitem $reportitem
 * @property Units $unitsDisplayname
 *
 * These are the available properties of model<ReportItem>
 * defined via  @Behavior<ramshresh\behaviors\ar\IsABehavior> in this model
 * They can be used to directly save ReportItem model while saving $this model itself
 * example. $model= new Damage(); $model->item_name = Earthquake; $model->save();
 * Validation Rules and Scenarios for these properties are defined in model <ReportItem> itself
 * These are @Read_and_Write properties
 * @property integer $type
 * @property string $item_name
 * @property string $sybtype_name
 * @property boolean $is_verified
 * @property string $timestamp_created
 * @property string $timestamp_updated
 *
 */
class Need extends ReportItem
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.need';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quantity'], 'required'],
            [['reportitem_id', 'quantity', 'status'], 'integer'],
            [['units_shortname', 'units_displayname'], 'string', 'max' => 25]
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
            'quantity' => Yii::t('app', 'Quantity'),
            'units_shortname' => Yii::t('app', 'Units Shortname'),
            'units_displayname' => Yii::t('app', 'Units Displayname'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'ramshresh\behaviors\ar\IsABehavior',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitsDisplayname()
    {
        return $this->hasOne(Units::className(), ['displayname' => 'units_displayname', 'shortname' => 'units_shortname']);
    }
    //}}} ./Getters based on model Relationship

    public static function getDropDownItemName(){
        return \yii\helpers\ArrayHelper::map(ItemType::find()
            ->where('type=:type',[':type'=>ReportItem::TYPE_NEED])
            ->all(), 'item_name', 'item_name');
    }

    //{{{ Initializing model
    public function loadDefaultValues(){
        $this->type = ItemType::TYPE_NEED;
    }

    public function init()
    {
        parent::init();
        $this->loadDefaultValues();
    }
    //}}} ./Initializing model
}
