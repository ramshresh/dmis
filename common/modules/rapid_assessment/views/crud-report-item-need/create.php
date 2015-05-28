<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemNeed */

$this->title = Yii::t('app', 'Create Report Item Need');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Item Needs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-need-create">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
