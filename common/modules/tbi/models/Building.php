<?php

namespace common\modules\tbi\models;

use common\modules\user\models\Profile;
use common\modules\user\models\User;
use Imagine\Image\Box;
use ramshresh\yii2\galleryManager\GalleryBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\Url;

/**
 * This is the model class for table "tbi.building".
 *
 * @property string $id
 * @property string $user_id
 * @property string $surveyor
 * @property string $surveyed_by
 * @property string $survey_date
 * @property string $owner_name
 * @property string $owner_contact
 * @property string $owner_comment
 * @property string $building_name
 * @property integer $year_of_construction
 * @property integer $no_of_storey
 * @property string $current_use
 * @property string $special_features
 * @property string $type
 * @property string $type_other
 * @property string $style
 * @property string $style_other
 * @property string $physical_condition
 * @property string $physical_condition_comment
 * @property string $street
 * @property string $settlement
 * @property integer $ward_no
 * @property integer $v_code
 * @property integer $d_code
 * @property integer $z_code
 * @property double $latitude
 * @property double $longitude
 * @property string $surveyed_at
 * @property string $timestamp_created_at
 * @property string $timestamp_updated_at
 * @property string $geom
 * @property string $wkt
 *
 * @property \common\modules\user\models\User $user
 * @property \common\modules\user\models\Profile $userProfile
 *
 * @property GalleryImage[] $galleryImages
 * @property GalleryImage[] $photos
 * @property GalleryImage[] $sketches
 */
class Building extends \yii\db\ActiveRecord
{
    const SRID = 4326;

    CONST GALLERY_BEHAVIOR_NAME_PHOTO = 'buildingPhotoGalleryBehavior';
    CONST GALLERY_BEHAVIOR_TYPE_PHOTO = 'building_photo';

    CONST GALLERY_BEHAVIOR_NAME_SKETCH = 'buildingSketchGalleryBehavior';
    CONST GALLERY_BEHAVIOR_TYPE_SKETCH = 'building_sketch';


    public $attributeOptions = [
        "type" => [
            "not_set"=>'not set',
            "1"=>'other',
            "2" =>'pati',
            "3"=>'jahru',
            "4"=>'dyo chhe',
            "5"=>'pokhari',
            "6"=>'sattal',
            "7"=>'hiti',
            "8"=>'inar or kuwa',
            "9"=>'temple',
            "10"=>'freestanding shrines',
            "11"=>'residental dwelling'
        ],
        "style"=>[
            "0"=>"not set",
            "1"=>"other",
            "2"=>"vernacular",
            "3"=>"newar",
            "4"=>"rana",
            "5"=>"modern"
        ],
        "physical_condition"=>[
            "0"=>"not set",
            "1"=>"other",
            "2"=>"no visible damage",
            "3"=>"minor damage",
            "4"=>"partial damage",
            "5"=>"major damage",
            "6"=>"completely collapsed"
        ]
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbi.building';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'year_of_construction', 'no_of_storey', 'ward_no', 'v_code', 'd_code', 'z_code'], 'integer'],
            [['surveyor', 'surveyed_by', 'owner_name', 'owner_contact', 'owner_comment', 'building_name', 'current_use', 'special_features', 'type', 'type_other', 'style', 'style_other', 'physical_condition', 'physical_condition_comment', 'street', 'settlement', 'geom', 'wkt'], 'string'],
            [['survey_date', 'surveyed_at', 'timestamp_created_at', 'timestamp_updated_at'], 'safe'],
            [['latitude', 'longitude'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'surveyor' => Yii::t('app', 'Surveyor'),
            'surveyed_by' => Yii::t('app', 'Surveyed By'),
            'survey_date' => Yii::t('app', 'Survey Date'),
            'owner_name' => Yii::t('app', 'Owner Name'),
            'owner_contact' => Yii::t('app', 'Owner Contact'),
            'owner_comment' => Yii::t('app', 'Owner Comment'),
            'building_name' => Yii::t('app', 'Building Name'),
            'year_of_construction' => Yii::t('app', 'Year Of Construction'),
            'no_of_storey' => Yii::t('app', 'No Of Storey'),
            'current_use' => Yii::t('app', 'Current Use'),
            'special_features' => Yii::t('app', 'Special Features'),
            'type' => Yii::t('app', 'Type'),
            'type_other' => Yii::t('app', 'Type Other'),
            'style' => Yii::t('app', 'Style'),
            'style_other' => Yii::t('app', 'Style Other'),
            'physical_condition' => Yii::t('app', 'Physical Condition'),
            'physical_condition_comment' => Yii::t('app', 'Physical Condition Comment'),
            'street' => Yii::t('app', 'Street'),
            'settlement' => Yii::t('app', 'Settlement'),
            'ward_no' => Yii::t('app', 'Ward No'),
            'v_code' => Yii::t('app', 'V Code'),
            'd_code' => Yii::t('app', 'D Code'),
            'z_code' => Yii::t('app', 'Z Code'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'surveyed_at' => Yii::t('app', 'Surveyed At'),
            'timestamp_created_at' => Yii::t('app', 'Timestamp Created At'),
            'timestamp_updated_at' => Yii::t('app', 'Timestamp Updated At'),
            'geom' => Yii::t('app', 'Geom'),
            'wkt' => Yii::t('app', 'Wkt'),
        ];
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
            'buildingPhotoGalleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => $this::GALLERY_BEHAVIOR_TYPE_PHOTO,
                'modelClass'=>GalleryImage::className(),
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@uploads') . '/images/tbi/building_photo',
                'tempDirectory' => Yii::getAlias('@uploads') . '/images/temp',
                'route'=>'/uploads/images/tbi/building_photo',
                'tempUrl' => Url::to(['/uploads/images/temp']),
                'versions' => [
                    'small' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new Box(50, 50));
                    }
                ]
            ],

            'buildingSketchGalleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'modelClass'=>GalleryImage::className(),
                'type' => $this::GALLERY_BEHAVIOR_TYPE_SKETCH,
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@uploads').DIRECTORY_SEPARATOR.'images/tbi'.DIRECTORY_SEPARATOR.$this::GALLERY_BEHAVIOR_TYPE_SKETCH,
                'tempDirectory' => Yii::getAlias('@uploads') . '/images/temp',
                'route'=>'/uploads/images/tbi/building_sketch',
                'tempUrl' => Url::to(['/uploads/images/temp']),
                'versions' => [
                    'small' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new Box(50, 50));
                    }
                ]
            ]
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

            if($this->isNewRecord && $this->user_id==null && Yii::$app->getUser()->getId() ){
                $this->user_id=Yii::$app->getUser()->getId();
            }
            if($this->latitude && $this->longitude && !$this->wkt){
                $this->wkt = "POINT($this->longitude $this->latitude)";
            }

            if($this->wkt){
                $this->geom=new Expression("(SELECT ST_GeomFromText('".$this->wkt."',".$this::SRID."))");
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
    public function getUserProfile()
    {
        //@todo Constrains in database is not set
        return $this->hasOne(Profile::className(), ['user_id' => 'id'])->via('user');
    }

    public function getGalleryImages(){
        return $this->hasMany(GalleryImage::className(),['ownerId' => 'id']);
    }

    public function getPhotos(){
        return $this->hasMany(
            GalleryImage::className(),
            [
                'ownerId' => 'id'
            ]
        )->andFilterWhere(['=','type',$this::GALLERY_BEHAVIOR_TYPE_PHOTO]);
    }

    public function getSketches(){
        return $this->hasMany(
            GalleryImage::className(),
            [
                'ownerId' => 'id'
            ]
        )->andFilterWhere(['=','type',$this::GALLERY_BEHAVIOR_TYPE_SKETCH]);
    }

    public function extraFields()
    {
        return ArrayHelper::merge(
            parent::extraFields(),
            [
                'user',
                'userProfile',
                'galleryImages',
                'sketches',
                'photos',
            ]); // TODO: Change the autogenerated stub
    }
}
