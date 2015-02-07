<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\testtabularinput\models\StudentCourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Student Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-course-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Student Course', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'student_registration_no',
            'course_code_title',
            'course_code_no',
            'enrollment_date',
            // 'gpa',
            // 'completion_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
