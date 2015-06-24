<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\tbi\models\search\BuildingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Buildings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Building'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'surveyor:ntext',
            'surveyed_by:ntext',
            'survey_date',
            // 'owner_name:ntext',
            // 'owner_contact:ntext',
            // 'owner_comment:ntext',
            // 'building_name:ntext',
            // 'year_of_construction',
            // 'no_of_storey',
            // 'current_use:ntext',
            // 'special_features:ntext',
            // 'type:ntext',
            // 'type_other:ntext',
            // 'style:ntext',
            // 'style_other:ntext',
            // 'physical_condition:ntext',
            // 'physical_condition_comment:ntext',
            // 'street:ntext',
            // 'settlement:ntext',
            // 'ward_no',
            // 'v_code',
            // 'd_code',
            // 'z_code',
            // 'latitude',
            // 'longitude',
            // 'surveyed_at',
            // 'timestamp_created_at',
            // 'timestamp_updated_at',
            // 'geom',
            // 'wkt:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
