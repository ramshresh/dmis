<?php

namespace common\modules\heritage_assessment\models;

use Imagine\Image\Box;
use ramshresh\yii2\galleryManager\GalleryBehavior;
use ramshresh\yii2\galleryManager\GalleryImageAr;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "heritage_assessment.heritage".
 *
 * @property string $id
 * @property string $kitta_no
 * @property string $inventory_id
 * @property string $damage_type
 * @property string $present_physical_conditions
 * @property string $historical_socio_cultural_significance
 * @property string $important_features
 * @property string $items_to_be_preserved_before
 * @property string $items_to_be_preserved_after
 * @property string $description
 * @property string $recorded_by
 * @property string $surveyor_opinion_before
 * @property string $surveyor_opinion_after
 * @property string $old_date
 * @property string $new_date
 * @property string $timestamp_created_at
 * @property string $timestamp_updated_at
 * @property double $latitude
 * @property double $longitude
 * @property string $geom
 * @property string $wkt
 * @property integer $d_code
 * @property integer $v_code
 * @property integer $ward_no
 * @property string $user_id
 * @property file $photo
 */
class Heritage extends \yii\db\ActiveRecord
{
    CONST SRID=4326;
    public $photo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'heritage_assessment.heritage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kitta_no', 'inventory_id', 'damage_type', 'present_physical_conditions', 'historical_socio_cultural_significance', 'important_features', 'items_to_be_preserved_before','items_to_be_preserved_after', 'description', 'recorded_by', 'surveyor_opinion_before','surveyor_opinion_after', 'geom', 'wkt'], 'string'],
            [['old_date', 'new_date', 'timestamp_created_at', 'timestamp_updated_at'], 'safe'],
            [['latitude', 'longitude'], 'number'],
            [['photo'], 'file'],
            [['d_code', 'v_code', 'ward_no', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kitta_no' => Yii::t('app', 'Kitta No'),
            'inventory_id' => Yii::t('app', 'Inventory Id'),
            'damage_type' => Yii::t('app', 'Damage Type'),
            'present_physical_conditions' => Yii::t('app', 'Present Physical Conditions'),
            'historical_socio_cultural_significance' => Yii::t('app', 'Historical Socio Cultural Significance'),
            'important_features' => Yii::t('app', 'Important Features'),
            'items_to_be_preserved_before' => Yii::t('app', 'Items To Be Preserved Before'),
            'items_to_be_preserved_after' => Yii::t('app', 'Items To Be Preserved After'),
            'description' => Yii::t('app', 'Description'),
            'recorded_by' => Yii::t('app', 'Recorded By'),
            'surveyor_opinion_before' => Yii::t('app', 'Surveyor Opinion Before'),
            'surveyor_opinion_after' => Yii::t('app', 'Surveyor Opinion After'),
            'old_date' => Yii::t('app', 'Old Date'),
            'new_date' => Yii::t('app', 'New Date'),
            'timestamp_created_at' => Yii::t('app', 'Timestamp Created At'),
            'timestamp_updated_at' => Yii::t('app', 'Timestamp Updated At'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'geom' => Yii::t('app', 'Geom'),
            'wkt' => Yii::t('app', 'Wkt'),
            'd_code' => Yii::t('app', 'D Code'),
            'v_code' => Yii::t('app', 'V Code'),
            'ward_no' => Yii::t('app', 'Ward No'),
            'user_id' => Yii::t('app', 'User ID'),
            'photo' => Yii::t('app', 'Photo'),
        ];
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
                'type' => 'heritage',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@uploads') . '/images/heritage_assessment/gallery',
                'tempDirectory' => Yii::getAlias('@uploads') . '/images/temp',
                'route'=>'/uploads/images/heritage_assessment/gallery',
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

    public function beforeSave($insert)
    {

        if (parent::beforeSave($insert)) {
            if(is_array($this->present_physical_conditions))
                $this->present_physical_conditions=implode(',',$this->present_physical_conditions);
            if(is_array($this->historical_socio_cultural_significance))
                $this->historical_socio_cultural_significance=implode(',',$this->historical_socio_cultural_significance);
            if(is_array($this->important_features))
                $this->important_features=implode(',',$this->important_features);
            if(is_array($this->items_to_be_preserved_before))
                $this->items_to_be_preserved_before=implode(',',$this->items_to_be_preserved_before);
            if(is_array($this->items_to_be_preserved_after))
                $this->items_to_be_preserved_after=implode(',',$this->items_to_be_preserved_after);

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

    public function extraFields()
    {
        return ArrayHelper::merge(
            parent::extraFields(),
            [
                'user',
                'galleryImages',
            ]); // TODO: Change the autogenerated stub
    }

}
