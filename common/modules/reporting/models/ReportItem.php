<?php

namespace common\modules\reporting\models;

use common\components\utils\php\pg\PHPG_Utils;
use common\modules\user\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

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
 * @property string $user_id
 *
 * @property Event $emergencySituation
 * @property Event $event
 * @property Incident $incident
 * @property Damage $damage
 * @property Need $need
 *
 *
 * @property Geometry[] $geometries
 * @property Multimedia[] $multimedia
 * @property ReportitemUser[] $reportitemUsers

 * @property Rating[] $ratings

 * @property User $user ReportItem belongs to User

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
     * Single table inheritance
     * @github-reference https://github.com/samdark/yii2-cookbook/blob/master/book/ar-single-table-inheritance.md
     * @param array $row
     * @return Geometry|GeometryLinestring|GeometryPoint|GeometryPolygon
     */
    /*public static function instantiate($row)
    {
        switch ($row['type']) {
            case self::TYPE_EVENT:
                return new ReportItemEvent();
            default:
                return new self;
        }
    }*/

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

            [['type', 'item_name',], 'required','except'=>['search']], // 'except'=>'Search' for search form such as grid view
            ['subtype_name', 'required', 'when' => function($model) {
                 if(sizeof(ItemSubType::find()->where(['item_name'=>$model->item_name])->all())>0)return true; else return false;

            }],
            [['type','user_id',], 'integer'],
            [['description', 'tags', 'meta_hstore', 'meta_json'], 'string'],
            [['is_verified'], 'boolean'],
            [['timestamp_created', 'timestamp_updated'], 'safe'],
            [['subtype_name'], 'string', 'max' => 25],
            [['item_name', 'title'], 'string', 'max' => 75]
        ];
    }

    function scenarios()
    {
        $reportitemScenario =[
            //This scenario is to be used for Search Model by instance of <ReporItem> or any <class that inherits ReportItem>
            'search' => ['type','user_id', 'item_name','is_verified','timestamp_created','subtype_name','timestamp_updated'],
        ];
        return ArrayHelper::merge(parent::scenarios(),$reportitemScenario);
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
            'user_id' => Yii::t('app', 'User Id'),

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser(){
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeometries()
    {
        return $this->hasMany(Geometry::className(), ['reportitem_id' => 'id'])->indexBy('id');
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncident()
    {
        return $this->hasOne(Incident::className(), ['reportitem_id' => 'id']);
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
    public function getEmergencySituation()
    {
        return $this->hasOne(EmergencySituation::className(), ['reportitem_id' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNeed()
    {
        return $this->hasOne(Need::className(), ['reportitem_id' => 'id']);
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
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['reportitem_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDamage()
    {
        return $this->hasOne(Damage::className(), ['reportitem_id' => 'id']);
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
            //{{{ Saving user_id
                if($this->isNewRecord && $this->user_id==null){
                    $this->user_id=Yii::$app->user->id;
                }
            //}}} ./Saving Tags
            return true;
        } else {
            return false;
        }
    }

    public function assignChildren($model){
        $this->link('reportItemChildren',$model);
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
                'createdAtAttribute' => 'timestamp_created',
                'updatedAtAttribute' => 'timestamp_updated',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
