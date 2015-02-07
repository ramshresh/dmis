<?php

namespace frontend\modules\testtabularinput\models;

use Yii;

/**
 * This is the model class for table "test_tabular_input.person_child".
 *
 * @property integer $parentid
 * @property integer $childid
 * @property integer $type
 *
 * @property Person $parent
 * @property Person $child
 */
class PersonChild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_tabular_input.person_child';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parentid' => Yii::t('app', 'Parentid'),
            'childid' => Yii::t('app', 'Childid'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Person::className(), ['id' => 'parentid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild()
    {
        return $this->hasOne(Person::className(), ['id' => 'childid']);
    }
}
