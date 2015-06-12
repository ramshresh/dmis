<?php

namespace common\modules\building_assessment\models;

use Imagine\Image\Box;
use ramshresh\yii2\galleryManager\GalleryBehavior;
use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\User;

/**
 * This is the model class for table "building_assessment.building_household".
 *
 * @property string $id
 * @property string $owner_name
 * @property string $owner_contact
 * @property string $occupancy_type
 * @property string $current_condition
 * @property string $income_source
 * @property string $income_level
 * @property string $construction_type
 * @property string $current_income_status
 * @property string $damage_type
 * @property integer $user_id
 * @property integer $no_of_occupants
 * @property string $event_name
 * @property string $timestamp_created_at
 * @property string $timestamp_updated_at
 * @property string $timestamp_occurance
 * @property double $longitude
 * @property double $latitude
 * @property string $geom
 * @property string $wkt
 * @property string $address
 * @property integer $c_code
 * @property integer $z_code
 * @property integer $d_code
 * @property integer $v_code
 * @property integer $ward_no
 * @property integer $impact_death
 * @property integer $impact_injured
 * @property integer $impact_missing
 * @property integer $impact_displaced
 * @property integer $impact_orphaned
 * @property string $tags
 *
 * @property User $user
 */
class BuildingHousehold extends \yii\db\ActiveRecord
{
    const SRID = 4326;
    public $attributeOptions = [
        'occupancy_type' => [
            'Club' => 'Club',
            'Commercial' => 'Commercial',
            'Education' => 'Education',
            'Government Office' => 'Government Office',
            'Hotel/Resturant' => 'Hotel/Resturant',
            'Industry' => 'Industry',
            'Medical' => 'Medical',
            'Office Institute' => 'Office Institute',
            'Police Station' => 'Police Station',
            'Residental' => 'Residental'
        ],
        'current_condition' => [
            'At Pal/Tent' => 'At Pal/Tent',
            'At New Rent' => 'At New Rent',
            'Another owned Property' => 'Another owned Property',
            'At Farm Shelter' => 'At Farm Shelter',
            'Sharing floor/room with people/relative' => 'Sharing floor/room with people/relative',
        ],
        'income_source' => [
            'remittance' => 'Remittance',
            'agriculture' => 'Agriculture',
            'business' => 'Business',
            'civil service' => 'Civil Service',
            'daily wage' => 'Daily Wages',
            'private job' => 'Private Job'
        ],
        'income_level' => [

        ],
        'construction_type' => [
            'Adobe' => 'Adobe',
            'Bamboo and Mud' => 'Bamboo and Mud',
            'Brick and Cement' => 'Brick and Cement',
            'Brick and Mud' => 'Brick and Mud',
            'Pillar-Beam Cement' => 'Pillar-Beam Cement',
            'Stone and Mud' => 'Stone and Mud',
            'Stone and Cement' => 'Stone and Cement',
            'Wood Frame' => 'Wood Frame'
        ],
        'current_income_status' => [
            'running' => 'Running',
            'partially running' => 'Partially Running',
            'ended' => 'Ended'
        ],
        'damage_type' => [
            'collapsed' => 'Collapsed',
            'severe damage' => 'Severe Damage',
            'moderate damage' => 'Moderate Damage',

        ],
        'event_name' => [
            'earthquake' => 'Earthquake',
            'fire' => 'Fire',
            'landslide' => 'Landslide',
            'flood' => 'Flood',
        ]

    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'building_assessment.building_household';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['occupancy_type','income_source','construction_type','current_condition'],'safe'],
            [[ 'geom', 'wkt', 'tags'], 'string'],
            [['user_id', 'no_of_occupants', 'c_code', 'z_code', 'd_code', 'v_code', 'ward_no', 'impact_death', 'impact_injured', 'impact_missing', 'impact_displaced', 'impact_orphaned'], 'integer'],
            [['timestamp_created_at', 'timestamp_updated_at', 'timestamp_occurance'], 'safe'],
            [['longitude', 'latitude'], 'number'],
            [['owner_name', 'owner_contact', 'address'], 'string', 'max' => 128],
            [['income_level', 'event_name'], 'string', 'max' => 64],
            [['current_income_status', 'damage_type'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'owner_name' => Yii::t('app', 'Owner Name'),
            'owner_contact' => Yii::t('app', 'Owner Contact'),
            'occupancy_type' => Yii::t('app', 'Occupancy Type'),
            'current_condition' => Yii::t('app', 'Current Condition'),
            'income_source' => Yii::t('app', 'Income Source'),
            'income_level' => Yii::t('app', 'Income Level'),
            'construction_type' => Yii::t('app', 'Construction Type'),
            'current_income_status' => Yii::t('app', 'Current Income Status'),
            'damage_type' => Yii::t('app', 'Damage Type'),
            'user_id' => Yii::t('app', 'User ID'),
            'no_of_occupants' => Yii::t('app', 'No Of Occupants'),
            'event_name' => Yii::t('app', 'Event Name'),
            'timestamp_created_at' => Yii::t('app', 'Timestamp Created At'),
            'timestamp_updated_at' => Yii::t('app', 'Timestamp Updated At'),
            'timestamp_occurance' => Yii::t('app', 'Timestamp Occurance'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'geom' => Yii::t('app', 'Geom'),
            'wkt' => Yii::t('app', 'Wkt'),
            'address' => Yii::t('app', 'Address'),
            'c_code' => Yii::t('app', 'C Code'),
            'z_code' => Yii::t('app', 'Z Code'),
            'd_code' => Yii::t('app', 'D Code'),
            'v_code' => Yii::t('app', 'V Code'),
            'ward_no' => Yii::t('app', 'Ward No'),
            'impact_death' => Yii::t('app', 'Impact Death'),
            'impact_injured' => Yii::t('app', 'Impact Injured'),
            'impact_missing' => Yii::t('app', 'Impact Missing'),
            'impact_displaced' => Yii::t('app', 'Impact Displaced'),
            'impact_orphaned' => Yii::t('app', 'Impact Orphaned'),
            'tags' => Yii::t('app', 'Tags'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getAttributeOptions($attribute)
    {
        return $this->attributeOptions[$attribute];
    }

    public function beforeSave($insert)
    {

        if (parent::beforeSave($insert)) {
            if(is_array($this->occupancy_type))
                $this->occupancy_type=implode(',',$this->occupancy_type);
            if(is_array($this->current_condition))
                $this->current_condition=implode(',',$this->current_condition);
            if(is_array($this->income_source))
                $this->income_source=implode(',',$this->income_source);
            if(is_array($this->construction_type))
                $this->construction_type=implode(',',$this->construction_type);

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

            if($this->isNewRecord && $this->user_id==null && Yii::$app->getUser()->getId() ){
                $this->user_id=Yii::$app->getUser()->getId();
            }
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
                'type' => 'building_household',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@uploads') . '/images/building_assessment/gallery',
                'tempDirectory' => Yii::getAlias('@uploads') . '/images/temp',
                'route'=>'/uploads/images/building_assessment/gallery',
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

}
