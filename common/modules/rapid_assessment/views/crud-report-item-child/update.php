<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemChild */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Report Item Child',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Item Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="report-item-child-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
