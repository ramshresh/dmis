<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemRating */

$this->title = Yii::t('app', 'Create Report Item Rating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Item Ratings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-rating-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
