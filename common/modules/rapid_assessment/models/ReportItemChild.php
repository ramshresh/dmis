<?php

namespace common\modules\rapid_assessment\models;

use Yii;

/**
 * This is the model class for table "rapid_assessment.report_item_child".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $child_id
 * @property integer $parent_type
 * @property integer $child_type
 *
 * @property ReportItem $child
 * @property ReportItem $parent
 */
class ReportItemChild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rapid_assessment.report_item_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'child_id', 'parent_type', 'child_type'], 'required'],
            [['parent_id', 'child_id'], 'integer'],
            [['parent_type', 'child_type'], 'string', 'max' => 255],
            [['child_id', 'parent_id'], 'unique', 'targetAttribute' => ['child_id', 'parent_id'], 'message' => 'The combination parent and child ids already taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'child_id' => Yii::t('app', 'Child ID'),
            'parent_type' => Yii::t('app', 'Parent Type'),
            'child_type' => Yii::t('app', 'Child Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild()
    {
        return $this->hasOne(ReportItem::className(), ['id' => 'child_id', 'type' => 'child_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ReportItem::className(), ['id' => 'parent_id', 'type' => 'parent_type']);
    }
}
