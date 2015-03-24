<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.units".
 *
 * @property integer $id
 * @property string $standard
 * @property string $category
 * @property string $shortname
 * @property string $displayname
 * @property string $timestamp_created
 * @property string $timestamp_updated
 * @property boolean $is_verified
 * @property string $tags
 * @property string $meta_hstore
 * @property string $meta_json
 *
 * @property Need[] $needs
 * @property Damage[] $damages
 */
class Units extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.units';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['standard', 'category'], 'required'],
            [['timestamp_created', 'timestamp_updated'], 'safe'],
            [['is_verified'], 'boolean'],
            [['tags', 'meta_hstore', 'meta_json'], 'string'],
            [['standard', 'category', 'shortname', 'displayname'], 'string', 'max' => 25],
            [['displayname'], 'unique'],
            [['shortname'], 'unique'],
            [['shortname', 'displayname'], 'unique', 'targetAttribute' => ['shortname', 'displayname'], 'message' => 'The combination of Shortname and Displayname has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'standard' => Yii::t('app', 'Standard'),
            'category' => Yii::t('app', 'Category'),
            'shortname' => Yii::t('app', 'Shortname'),
            'displayname' => Yii::t('app', 'Displayname'),
            'timestamp_created' => Yii::t('app', 'Timestamp Created'),
            'timestamp_updated' => Yii::t('app', 'Timestamp Updated'),
            'is_verified' => Yii::t('app', 'Is Verified'),
            'tags' => Yii::t('app', 'Tags'),
            'meta_hstore' => Yii::t('app', 'Meta Hstore'),
            'meta_json' => Yii::t('app', 'Meta Json'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNeeds()
    {
        return $this->hasMany(Need::className(), ['units_displayname' => 'displayname', 'units_shortname' => 'shortname']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDamages()
    {
        return $this->hasMany(Damage::className(), ['units_displayname' => 'displayname', 'units_shortname' => 'shortname']);
    }
}
