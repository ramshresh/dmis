<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\tracking\models\search\Status */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Statuses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Status'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'IMEI',
            'status',
            'id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
