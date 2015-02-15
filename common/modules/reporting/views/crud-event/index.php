<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\reporting\models\search\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Events');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
            'modelClass' => 'Event',
        ]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'reportitem_id',
            ['attribute' => 'item_name', 'value' => 'reportitem.item_name'],
            //['attribute'=>'type','value'=>'reportitem.type'],
            ['attribute' => 'subtype_name', 'value' => 'reportitem.subtype_name'],
            ['attribute' => 'is_verified', 'value' => 'reportitem.is_verified', 'format' => 'boolean',],
            ['attribute' => 'timestamp_created', 'value' => 'reportitem.timestamp_created'],
            ['attribute' => 'timestamp_updated', 'value' => 'reportitem.timestamp_updated'],
            'timestamp_occurance',
            //'duration',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
