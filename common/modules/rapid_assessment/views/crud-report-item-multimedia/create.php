<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemMultimedia */

$this->title = Yii::t('app', 'Create Report Item Multimedia');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Item Multimedia'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-multimedia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
