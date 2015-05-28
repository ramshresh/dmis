<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemImpact */

$this->title = Yii::t('app', 'Create Report Item Impact');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Item Impacts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-impact-create">

<!--    <h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
