<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\reporting\models\search\SymbolIconSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Symbol Icons');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="symbol-icon-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Symbol Icon',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'name',
            'format',
            'extension',
            // 'path:ntext',
            // 'url:ntext',
            // 'size',
            // 'resolution_x',
            // 'resolution_y',
            // 'source:ntext',
            // 'description:ntext',
            // 'is_verified:boolean',
            // 'tags',
            // 'meta_hstore',
            // 'meta_json',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
