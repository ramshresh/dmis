<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\reporting\models\search\EmergencySituation */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emergency Situations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emergency-situation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Emergency Situation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'reportitem_id',
            'primary_event_id',
            'timestamp_declared',
            'declared_by',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
