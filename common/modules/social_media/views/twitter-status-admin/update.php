<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\social_media\models\TwitterStatus */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Twitter Status',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Twitter Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="twitter-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
