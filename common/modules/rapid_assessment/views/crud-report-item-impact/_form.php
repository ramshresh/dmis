<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemImpact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-item-impact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'event_name')->textInput(['maxlength' => 255]) ?>

    <?php /*echo $form->field($model, 'type')->textInput(['maxlength' => 255]) */?>

    <?php echo $form->field($model, 'item_name')->textInput(['maxlength' => 255]) ?>

    <?php /*echo $form->field($model, 'class_basis')->textInput(['maxlength' => 255]) */?>

    <?php echo $form->field($model, 'class_name')->textInput(['maxlength' => 255]) ?>

    <?php /*echo $form->field($model, 'title')->textInput(['maxlength' => 255]) */?>

    <?php /*echo $form->field($model, 'description')->textarea(['rows' => 6]) */?>

    <?php /*echo $form->field($model, 'is_verified')->checkbox() */?>

    <?php /*echo $form->field($model, 'status')->textInput(['maxlength' => 255]) */?>

    <?php /*echo $form->field($model, 'timestamp_occurance')->textInput() */?>

    <?php /*echo $form->field($model, 'timestamp_created_at')->textInput() */?>

    <?php /*echo $form->field($model, 'timestamp_updated_at')->textInput() */?>

    <?php /*echo $form->field($model, 'tags')->textInput() */?>

    <?php /*echo $form->field($model, 'meta_hstore')->textInput() */?>

    <?php /*echo $form->field($model, 'meta_json')->textInput() */?>

    <?php /*echo $form->field($model, 'declared_by')->textInput(['maxlength' => 255]) */?>

    <?php /*echo $form->field($model, 'timestamp_declared_at')->textInput() */?>

    <?php echo $form->field($model, 'magnitude')->textInput()->label('Count') ?>

    <?php echo $form->field($model, 'units')->textInput(['maxlength' => 255]) ?>

    <?php /*echo $form->field($model, 'wkt')->textarea(['rows' => 6]) */?>

    <?php /*echo $form->field($model, 'geom')->textInput() */?>

    <?php /*echo $form->field($model, 'latitude')->textInput() */?>

    <?php /*echo $form->field($model, 'longitude')->textInput() */?>

    <?php /*echo $form->field($model, 'address')->textInput(['maxlength' => 255]) */?>

    <?php /*echo $form->field($model, 'user_id')->textInput() */?>

    <?php /*echo $form->field($model, 'owner_name')->textInput(['maxlength' => 100]) */?>

    <?php /*echo $form->field($model, 'owner_contact')->textInput(['maxlength' => 100]) */?>

    <?php /*echo $form->field($model, 'supplied_per_person')->textInput() */?>

    <?php /*echo $form->field($model, 'event')->textInput(['maxlength' => 100]) */?>





    <?php /*echo $form->field($model, 'income_source')->textInput(['maxlength' => 100]) */?>

    <?php /*echo $form->field($model, 'income_level')->textInput(['maxlength' => 100]) */?>

    <?php /*echo $form->field($model, 'no_of_occupants')->textInput() */?>

    <?php /*echo $form->field($model, 'current_condition')->textarea(['rows' => 6]) */?>

    <?php /*echo $form->field($model, 'construction_type')->textarea(['rows' => 6]) */?>

    <?php /*echo $form->field($model, 'occupancy_type')->textarea(['rows' => 6]) */?>

    <?php /*echo $form->field($model, 'current_income_status')->textarea(['rows' => 6]) */?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
