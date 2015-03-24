<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\rapid_assessment\models\search\ReportItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Report Items');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Report Item'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'item_name',
            'class_basis',
            'class_name',
            // 'title',
            // 'description:ntext',
            // 'is_verified:boolean',
            // 'status',
            // 'timestamp_occurance',
            // 'timestamp_created_at',
            // 'timestamp_updatedat_at',
            // 'tags',
            // 'meta_hstore',
            // 'meta_json',
            // 'declared_by',
            // 'timestamp_declared_at',
            // 'magnitude',
            // 'units',
            // 'wkt:ntext',
            // 'geom',
            // 'latitude',
            // 'longitude',
            // 'address',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
