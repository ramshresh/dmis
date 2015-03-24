<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\tracking\models\Coordinate */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Coordinate',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Coordinates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="coordinate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
