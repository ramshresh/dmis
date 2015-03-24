<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.multimedia".
 *
 * @property integer $id
 * @property integer $reportitem_id
 * @property string $type
 * @property string $title
 * @property string $extension
 * @property string $thumbnail_url
 * @property string $description
 * @property double $latitude
 * @property double $longitude
 * @property string $url
 * @property string $path
 * @property string $timestamp_taken
 * @property string $caption
 * @property integer $resolution_x
 * @property integer $resolution_y
 * @property integer $size_bytes
 * @property boolean $is_verified
 * @property string $tags
 * @property string $meta_hstore
 * @property string $meta_json
 *
 * @property Reportitem $reportitem
 */
class Multimedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.multimedia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reportitem_id', 'resolution_x', 'resolution_y', 'size_bytes'], 'integer'],
            [['thumbnail_url', 'url', 'path', 'tags', 'meta_hstore', 'meta_json'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['timestamp_taken'], 'safe'],
            [['is_verified'], 'boolean'],
            [['type', 'title', 'caption'], 'string', 'max' => 75],
            [['extension'], 'string', 'max' => 10],
            [['description'], 'string', 'max' => 255]
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
            'type' => Yii::t('app', 'Type'),
            'title' => Yii::t('app', 'Title'),
            'extension' => Yii::t('app', 'Extension'),
            'thumbnail_url' => Yii::t('app', 'Thumbnail Url'),
            'description' => Yii::t('app', 'Description'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'url' => Yii::t('app', 'Url'),
            'path' => Yii::t('app', 'Path'),
            'timestamp_taken' => Yii::t('app', 'Timestamp Taken'),
            'caption' => Yii::t('app', 'Caption'),
            'resolution_x' => Yii::t('app', 'Resolution X'),
            'resolution_y' => Yii::t('app', 'Resolution Y'),
            'size_bytes' => Yii::t('app', 'Size Bytes'),
            'is_verified' => Yii::t('app', 'Is Verified'),
            'tags' => Yii::t('app', 'Tags'),
            'meta_hstore' => Yii::t('app', 'Meta Hstore'),
            'meta_json' => Yii::t('app', 'Meta Json'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportitem()
    {
        return $this->hasOne(Reportitem::className(), ['id' => 'reportitem_id']);
    }
}
