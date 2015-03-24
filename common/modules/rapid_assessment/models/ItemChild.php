<?php

namespace common\modules\rapid_assessment\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rapid_assessment.item_child".
 *
 * @property string $id
 * @property string $parent_name
 * @property string $child_name
 * @property integer $parent_type
 * @property integer $child_type
 * @property boolean $is_verified
 *
 * @property Item $childName
 * @property Item $parentName
 */
class ItemChild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rapid_assessment.item_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_name', 'child_name', 'parent_type', 'child_type'], 'required'],
            [['is_verified'], 'boolean'],
            [['parent_type', 'child_type','parent_name', 'child_name'], 'string', 'max' => 255],
            [['parent_name', 'child_name', 'parent_type', 'child_type'], 'unique', 'targetAttribute' => ['parent_name', 'child_name', 'parent_type', 'child_type'], 'message' => 'The combination parent and child names types already taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_name' => Yii::t('app', 'Parent Name'),
            'child_name' => Yii::t('app', 'Child Name'),
            'parent_type' => Yii::t('app', 'Parent Type'),
            'child_type' => Yii::t('app', 'Child Type'),
            'is_verified' => Yii::t('app', 'Is Verified'),
        ];
    }
    function scenarios()
    {
        $scenarios =[
            //This scenario is to be used for Search Model by instance , or any vhild
            'search'=> ['parent_name','child_name','parent_type','child_type', 'is_verified'],
        ];
        return ArrayHelper::merge(parent::scenarios(),$scenarios);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildName()
    {
        return $this->hasOne(Item::className(), ['name' => 'child_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentName()
    {
        return $this->hasOne(Item::className(), ['name' => 'parent_name']);
    }
}
