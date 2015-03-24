<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\tracking\models\search\Location */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Locations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Location'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'device_id',
            'latitude',
            'longitude',
            'speed',
            'id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
