<?php

namespace common\modules\rapid_assessment\models;

use Yii;

/**
 * This is the model class for table "rapid_assessment.report_item_multimedia".
 *
 * @property string $id
 * @property string $report_item_id
 * @property string $type
 * @property string $title
 * @property string $extension
 * @property string $thumbnail_url
 * @property string $description
 * @property double $latitude
 * @property double $longitude
 * @property string $url
 * @property string $path
 * @property string $timestamp_taken_at
 * @property string $caption
 * @property integer $resolution_x
 * @property integer $resolution_y
 * @property integer $size_bytes
 * @property boolean $is_verified
 * @property string $tags
 * @property string $meta_hstore
 * @property string $meta_json
 *
 * @property ReportItem $reportItem
 */
class ReportItemMultimedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rapid_assessment.report_item_multimedia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_item_id', 'resolution_x', 'resolution_y', 'size_bytes'], 'integer'],
            [['thumbnail_url', 'url', 'path', 'tags', 'meta_hstore', 'meta_json'], 'string'],
            [['latitude', 'longitude'], 'number'],
            [['timestamp_taken_at'], 'safe'],
            [['is_verified'], 'boolean'],
            [['type', 'title', 'extension', 'description', 'caption'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'report_item_id' => Yii::t('app', 'Report Item ID'),
            'type' => Yii::t('app', 'Type'),
            'title' => Yii::t('app', 'Title'),
            'extension' => Yii::t('app', 'Extension'),
            'thumbnail_url' => Yii::t('app', 'Thumbnail Url'),
            'description' => Yii::t('app', 'Description'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'url' => Yii::t('app', 'Url'),
            'path' => Yii::t('app', 'Path'),
            'timestamp_taken_at' => Yii::t('app', 'Timestamp Taken At'),
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
    public function getReportItem()
    {
        return $this->hasOne(ReportItem::className(), ['id' => 'report_item_id']);
    }
}
