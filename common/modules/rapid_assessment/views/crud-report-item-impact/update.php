<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemImpact */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Report Item Impact',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Item Impacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="report-item-impact-update">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
