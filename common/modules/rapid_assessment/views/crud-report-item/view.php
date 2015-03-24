<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItem */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-view">

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
            'item_name',
            'class_basis',
            'class_name',
            'title',
            'description:ntext',
            'is_verified:boolean',
            'status',
            'timestamp_occurance',
            'timestamp_created_at',
            'timestamp_updated_at',
            'tags',
            'meta_hstore',
            'meta_json',
            'declared_by',
            'timestamp_declared_at',
            'magnitude',
            'units',
            'wkt:ntext',
            'geom',
            'latitude',
            'longitude',
            'address',
            'user_id',
        ],
    ]) ?>

</div>
