<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemChild */

$this->title = Yii::t('app', 'Create Report Item Child');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Item Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-child-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
