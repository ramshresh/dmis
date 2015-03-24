<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\rapid_assessment\models\search\ItemClassSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Item Classes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-class-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Item Class'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'item_name',
            'basis',
            'name',
            'display_name',
            // 'range',
            // 'range_units',
            // 'standard',
            // 'description',
            // 'is_verified:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
