<?php

namespace common\modules\vdc\models;

use common\components\utils\php\ArrayHelper;
use Yii;

/**
 * This is the model class for table "nepal_vdc".
 *
 * @property integer $gid
 * @property integer $dcode
 * @property string $dname
 * @property integer $vcode
 * @property integer $ddvvv
 * @property string $aan
 * @property integer $effect_dis
 * @property string $geom
 */
class NepalVdc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nepal_vdc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dcode', 'vcode', 'ddvvv', 'effect_dis'], 'integer'],
            [['geom'], 'string'],
            [['dname', 'aan'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gid' => Yii::t('app', 'Gid'),
            'dcode' => Yii::t('app', 'Dcode'),
            'dname' => Yii::t('app', 'Dname'),
            'vcode' => Yii::t('app', 'Vcode'),
            'ddvvv' => Yii::t('app', 'Ddvvv'),
            'aan' => Yii::t('app', 'Aan'),
            'effect_dis' => Yii::t('app', 'Effect Dis'),
            'geom' => Yii::t('app', 'Geom'),
        ];
    }
    public static function getListData(){
        return ArrayHelper::map(NepalVdc::find()->asArray()->all,'aan','aan');
    }
}
