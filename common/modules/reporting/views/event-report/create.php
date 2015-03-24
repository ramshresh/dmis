<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\ReportItem */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Event Report',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Event Report'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-report-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'reportItem' => $reportItem,
        'event'=>$event,
        'dropDownItemName'=>$dropDownItemName,

    ]) ?>

</div>
