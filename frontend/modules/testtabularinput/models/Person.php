<?php

namespace frontend\modules\testtabularinput\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "test_tabular_input.person".
 *
 * @property string $date_of_birth
 * @property string $address
 * @property string $gender
 * @property string $citizenship_no
 * @property integer $id
 * @property string $nationality
 * @property string $full_name
 *
 * @property Student[] $students
 * @property PersonChild[] $personChildren
 * @property Person[] $children
 * @property Person[] $maleChildren
 * @property Person[] $femaleChildren
 * @property Person[] $type1Children
 * @property Student[] $getType1ChildrenStudents
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_tabular_input.person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_of_birth'], 'safe'],
            [['address', 'gender'], 'string'],
            [['citizenship_no'], 'string', 'max' => 7],
            [['nationality', 'full_name'], 'string', 'max' => 75],
            [['citizenship_no'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date_of_birth' => 'Date Of Birth',
            'address' => 'Address',
            'gender' => 'Gender',
            'citizenship_no' => 'Citizenship No',
            'id' => 'ID',
            'nationality' => 'Nationality',
            'full_name' => 'Full Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['personid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonChildren()
    {
        return $this->hasMany(PersonChild::className(), ['parentid' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getChildren() {
            return $this->hasMany(Person::className(), ['id' => 'childid'])
                ->viaTable(PersonChild::tableName(), ['parentid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getMaleChildren() {
        return $this->hasMany(Person::className(), ['id' => 'childid'])->onCondition(['gender'=>'m'])
            ->viaTable(PersonChild::tableName(), ['parentid' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getFemaleChildren() {
        return $this->hasMany(Person::className(), ['id' => 'childid'])->onCondition(['gender'=>'f'])
            ->viaTable(PersonChild::tableName(), ['parentid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getType1Children() {
        return $this->hasMany(Person::className(), ['id' => 'childid'])
            ->viaTable(PersonChild::tableName(), ['parentid' => 'id'],function($query){
                /**
                 * @var $query \yii\db\Query
                 */
                $query->select('*');
                $query->from(PersonChild::tableName());
                $query->where('type=:type',[':type'=>1]);
            });
    }
}
