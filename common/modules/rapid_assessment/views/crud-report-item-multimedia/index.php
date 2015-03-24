<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\rapid_assessment\models\search\ReportItemMultimediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Report Item Multimedia');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-multimedia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Report Item Multimedia'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'report_item_id',
            'type',
            'title',
            'extension',
            // 'thumbnail_url:ntext',
            // 'description',
            // 'latitude',
            // 'longitude',
            // 'url:ntext',
            // 'path:ntext',
            // 'timestamp_taken_at',
            // 'caption',
            // 'resolution_x',
            // 'resolution_y',
            // 'size_bytes',
            // 'is_verified:boolean',
            // 'tags',
            // 'meta_hstore',
            // 'meta_json',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
