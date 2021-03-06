<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemNeed */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Report Item Need',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Item Needs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="report-item-need-update">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
