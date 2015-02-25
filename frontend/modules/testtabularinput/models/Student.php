<?php

namespace frontend\modules\testtabularinput\models;

use Yii;
use frontend\modules\testtabularinput\models\Course;
use frontend\modules\testtabularinput\models\StudentCourse;

/**
 * This is the model class for table "test_tabular_input.student".
 *
 * @property integer $id
 * @property string $registration_no
 * @property integer $personid
 *
 * @property Person $person
 * @property StudentCourse[] $studentCourses
 * @property Course[] $courses
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_tabular_input.student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registration_no'], 'required'],
            [['registration_no'], 'string', 'max' => 7]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'registration_no' => 'Registration No',
            'personid' => 'Personid',
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
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'personid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCourses()
    {
        return $this->hasMany(StudentCourse::className(), ['student_registration_no' => 'registration_no']);
    }

    /**
     * @return \yii\db\ActiveQuery
     * @stackoverflow http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function getCourses() {
        return $this->hasMany(Course::className(),['code_title'=>'course_code_title','code_no'=>'course_code_no'])
            ->viaTable(StudentCourse::tableName(), ['student_registration_no' => 'registration_no']);
    }
}
