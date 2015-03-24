<?php

namespace common\modules\rapid_assessment\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\Json;

/**
 * This is the model class for table "rapid_assessment.report_item".
 *
 * @property string $id
 * @property integer $type
 * @property string $item_name
 * @property string $class_basis
 * @property string $class_name
 * @property string $title
 * @property string $description
 * @property boolean $is_verified
 * @property string $status
 * @property string $timestamp_occurance
 * @property string $timestamp_created_at
 * @property string $timestamp_updatedat_at
 * @property string $tags
 * @property string $meta_hstore
 * @property string $meta_json
 * @property string $declared_by
 * @property string $timestamp_declared_at
 * @property double $magnitude
 * @property string $units
 * @property string $wkt
 * @property string $geom
 * @property double $latitude
 * @property double $longitude
 * @property string $address
 * @property string $user_id
 *
 * @property ReportItemChild[] $reportItemChildren
 * @property ReportItemChild[] $reportItemChildrenParent
 * @property ReportItemRating[] $reportItemRatings
 * @property User $user
 * @property ReportItemMultimedia[] $reportItemMultimedia
 *
 * @property ReportItem[] $children
 * @property ReportParent $parent
 */

/**
 * Class ReportItem
 * @package common\modules\rapid_assessment\models
 * @todo 1: Rename the pivot table report_item_child to report_item_related.
 * Because, in later case declaring getters getReportItemChildren() and getReportItemParent() viaTable report_item_related becomes more intuitive
 * while, in former case declaring getReportItemChildren() viaTable report_item_child is only intuitive and the function getReportItemParents() sounds odd but yet can be implemented
 *
 */
class ReportItem extends \yii\db\ActiveRecord
{
    const SRID=4326;
    const TYPE_EMERGENCY_SITUATION = ItemType::TYPE_EMERGENCY_SITUATION;
    const TYPE_EVENT = ItemType::TYPE_EVENT;
    const TYPE_INCIDENT = ItemType::TYPE_INCIDENT;
    const TYPE_IMPACT = ItemType::TYPE_IMPACT;
    const TYPE_NEED = ItemType::TYPE_NEED;
    /**
     * Single table inheritance
     * @github-reference https://github.com/samdark/yii2-cookbook/blob/master/book/ar-single-table-inheritance.md
     * @param array $row
     * @return Geometry|GeometryLinestring|GeometryPoint|GeometryPolygon
     */
    public static function instantiate($row)
    {
        switch ($row['type']) {
            case self::TYPE_EMERGENCY_SITUATION:
                return new ReportItemEmergencySituation();
            case self::TYPE_EVENT:
                return new ReportItemEvent();
            case self::TYPE_INCIDENT:
                return new ReportItemIncident();
            case self::TYPE_IMPACT:
                return new ReportItemImpact();
            case self::TYPE_NEED:
                return new ReportItemNeed();
            default:
                return new self;
        }
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rapid_assessment.report_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type','item_name'], 'required'],
            [['user_id'], 'integer'],
            [['description', 'tags', 'meta_hstore', 'meta_json', 'wkt', 'geom'], 'string'],
            [['is_verified'], 'boolean'],
            [['timestamp_occurance', 'timestamp_created_at', 'timestamp_updated_at', 'timestamp_declared_at'], 'safe'],
            [['magnitude', 'latitude', 'longitude'], 'number'],
            [['type','item_name', 'class_basis', 'class_name', 'title', 'status', 'declared_by', 'units', 'address'], 'string', 'max' => 255]
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
            'item_name' => Yii::t('app', 'Item Name'),
            'class_basis' => Yii::t('app', 'Class Basis'),
            'class_name' => Yii::t('app', 'Class Name'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'is_verified' => Yii::t('app', 'Is Verified'),
            'status' => Yii::t('app', 'Status'),
            'timestamp_occurance' => Yii::t('app', 'Timestamp Occurance'),
            'timestamp_created_at' => Yii::t('app', 'Timestamp Created At'),
            'timestamp_updated_at' => Yii::t('app', 'Timestamp Updated At'),
            'tags' => Yii::t('app', 'Tags'),
            'meta_hstore' => Yii::t('app', 'Meta Hstore'),
            'meta_json' => Yii::t('app', 'Meta Json'),
            'declared_by' => Yii::t('app', 'Declared By'),
            'timestamp_declared_at' => Yii::t('app', 'Timestamp Declared At'),
            'magnitude' => Yii::t('app', 'Magnitude'),
            'units' => Yii::t('app', 'Units'),
            'wkt' => Yii::t('app', 'Wkt'),
            'geom' => Yii::t('app', 'Geom'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'address' => Yii::t('app', 'Address'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportItemChildren()
    {
        return $this->hasMany(ReportItemChild::className(), ['parent_id' => 'id', 'parent_type' => 'type'])->inverseOf('parent');
    }

    /**
     * @return \yii\db\ActiveQuery
     * @added-by : Ram Shrestha
     * @todo confirm its valid use case. Implemented for use as ->via('reportItemParents') in getter functions example ReportItemEvent::getEmergencySituation
        // Class ReportItemEvent
        public function getEmergencySituation() {
            return $this->hasOne(ReportItemEmergencySituation::className(), ['id' => 'parent_id','type'=>'parent_type'])
                //->onCondition(['type'=>ReportItem::TYPE_EMERGENCY_SITUATION])
                //->viaTable(ReportItemChild::tableName(), ['child_id' => 'id','child_type'=>'type']);
                ->via('reportItemParents');
        }
     */
    public function getReportItemChildrenParent()
    {
        return $this->hasOne(ReportItemChild::className(), ['child_id' => 'id', 'child_type' => 'type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportItemRatings()
    {
        return $this->hasMany(ReportItemRating::className(), ['report_item_id' => 'id'])->inverseOf('reportItem');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportItemMultimedia()
    {
        return $this->hasMany(ReportItemMultimedia::className(), ['report_item_id' => 'id'])->inverseOf('reportItem');
    }

    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getChildren() {
        return $this->hasMany(ReportItem::className(), ['id' => 'child_id','type' => 'child_type'])
            ->viaTable(ReportItemChild::tableName(), ['parent_id' => 'id','parent_type' => 'type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     * @added-by Ram Shrestha
     * @todo validate its usecase
     */
    public function getParents() {
        return $this->hasMany(ReportItem::className(), ['id' => 'parent_id','type' => 'parent_type'])
            ->viaTable(ReportItemChild::tableName(), ['child_id' => 'id','child_type' => 'type']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'mdm\behaviors\ar\RelatedBehavior',
            ],
            [
                'class' => 'mdm\behaviors\ar\RelationBehavior',

            ],
            [// Auto populates Timestamp for created and update events
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'timestamp_created_at',
                'updatedAtAttribute' => 'timestamp_updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {


            //{{{ saving wkt to geometry
            /**
             *
             * @reference http://postgis.net/docs/ST_GeomFromText.html
             * @todo: Investigate:: Why is parametrized expression not working for linestring but working for point
             * $this->geom=new Expression("(SELECT ST_PointFromText(:wkt, :srid))", array(':wkt' => $this->wkt, ':srid' => $this::SRID));
             * For above expression,
             * $this->wkt='POINT(-71.160281 42.258729)';//->working
             * $this->wkt='LINESTRING(-71.160281 42.258729,-71.160837 42.259113,-71.161144 42.25932)';//->not working
             * So used unparametrized expression,
             * $this->geom=new Expression("(SELECT ST_GeomFromText('".$this->wkt."',".$this->srid."))");
             */

            if($this->wkt){
                $this->geom=new Expression("(SELECT ST_GeomFromText('".$this->wkt."',".$this::SRID."))");
            }

            /* Hardcoded for POINT lat lon pointpicker */
            //$this->geom=new Expression("(SELECT ST_PointFromText(:point, :srid))", array(':point' => 'POINT(' . $this->longitude . ' ' . $this->latitude . ')', ':srid' => $this::SRID));

            //}}} ./saving wkt to geometry

            return true;
        } else {
            return false;
        }
    }
}
