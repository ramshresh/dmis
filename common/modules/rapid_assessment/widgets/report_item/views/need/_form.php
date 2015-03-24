<?php


use kartik\widgets\ActiveForm;
use yii\helpers\Html;

//use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\Event */
/* @var $form yii\widgets\ActiveForm */
//$dropDownItemName = $model::getDropDownItemName();
?>
    <div id="<?=$widgetId?>" class="hidden" title="Add new Need">
        <?php $form = ActiveForm::begin([
                'id' => $formId,
                'action' => $actionRoute]
        ); ?>

        <?php // echo $form->field($model, 'reportitem_id')->textInput() ?>

        <?php
        // Parent
       /* echo $form->field($model, 'item_name')
            ->widget(\kartik\widgets\Select2::classname(), [
                'data' => $dropDownItemName,
                'options' => ['placeholder' => '--Select Impact Type--'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);*/
        ?>

        <?php
        // Child # 1
       /* echo $form->field($model, 'subtype_name')
            ->widget(\kartik\depdrop\DepDrop::classname(), [
                'options' => ['id' => Html::getInputId($model,'subtype_name')],
                'pluginOptions' => [
                    'depends' => [Html::getInputId($model, 'item_name')],
                    'placeholder' => '--Select Impact Sub-Type--',
                    'url' => \yii\helpers\Url::to(['/reporting/event-report/item-sub-type'])
                ]
            ]);*/
        ?>

        <?= $form->field($model, 'type')->textInput() ?>

        <?= $form->field($model, 'item_name')->textInput(['maxlength' => 255]) ?>

        <?= $form->field($model, 'wkt')->textarea(['rows' => 6]) ?>

        <?php echo common\modules\rapid_assessment\widgets\tabular_input\report_item_multimedia\_Create::widget([
            'form'=>$form,
            'allModels' => $model->reportItemMultimedia,
            'modelClass' => \common\modules\rapid_assessment\models\ReportItemMultimedia::className(),
        ]);?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
