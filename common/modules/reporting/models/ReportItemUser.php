<?php

namespace common\modules\reporting\models;

use Yii;

/**
 * This is the model class for table "reporting.reportitem_user".
 *
 * @property integer $id
 * @property integer $reportitem_id
 * @property integer $user_id
 * @property integer $action_type
 * @property string $timestamp
 */
class ReportItemUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.reportitem_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reportitem_id', 'user_id'], 'required'],
            [['reportitem_id', 'user_id', 'action_type'], 'integer'],
            [['timestamp'], 'safe'],
            [['reportitem_id', 'user_id', 'action_type'], 'unique', 'targetAttribute' => ['reportitem_id', 'user_id', 'action_type'], 'message' => 'The combination of Reportitem ID, User ID and Action Type has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reportitem_id' => Yii::t('app', 'Reportitem ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'action_type' => Yii::t('app', 'Action Type'),
            'timestamp' => Yii::t('app', 'Timestamp'),
        ];
    }
}
