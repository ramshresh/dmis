<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/16/15
 * Time: 3:55 AM
 */
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'file')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>