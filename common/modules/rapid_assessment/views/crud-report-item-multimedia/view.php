<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ReportItemMultimedia */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Report Item Multimedia'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-multimedia-view">

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
            'report_item_id',
            'type',
            'title',
            'extension',
            'thumbnail_url:ntext',
            'description',
            'latitude',
            'longitude',
            'url:ntext',
            'path:ntext',
            'timestamp_taken_at',
            'caption',
            'resolution_x',
            'resolution_y',
            'size_bytes',
            'is_verified:boolean',
            'tags',
            'meta_hstore',
            'meta_json',
        ],
    ]) ?>

</div>
