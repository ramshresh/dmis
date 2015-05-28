<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\rapid_assessment\models\search\ReportItemImpactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Report Item Impacts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-impact-index">

<!--    <h1><?/*= Html::encode($this->title) */?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Report Item Impact'), ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'timestamp_updated_at',
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
            // 'owner_name',
            // 'owner_contact',
            // 'supplied_per_person',
            // 'event',
            // 'event_name',

            // 'income_source',
            // 'income_level',
            // 'no_of_occupants',
            // 'current_condition:ntext',
            // 'construction_type:ntext',
            // 'occupancy_type:ntext',
            // 'current_income_status:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
