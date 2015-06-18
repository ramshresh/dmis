<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\social_media\models\search\TwitterStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Twitter Statuses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="twitter-status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Twitter Status'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'location:ntext',
            'latitude',
            'longitude',
            // 'in_reply_to:ntext',
            // 'status:ntext',
            // 'in_reply_to_status_id:ntext',
            // 'possibly_sensitive:boolean',
            // 'lat',
            // 'long',
            // 'place_id:ntext',
            // 'display_coordinates:boolean',
            // 'media_ids',
            // 'is_verified:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
