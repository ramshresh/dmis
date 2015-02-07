<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/20/15
 * Time: 6:53 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model frontend\modules\testtabularinput\models\Course */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$newCourseFormPjaxJs=<<<JS
(function($){
$("#new_course").on("pjax:end", function() {
        $.pjax.reload({container:"#course"});  //Reload GridView
});
})(jQuery);
JS;
$this->registerJs($newCourseFormPjaxJs,$this::POS_READY);
?>
<div class="course-form">
    <?php yii\widgets\Pjax::begin(['id' => 'new_course']) ?>
    <?php $form = ActiveForm::begin([
        'options' => ['data-pjax' => true ]
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 75]) ?>

    <?= $form->field($model, 'code_title')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'code_no')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php yii\widgets\Pjax::end() ?>
</div>
