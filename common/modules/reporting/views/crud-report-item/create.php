<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\ReportItem */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Report Item',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
