<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.reportitem_child".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $child_id
 * @property integer $parent_type
 * @property integer $child_type
 *
 * @property ReportItem $parent
 * @property ReportItem $child
 */
class ReportItemChild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.reportitem_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'child_id', 'parent_type', 'child_type'], 'integer']
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
    public function getParent()
    {
        return $this->hasOne(ReportItem::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild()
    {
        return $this->hasOne(ReportItem::className(), ['id' => 'child_id']);
    }
}
