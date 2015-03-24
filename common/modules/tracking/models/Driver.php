<?php

namespace common\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "tracking.driver".
 *
 * @property string $Firstname
 * @property string $Lastname
 * @property string $Address
 * @property string $Phonr
 * @property string $IMEI
 * @property string $Gender
 * @property string $Ambulance_Number
 * @property string $id
 *
 * @property Location[] $locations
 * @property Coordinate $coordinate
 * @property Status $status
 */
class Driver extends \yii\db\ActiveRecord
{
    public function extraFields()
    {
        return ['locations','coordinate','status'];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tracking.driver';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Firstname', 'Lastname', 'Address', 'Phonr', 'IMEI', 'Gender'], 'required'],
            [['Firstname', 'Lastname', 'Address', 'Phonr', 'IMEI'], 'string', 'max' => 255],
            [['Gender'], 'string', 'max' => 20],
            [['Ambulance_Number'], 'string', 'max' => 25],
            [['IMEI'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Firstname' => Yii::t('app', 'Firstname'),
            'Lastname' => Yii::t('app', 'Lastname'),
            'Address' => Yii::t('app', 'Address'),
            'Phonr' => Yii::t('app', 'Phonr'),
            'IMEI' => Yii::t('app', 'Imei'),
            'Gender' => Yii::t('app', 'Gender'),
            'Ambulance_Number' => Yii::t('app', 'Ambulance  Number'),
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['device_id' => 'IMEI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoordinate()
    {
        return $this->hasOne(Coordinate::className(), ['device_id' => 'IMEI']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['IMEI' => 'IMEI']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => 'mdm\behaviors\ar\RelatedBehavior',
            ],
            [
                'class' => 'mdm\behaviors\ar\RelationBehavior',
            ],
        ];
    }
//https://github.com/yiisoft/yii2/issues/1282
    public function getModelRelations(){
        $reflector = new \ReflectionClass($this->modelClass);
        $model = new $this->modelClass;
        $stack = array();
        foreach ($reflector->getMethods() AS $method) {
            if (substr($method->name,0,3) !== 'get') continue;
            if ($method->name === 'getRelation') continue;
            if ($method->name === 'getBehavior') continue;
            if ($method->name === 'getFirstError') continue;
            if ($method->name === 'getAttribute') continue;
            if ($method->name === 'getAttributeLabel') continue;
            if ($method->name === 'getOldAttribute') continue;

            $relation = call_user_func(array($model,$method->name));
            if($relation instanceof yii\db\ActiveRelation) {
                $stack[] = $relation;
            }
        }
        return $stack;
    }
}
