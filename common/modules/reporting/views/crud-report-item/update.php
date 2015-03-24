<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\ReportItem */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Report Item',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="report-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
