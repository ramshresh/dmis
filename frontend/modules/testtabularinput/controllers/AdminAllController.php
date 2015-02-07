<?php

namespace frontend\modules\testtabularinput\controllers;

use common\components\MyBaseContoller;
use common\components\MyFileHelper;
use frontend\modules\testtabularinput\models\Person;

use frontend\modules\testtabularinput\models\PersonSearch;
use frontend\modules\testtabularinput\models\Student;

use frontend\modules\testtabularinput\models\StudentSearch;
use Yii;
use frontend\modules\testtabularinput\models\Course;
use frontend\modules\testtabularinput\models\CourseSearch;

use yii\db\Exception;
use yii\helpers\Json;

class AdminAllController extends MyBaseContoller{
    public function actionIndex(){
        return $this->render('index');
    }

    public function actionWidgetsPjax(){
        $model = new Course();
        $searchModel = new CourseSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        if(Yii::$app->request->post()){
            $model->load(Yii::$app->request->post());
            if($model->save()){
                $cArr = [
                    'message'=>'Success! Well done its submitted.',
                    '$_POST'=>Yii::$app->request->post(),
                    '$model'=>$model,
                ];
                $detail = Json::encode($cArr);
                MyFileHelper::writeFileToWebrootAssets($detail,'test','txt');

                Yii::$app->session->setFlash('course-save-success',['message'=>'Saved! Well done','detail'=>$detail]);
                $model = new Course();
            }else{
                $detail = Json::encode($model->getErrors());
                MyFileHelper::writeFileToWebrootAssets($detail,'test','txt');
                Yii::$app->session->setFlash('course-save-error',['message'=>'Sorry! Could not save it','detail'=>$detail]);
            }
        }

        return $this->render('widgets/pjax',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
            'model'=>$model,
        ]);
    }

    public function actionFilteringGridviewComboboxPjax(){

    }

    /**
     * @stackoverflow: http://stackoverflow.com/questions/26763298/how-do-i-work-with-many-to-many-relations-in-yii2
     */
    public function actionTestSaveRelated(){
        /**
         * ----------------------------------------------------------------------------
         * RELATION : BELONGS_TO and HAS_ONE
         * CASE 1 : A BELONGS_TO B  (Example: Student BELONGS_TO Person)
         * (A references its fk from B's pk  i.e A has fk column)
         * 1. create parent model
         * 2. save parent model
         * 3. create child model
         * 4. link parent model to the child model
         * 5. save child model
         * COROLLARY : A HAS_ONE B
         * (A pk is referenced by B in its fk i.e B has fk column)
         * the procedure is just reversed.
         * ----------------------------------------------------------------------------
         * RELATION  : MANY_TO_MANY
         * CASE 1: A HAS_MANY B  and B HAS_MANY A linked by relation C (Example Student HAS_MANY Courses and Course HAS_MANY Student LINKED_BY StudentCourse)
         * (pk of A and that of B are present in the relation C as fk columns)
         * 1. create many A, ie A1, A2 ... An
         * 2. create many B. ie. B1,B2,...Bn
         * 3. Then
         * link A to many B
         *  Or
         * B to many A
         *
         */
        $transaction = Yii::$app->db->beginTransaction();
            try {
                $person1 = new Person();
                $person1->date_of_birth = '1989-09-29';
                $person1->address = 'Panauti-3,Kavre';
                $person1->gender = 'm';
                $person1->nationality = 'Nepali';
                $person1->full_name = 'Ram Shrestha';
                $person1->citizenship_no = '23249-3';
                $person1->save();

                $student1 = new Student();
                $student1->registration_no = '0091-01';
                $student1->link('person', $person1);
                $student1->save();

                $person2 = new Person();
                $person2->date_of_birth = '1989-09-28';
                $person2->address = 'Panauti-3,Kavre';
                $person2->gender = 'm';
                $person2->nationality = 'Nepali';
                $person2->full_name = 'Shyam Shrestha';
                $person2->citizenship_no = '23949-3';
                $person2->save();

                $student2 = new Student();
                $student2->registration_no = '0041-01';
                $student2->link('person', $person2);
                $student2->save();


                $course1 = new Course();
                $course1->code_title = 'MATH';
                $course1->code_no = '207';
                $course1->title = 'Differential Calculas';
                $course1->save();

                $course2 = new Course();
                $course2->code_title = 'COMP';
                $course2->code_no = '101';
                $course2->title = 'Intruduction to Computer Science';
                $course2->save();

                $student1->link('courses', $course1);
                $student1->link('courses', $course2);
                $transaction->commit();
                $message = 'Success!';
            }catch (Exception $e){
                $message=Json::encode($e->getMessage());
                $transaction->rollBack();
            }

            return $this->render('test-save-related/index',['message'=>$message]);

        //return $this->render('test-save-related/index');

    }

    public function actionStudentRegistration(){
        $person = new Person();
        $student = new Student();

        $post =Yii::$app->request->post();
        if($person->load($post) && $student->load($post)){
            // validate for normal request
            if ($person->validate() && $student->validate()) {
                $person->save();
                $student->link('person',$person);
                $student->save();

                $person = new Person();
                $student = new Student();

            }
        }

        $personSearchModel = new PersonSearch();
        $personDataProvider = $personSearchModel->search(\Yii::$app->request->queryParams);

        $studentSearchModel = new StudentSearch();
        $studentDataProvider = $studentSearchModel->search(\Yii::$app->request->queryParams);

        return $this->render(
            'student-registration/form',
            [
                'person'=>$person,
                'student'=>$student,
                'personSearchModel'=>$personSearchModel,
                'studentSearchModel'=>$studentSearchModel,
                'personDataProvider'=>$personDataProvider,
                'studentDataProvider'=>$studentDataProvider,
            ]
        );
    }
}
