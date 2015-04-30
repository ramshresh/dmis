<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\social_media\models\Tweet */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tweets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tweet-view">

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
            'tweets:ntext',
            'geom',
            'status_json:ntext',
            'date',
            'hashtags',
            'tweet_location',
            'screen_name',
            'user_id',
            'date_utc',
            'verified:boolean',
            'user_address',
            'tweet_long',
            'tweet_lat',
            'user_long',
            'user_lat',
            'user_geom',
            'media_url:url',
        ],
    ]) ?>

</div>
