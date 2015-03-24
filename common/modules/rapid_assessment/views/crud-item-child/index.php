<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\rapid_assessment\models\search\ItemChildSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Item Children');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-child-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Item Child'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'parent_name',
            'child_name',
            'parent_type',
            'child_type',
            // 'is_verified:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
