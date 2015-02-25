<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\testtabularinput\models\StudentCourse */

$this->title = 'Update Student Course: ' . ' ' . $model->student_registration_no;
$this->params['breadcrumbs'][] = ['label' => 'Student Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->student_registration_no, 'url' => ['view', 'student_registration_no' => $model->student_registration_no, 'course_code_title' => $model->course_code_title, 'course_code_no' => $model->course_code_no]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-course-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
