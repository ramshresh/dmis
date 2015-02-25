<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\testtabularinput\models\StudentCourse */

$this->title = $model->student_registration_no;
$this->params['breadcrumbs'][] = ['label' => 'Student Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-course-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'student_registration_no' => $model->student_registration_no, 'course_code_title' => $model->course_code_title, 'course_code_no' => $model->course_code_no], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'student_registration_no' => $model->student_registration_no, 'course_code_title' => $model->course_code_title, 'course_code_no' => $model->course_code_no], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'student_registration_no',
            'course_code_title',
            'course_code_no',
            'enrollment_date',
            'gpa',
            'completion_date',
        ],
    ]) ?>

</div>
