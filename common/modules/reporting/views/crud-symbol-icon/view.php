<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\SymbolIcon */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Symbol Icons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="symbol-icon-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'name',
            'format',
            'extension',
            'path:ntext',
            'url:ntext',
            'size',
            'resolution_x',
            'resolution_y',
            'source:ntext',
            'description:ntext',
            'is_verified:boolean',
            'tags',
            'meta_hstore',
            'meta_json',
        ],
    ]) ?>

</div>
