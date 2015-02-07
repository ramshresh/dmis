<?php

namespace frontend\modules\testtabularinput\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\testtabularinput\models\StudentCourse;

/**
 * StudentCourseSearch represents the model behind the search form about `frontend\modules\testtabularinput\models\StudentCourse`.
 */
class StudentCourseSearch extends StudentCourse
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'course_code_no'], 'integer'],
            [['student_registration_no', 'course_code_title', 'enrollment_date', 'completion_date'], 'safe'],
            [['gpa'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = StudentCourse::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'course_code_no' => $this->course_code_no,
            'enrollment_date' => $this->enrollment_date,
            'gpa' => $this->gpa,
            'completion_date' => $this->completion_date,
        ]);

        $query->andFilterWhere(['like', 'student_registration_no', $this->student_registration_no])
            ->andFilterWhere(['like', 'course_code_title', $this->course_code_title]);

        return $dataProvider;
    }
}
