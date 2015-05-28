<?php

namespace common\modules\rapid_assessment\models;

use common\modules\user\models\User;
use Imagine\Image\Box;
use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use ramshresh\yii2\galleryManager\GalleryBehavior;
use ramshresh\yii2\galleryManager\GalleryImageAr;
use yii\web\Link;
use yii\web\Linkable;

/**
 * This is the model class for table "rapid_assessment.report_item".
 *
 * @property string $id
 * @property string $type
 * @property string $item_name
 * @property string $class_basis
 * @property string $class_name
 * @property string $title
 * @property string $description
 * @property boolean $is_verified
 * @property string $status
 * @property string $timestamp_occurance
 * @property string $timestamp_created_at
 * @property string $timestamp_updated_at
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
 * @property string $owner_name
 * @property string $owner_contact
 * @property integer $supplied_per_person
 * @property string $event
 * @property string $event_name
 * @property string $income_source
 * @property string $income_level
 * @property integer $no_of_occupants
 * @property string $current_condition
 * @property string $construction_type
 * @property string $occupancy_type
 * @property string $current_income_status
 *
 * @property User $user
 * @property ReportItemChild[] $reportItemChildren
 * @property ReportItemMultimedia[] $reportItemMultimedia
 * @property ReportItemRating[] $reportItemRatings
 */
class ReportItem extends \yii\db\ActiveRecord
{
    const SRID=4326;
    const TYPE_EMERGENCY_SITUATION = ItemType::TYPE_EMERGENCY_SITUATION;
    const TYPE_EVENT = ItemType::TYPE_EVENT;
    const TYPE_INCIDENT = ItemType::TYPE_INCIDENT;
    const TYPE_IMPACT = ItemType::TYPE_IMPACT;
    const TYPE_NEED = ItemType::TYPE_NEED;

    const SCENARIO_SEARCH = 'search';
    const SCENARION_HIGHCHARTS ='highcharts';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rapid_assessment.report_item';
    }

    /**
     * Single table inheritance
     * @github-reference https://github.com/samdark/yii2-cookbook/blob/master/book/ar-single-table-inheritance.md
     * @param array $row
     * @return Geometry|GeometryLinestring|GeometryPoint|GeometryPolygon
     */
    public static function instantiate($row)
    {
        if(isset($row['type'])){
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
        }else{
            return new self;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'item_name'], 'required'],
            [['description', 'tags', 'meta_hstore', 'meta_json', 'wkt', 'geom',  'current_condition', 'construction_type', 'occupancy_type', 'current_income_status'], 'string'],
            [['is_verified'], 'boolean'],
            [['timestamp_occurance', 'timestamp_created_at', 'timestamp_updated_at', 'timestamp_declared_at'], 'safe'],
            [['magnitude', 'latitude', 'longitude'], 'number'],
            [['user_id', 'supplied_per_person', 'no_of_occupants'], 'integer'],
            [['type', 'item_name', 'class_basis', 'class_name', 'title', 'status', 'declared_by', 'units', 'address', 'event_name'], 'string', 'max' => 255],
            [['owner_name', 'owner_contact', 'event', 'income_source', 'income_level'], 'string', 'max' => 100]
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
            'magnitude' => Yii::t('app', 'Count'),
            'units' => Yii::t('app', 'Units'),
            'wkt' => Yii::t('app', 'Wkt'),
            'geom' => Yii::t('app', 'Geom'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'address' => Yii::t('app', 'Address'),
            'user_id' => Yii::t('app', 'User ID'),
            'owner_name' => Yii::t('app', 'Owner Name'),
            'owner_contact' => Yii::t('app', 'Owner Contact'),
            'supplied_per_person' => Yii::t('app', 'Supplied Per Person'),
            'event' => Yii::t('app', 'Event'),
            'event_name' => Yii::t('app', 'Event Name'),

            'income_source' => Yii::t('app', 'Income Source'),
            'income_level' => Yii::t('app', 'Income Level'),
            'no_of_occupants' => Yii::t('app', 'No Of Occupants'),
            'current_condition' => Yii::t('app', 'Current Condition'),
            'construction_type' => Yii::t('app', 'Construction Type'),
            'occupancy_type' => Yii::t('app', 'Occupancy Type'),
            'current_income_status' => Yii::t('app', 'Current Income Status'),
        ];
    }
    function scenarios()
    {
        $reportItemScenarios =[
            //This scenario is to be used for Search Model by instance of <ReporItem> or any <class that inherits ReportItem>

            'search' => ['event_name','type','item_name', 'class_name','owner_name','owner_contact','income_level','income_source'],
            'hc_timestamp'=>['current_condition','construction_type','occupancy_type','current_income_status','event_name','owner_name','owner_contact','no_of_occupants','supplied_per_person','id','type','item_name','class_basis','class_name','title','description','is_verified','status','timestamp_occurance','timestamp_created_at','timestamp_updated_at','latitude','longitude','address','user_id','timestamp_declared_at','magnitude','units']
        ];
        return ArrayHelper::merge(parent::scenarios(),$reportItemScenarios);
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
    public function getReportItemMultimedia()
    {
        return $this->hasMany(ReportItemMultimedia::className(), ['report_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportItemRatings()
    {
        return $this->hasMany(ReportItemRating::className(), ['report_item_id' => 'id']);
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
    public function getParent() {
        return $this->hasOne(ReportItem::className(), ['id' => 'parent_id','type' => 'parent_type'])
            ->viaTable(ReportItemChild::tableName(), ['child_id' => 'id','child_type' => 'type']);
    }

    public function getGalleryImages(){
        return $this->hasMany(GalleryImageAr::className(), ['ownerId' => 'id']);
    }
    public function behaviors()
    {
        return [
            [
                'class' => 'ramshresh\behaviors\ar\RelatedBehavior',
            ],
            [
                'class' => 'ramshresh\behaviors\ar\RelationBehavior',

            ],
            [// Auto populates Timestamp for created and update events
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'timestamp_created_at',
                'updatedAtAttribute' => 'timestamp_updated_at',
                'value' => new Expression('NOW()'),
            ],
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'report_item',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@uploads') . '/images/report_item/gallery',
                'tempDirectory' => Yii::getAlias('@uploads') . '/images/temp',
                'route'=>'/uploads/images/report_item/gallery',
                //'url' => Url::to(['/uploads/images/report_item/gallery']),
                //'url' => Url::to(['/uploads/images/report_item/gallery']),
                'tempUrl' => Url::to(['/uploads/images/temp']),
                'versions' => [
                    'small' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new Box(200, 200));
                    },
                    'medium' => function ($img) {
                        /** @var ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ]
        ];
    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub
        //$this->timestamp_occurance = date('Ymdhis', strtotime($this->timestamp_occurance));

        //$this->setAttribute('images',$this->getBehavior('galleryBehavior')->getImages());
        /*
        foreach($this->getBehavior('galleryBehavior')->getImages() as $image) {
            echo Html::img($image->getUrl('medium'));
        }*/

    }

    public function extraFields()
    {
        return ArrayHelper::merge(
            parent::extraFields(),
            [
                'user',
                'parents',
                'children',
                'reportItemRatings',
                'galleryImages',
            ]); // TODO: Change the autogenerated stub
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
            if($this->latitude && $this->longitude && !$this->wkt){
                $this->wkt = "POINT($this->longitude $this->latitude)";
            }

            if($this->wkt){
                $this->geom=new Expression("(SELECT ST_GeomFromText('".$this->wkt."',".$this::SRID."))");
            }
            if($this->tags){
                if(is_array($this->tags)){
                    $this->tags = Json::encode($this->tags);
                }
                $this->tags=new Expression("(select '".$this->tags."'::JSON)");
            }

            //if($this->wkt){
            //    $this->geom=new Expression("(SELECT ST_GeomFromText('".$this->wkt."',".$this::SRID."))");
            //}

            /* Hardcoded for POINT lat lon pointpicker */
            //$this->geom=new Expression("(SELECT ST_PointFromText(:point, :srid))", array(':point' => 'POINT(' . $this->longitude . ' ' . $this->latitude . ')', ':srid' => $this::SRID));

            //}}} ./saving wkt to geometry

            return true;
        } else {
            return false;
        }
    }
    public function linkMultiple($relation,$models){
        foreach($models as $model){
            $this->link($relation,$model);
        }
    }


    public static function getDropDownItemName($parentType){
        return \yii\helpers\ArrayHelper::map(ItemType::find()
            ->where('type=:type',[':type'=>$parentType])
            ->all(), 'item_name', 'item_name');
    }
    /*public function attributes()
    {
        return ArrayHelper::merge(
            parent::attributes(),
            [
                'images',
            ]
        ); // TODO: Change the autogenerated stub
    }*/

    /**
     * Returns a list of links.
     *
     * Each link is either a URI or a [[Link]] object. The return value of this method should
     * be an array whose keys are the relation names and values the corresponding links.
     *
     * If a relation name corresponds to multiple links, use an array to represent them.
     *
     * For example,
     *
     * ```php
     * [
     *     'self' => 'http://example.com/users/1',
     *     'friends' => [
     *         'http://example.com/users/2',
     *         'http://example.com/users/3',
     *     ],
     *     'manager' => $managerLink, // $managerLink is a Link object
     * ]
     * ```
     *
     * @return array the links
     */
    public function getLinks()
    {
        // TODO: Implement getLinks() method.
        return [
            Link::REL_SELF => Url::to(['/rapid_assessment/report-items', 'id' => $this->id], true),
            'gallery_images'=>Url::to(["/rapid_assessment/report-items/$this->id/galleries"], true),
        ];
    }

}
