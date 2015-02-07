<?php

namespace frontend\modules\testtabularinput\models;

use Yii;

/**
 * This is the model class for table "test_tabular_input.course".
 *
 * @property integer $id
 * @property string $title
 * @property string $code_title
 * @property integer $code_no
 *
 * @property StudentCourse[] $studentCourses
 * @property Student[] $students
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_tabular_input.course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code_title', 'code_no'], 'required'],
            [['code_no'], 'integer'],
            [['title'], 'string', 'max' => 75],
            [['code_title'], 'string', 'max' => 4],
            // code_no and code_title need to be unique together, and they both will receive error message
            /* @link http://www.yiiframework.com/doc-2.0/yii-validators-uniquevalidator.html */
            [['code_no', 'code_title'], 'unique', 'targetAttribute' => ['code_no', 'code_title'],'message'=>'code title with code number must be unique ']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'code_title' => 'Code Title',
            'code_no' => 'Code No',
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'relation' => [
                'class' => 'common\components\RelationBehavior',
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCourses()
    {
        return $this->hasMany(StudentCourse::className(), ['course_code_no' => 'code_no', 'course_code_title' => 'code_title']);
    }


    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getStudents() {
        return $this->hasMany(Student::className(), ['registration_no' => 'student_registration_no'])
            ->viaTable(StudentCourse::tableName(), ['course_code_title'=>'code_title','course_code_no'=>'code_no']);
    }
}
