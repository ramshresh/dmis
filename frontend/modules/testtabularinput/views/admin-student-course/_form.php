<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\testtabularinput\models\StudentCourse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-course-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'student_registration_no')->textInput(['maxlength' => 7]) ?>

    <?= $form->field($model, 'course_code_title')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'course_code_no')->textInput() ?>

    <?= $form->field($model, 'enrollment_date')->textInput() ?>

    <?= $form->field($model, 'gpa')->textInput() ?>

    <?= $form->field($model, 'completion_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
