<?php

namespace common\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "tracking.status".
 *
 * @property string $IMEI
 * @property string $status
 * @property string $id
 *
 * @property Driver $driver
 */
class Status extends \yii\db\ActiveRecord
{
    public function extraFields()
    {
        return ['driver'];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tracking.status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IMEI'], 'string', 'max' => 25],
            [['status'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'IMEI' => Yii::t('app', 'Imei'),
            'status' => Yii::t('app', 'Status'),
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['IMEI' => 'IMEI']);
    }
    public function behaviors()
    {
        return [
            [
                'class' => 'mdm\behaviors\ar\IsABehavior',
                'relationClass' => Driver::className(),
                'relationKey' => ['IMEI' => 'IMEI'],
            ],
        ];
    }
}
