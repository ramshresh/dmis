<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/1/15
 * Time: 12:48 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\ReportItem */
/* @var $form yii\widgets\ActiveForm */
$this->registerAssetBundle(\kartik\growl\GrowlAsset::className(),$this::POS_END);
?>



<?= \yii\helpers\Html::button(
    'Event Report ',
    [
        'id' => 'modalButton',
        'class'=>'btn-primary',
    ]) ?>


<div class="event-report-item-form">
    <?php $form = ActiveForm::begin([
            'id'=>'eventReportForm',
            //'action'=>\yii\helpers\Url::to(['/reporting/event-report/create-widget']),
        ]
    ); ?>
    <?php
    \yii\bootstrap\Modal::begin([
        'id' => "formEventReportModal",
        'header'=>"<h5>Create Event</h5>",
        //'footer'=>Html::submitButton($reportItem->isNewRecord || $event->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $reportItem->isNewRecord ? 'btn btn-success' : 'btn btn-primary']),
        'footer'=>null

    ]);
    ?>
    <div class="row">
        <div class="col-md-6">
            <?php
            // Parent

            echo $form->field($reportItem, 'item_name')
                ->widget(\kartik\widgets\Select2::classname(), [
                    'data' => array_merge(["" => ""], $dropDownItemName),
                    'options' => ['placeholder' => '--Select Event Type--'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
            <?php
            // Child # 1
            echo $form->field($reportItem, 'subtype_name')
                ->widget(\kartik\depdrop\DepDrop::classname(), [
                    'options' => ['id' => 'subtype_name'],
                    'pluginOptions' => [
                        'depends' => [Html::getInputId($reportItem,'item_name')],
                        'placeholder' => '--Select Event Sub-Type--',
                        'url' => \yii\helpers\Url::to(['/reporting/event-report/item-sub-type'])
                    ]
                ]);
            ?>
            <?= $form->field($event, 'timestamp_occurance')->widget(\kartik\widgets\DateTimePicker::className(),
                [
                    'options' => ['placeholder' => 'Enter event time ...'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'format' => 'yyyy-MM-dd h:i:s',
                        'autoclose' => true,
                    ]
                ]);
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($reportItem, 'description')->textarea(['rows' => 4]) ?>
            <?= $form->field($reportItem, 'tags')->widget(\kartik\widgets\Select2::className(),
                [
                    'options' => ['placeholder' => 'tags'],
                    'pluginOptions' => [
                        'tags' => ["earthquake", "event", "damage", "incident", "need",],
                        'maximumInputLength' => 10
                    ],
                ]);

            ?>
        </div>
        <?= Html::hiddenInput('parentReportItemId',$parentReportItemId)?>
    </div>

    <?= \common\modules\reporting\widgets\MultipleDamages::widget([
        'parentFormContext'=>$form,
        'parentControllerContext'=>$this,
    ])?>

    <div class="form-group">
        <?= Html::submitButton($reportItem->isNewRecord || $event->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $reportItem->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php
    \yii\bootstrap\Modal::end();
    ?>
    <?php ActiveForm::end(); ?>
</div>


<?php $js=<<<JS

// listen click, open modal and .load content
$('#modalButton').click(function (){
    $('#formEventReportModal').modal('show');
});

JS;
$this->registerJs($js,\yii\web\View::POS_READY);
?>


