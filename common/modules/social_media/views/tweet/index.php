<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\social_media\models\search\TweetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tweets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tweet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tweet'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'tweets:ntext',
            //'geom',
            //'status_json:ntext',
            'date',
             'hashtags',
            // 'tweet_location',
             'screen_name',
            // 'user_id',
            // 'date_utc',
             'verified:boolean',
            // 'user_address',
            // 'tweet_long',
            // 'tweet_lat',
            // 'user_long',
            // 'user_lat',
            // 'user_geom',
            // 'media_url:url',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
