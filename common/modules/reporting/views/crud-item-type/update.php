<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\ItemType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Item Type',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="item-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
