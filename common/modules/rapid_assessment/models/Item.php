<?php

namespace common\modules\rapid_assessment\models;

use common\components\utils\php\ArrayHelper;
use Yii;

/**
 * This is the model class for table "rapid_assessment.item".
 *
 * @property string $id
 * @property string $name
 * @property string $display_name
 * @property string $tags
 * @property string $meta_hstore
 * @property string $meta_json
 * @property boolean $is_verified
 *
 * @property ItemClass[] $itemClasses
 * @property ItemType[] $itemTypes
 * @property ItemChild[] $itemChildren
 */
class Item extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rapid_assessment.item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['tags', 'meta_hstore', 'meta_json'], 'string'],
            [['is_verified'], 'boolean'],
            [['name', 'display_name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['display_name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'display_name' => Yii::t('app', 'Display Name'),
            'tags' => Yii::t('app', 'Tags'),
            'meta_hstore' => Yii::t('app', 'Meta Hstore'),
            'meta_json' => Yii::t('app', 'Meta Json'),
            'is_verified' => Yii::t('app', 'Is Verified'),
        ];
    }
    function scenarios()
    {
        $scenarios =[
            //This scenario is to be used for Search Model by instance of <Item> or any <class that inherits Item>
            'search'=> ['name','display_name', 'is_verified'],
        ];
        return ArrayHelper::merge(parent::scenarios(),$scenarios);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemClasses()
    {
        return $this->hasMany(ItemClass::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemTypes()
    {
        return $this->hasMany(ItemType::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemChildren()
    {
        return $this->hasMany(ItemChild::className(), ['parent_name' => 'name']);
    }
}
