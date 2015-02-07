<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/21/15
 * Time: 7:24 AM
 */
/**
 * @var $this    \yii\base\View
 * @var $person  \frontend\modules\testtabularinput\models\Person
 * @var $student \frontend\modules\testtabularinput\models\Student
 * @var $personSearchModel frontend\modules\testtabularinput\models\PersonSearch
 * @var $studentSearchModel frontend\modules\testtabularinput\models\StudentSearch
 * @var $personDataProvider yii\data\ActiveDataProvider
 * @var $studentDataProvider yii\data\ActiveDataProvider
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
?>

<div class="student-registration-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--    Person  Form-->
    <?= $form->field($person, 'date_of_birth')->textInput() ?>

    <?= $form->field($person, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($person, 'gender')->textInput() ?>

    <?= $form->field($person, 'citizenship_no')->textInput(['maxlength' => 7]) ?>

    <?= $form->field($person, 'nationality')->textInput(['maxlength' => 75]) ?>

    <?= $form->field($person, 'full_name')->textInput(['maxlength' => 75]) ?>

    <!--    Student Form -->

    <?= $form->field($student, 'registration_no')->textInput(['maxlength' => 7]) ?>

    <div class="form-group">
        <?= Html::submitButton('Register', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?= GridView::widget([
    'dataProvider' => $personDataProvider,
    'filterModel' => $personSearchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'date_of_birth',

        [
            'class' => 'yii\grid\ActionColumn',
            'controller'=>'admin-person',
        ],
    ],
]); ?>
