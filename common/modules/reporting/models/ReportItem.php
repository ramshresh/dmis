<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.reportitem".
 *
 * @property integer $id
 * @property integer $type
 * @property string $subtype_name
 * @property string $item_name
 * @property string $title
 * @property string $description
 * @property boolean $is_verified
 * @property string $timestamp_created
 * @property string $timestamp_updated
 * @property string $tags
 * @property string $meta_hstore
 * @property string $meta_json
 *
 * @property Geometry[] $geometries
 * @property Incident[] $incidents
 * @property Multimedia[] $multimedia
 * @property ReportitemUser[] $reportitemUsers
 * @property Need[] $needs
 * @property Rating[] $ratings
 * @property Event[] $events
 * @property Damage[] $damages
 * @property EmergencySituation[] $emergencySituations
 * @property Geocode[] $geocodes
 * @property ReportItemChild[] $reportItemChildren
 */
class ReportItem extends \yii\db\ActiveRecord
{
    const TYPE_EMERGENCY_SITUATION = 0;
    const TYPE_EVENT = 1;
    const TYPE_INCIDENT = 2;
    const TYPE_DAMAGE = 3;
    const TYPE_NEED = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.reportitem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'item_name'], 'required'],
            [['type'], 'integer'],
            [['description', 'tags', 'meta_hstore', 'meta_json'], 'string'],
            [['is_verified'], 'boolean'],
            [['timestamp_created', 'timestamp_updated'], 'safe'],
            [['subtype_name'], 'string', 'max' => 25],
            [['item_name', 'title'], 'string', 'max' => 75]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'subtype_name' => Yii::t('app', 'Subtype Name'),
            'item_name' => Yii::t('app', 'Item Name'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'is_verified' => Yii::t('app', 'Is Verified'),
            'timestamp_created' => Yii::t('app', 'Timestamp Created'),
            'timestamp_updated' => Yii::t('app', 'Timestamp Updated'),
            'tags' => Yii::t('app', 'Tags'),
            'meta_hstore' => Yii::t('app', 'Meta Hstore'),
            'meta_json' => Yii::t('app', 'Meta Json'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeometries()
    {
        return $this->hasMany(Geometry::className(), ['reportitem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncidents()
    {
        return $this->hasMany(Incident::className(), ['reportitem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMultimedia()
    {
        return $this->hasMany(Multimedia::className(), ['reportitem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportitemUsers()
    {
        return $this->hasMany(ReportitemUser::className(), ['reportitem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNeeds()
    {
        return $this->hasMany(Need::className(), ['reportitem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['reportitem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['reportitem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDamages()
    {
        return $this->hasMany(Damage::className(), ['reportitem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmergencySituations()
    {
        return $this->hasMany(EmergencySituation::className(), ['reportitem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeocodes()
    {
        return $this->hasMany(Geocode::className(), ['reportitem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportItemChildren()
    {
        return $this->hasMany(ReportItem::className(), ['id' => 'child_id', 'type' => 'child_type'])
            ->viaTable(ReportItemChild::tableName(), ['parent_id' => 'id', 'parent_type' => 'type']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->tags = '{'.$this->tags.'}';
            return true;
        } else {
            return false;
        }
    }


    public function behaviors()
    {


        return [
            [
                'class' => 'mdm\behaviors\ar\RelationBehavior',
            ],
        ];
    }
}
