<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.symbol_icon".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $format
 * @property string $extension
 * @property string $path
 * @property string $url
 * @property integer $size
 * @property integer $resolution_x
 * @property integer $resolution_y
 * @property string $source
 * @property string $description
 * @property boolean $is_verified
 * @property string $tags
 * @property string $meta_hstore
 * @property string $meta_json
 *
 * @property ItemSymbolIcon[] $itemSymbolIcons
 */
class SymbolIcon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.symbol_icon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'path', 'url'], 'required'],
            [['type', 'size', 'resolution_x', 'resolution_y'], 'integer'],
            [['path', 'url', 'source', 'description', 'tags', 'meta_hstore', 'meta_json'], 'string'],
            [['is_verified'], 'boolean'],
            [['name'], 'string', 'max' => 75],
            [['format', 'extension'], 'string', 'max' => 10],
            [['path', 'url'], 'unique', 'targetAttribute' => ['path', 'url'], 'message' => 'The combination of Path and Url has already been taken.']
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
            'name' => Yii::t('app', 'Name'),
            'format' => Yii::t('app', 'Format'),
            'extension' => Yii::t('app', 'Extension'),
            'path' => Yii::t('app', 'Path'),
            'url' => Yii::t('app', 'Url'),
            'size' => Yii::t('app', 'Size'),
            'resolution_x' => Yii::t('app', 'Resolution X'),
            'resolution_y' => Yii::t('app', 'Resolution Y'),
            'source' => Yii::t('app', 'Source'),
            'description' => Yii::t('app', 'Description'),
            'is_verified' => Yii::t('app', 'Is Verified'),
            'tags' => Yii::t('app', 'Tags'),
            'meta_hstore' => Yii::t('app', 'Meta Hstore'),
            'meta_json' => Yii::t('app', 'Meta Json'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemSymbolIcons()
    {
        return $this->hasMany(ItemSymbolIcon::className(), ['symbol_id' => 'id']);
    }
}
