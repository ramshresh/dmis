<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.item".
 *
 * @property integer $id
 * @property string $name
 * @property string $tags
 * @property string $meta_hstore
 * @property string $meta_json
 * @property string $displayname
 *
 * @property ItemType[] $itemTypes
 * @property ItemChild[] $itemChildren
 * @property ItemSymbol[] $itemSymbols
 * @property ItemSubtype[] $itemSubtypes
 * @property Reportitem[] $reportitems
 *
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tags', 'meta_hstore', 'meta_json'], 'string'],
            [['name', 'displayname'], 'string', 'max' => 75],
            [['name'], 'unique'],
            [['displayname'], 'unique']
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
            'tags' => Yii::t('app', 'Tags'),
            'meta_hstore' => Yii::t('app', 'Meta Hstore'),
            'meta_json' => Yii::t('app', 'Meta Json'),
            'displayname' => Yii::t('app', 'Displayname'),
        ];
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
    public function getItemSymbols()
    {
        return $this->hasMany(ItemSymbol::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemSubtypes()
    {
        return $this->hasMany(ItemSubtype::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportitems()
    {
        return $this->hasMany(Reportitem::className(), ['item_name' => 'name']);
    }

    public static function getDropDownItemType(){
        return ['0'=>'Emergency Situation','1'=>'Event','2'=>'Incident','3'=>'Damage','4'=>'Need'];
    }

    public static function getDropDownItemName($type){
        return \yii\helpers\ArrayHelper::map(ItemType::find()
            ->where('type=:type',[':type'=>$type])
            ->all(), 'item_name', 'item_name');
    }

    public static function getDropDownItemChild($type,$itemName){
        self::hasMany(self::className(),['name'=>'name'])->viaTable(ItemChild::tableName(),['parent_name'=>'name'],function($q){
            $q->andWhere(['parent_type'=>$type]);
        });
        return \yii\helpers\ArrayHelper::map(ItemType::find()
            ->where('type=:type',[':type'=>$type])
            ->all(), 'item_name', 'item_name');
    }
}
