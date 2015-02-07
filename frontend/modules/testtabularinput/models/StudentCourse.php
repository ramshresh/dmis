<?php

namespace frontend\modules\testtabularinput\models;

use Yii;

/**
 * This is the model class for table "test_tabular_input.student_course".
 *
 * @property integer $id
 * @property string $student_registration_no
 * @property string $course_code_title
 * @property integer $course_code_no
 * @property string $enrollment_date
 * @property double $gpa
 * @property string $completion_date
 *
 * @property Course $courseCodeNo
 * @property Student $studentRegistrationNo
 */
class StudentCourse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_tabular_input.student_course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_registration_no', 'course_code_title', 'course_code_no'], 'required'],
            [['course_code_no'], 'integer'],
            [['enrollment_date', 'completion_date'], 'safe'],
            [['gpa'], 'number'],
            [['student_registration_no'], 'string', 'max' => 7],
            [['course_code_title'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_registration_no' => 'Student Registration No',
            'course_code_title' => 'Course Code Title',
            'course_code_no' => 'Course Code No',
            'enrollment_date' => 'Enrollment Date',
            'gpa' => 'Gpa',
            'completion_date' => 'Completion Date',
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
    public function getCourseCodeNo()
    {
        return $this->hasOne(Course::className(), ['code_no' => 'course_code_no', 'code_title' => 'course_code_title']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentRegistrationNo()
    {
        return $this->hasOne(Student::className(), ['registration_no' => 'student_registration_no']);
    }
}
