<?php

use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel common\modules\building_assessment\models\search\BuildingHouseholdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Building Households');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-household-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Building Household'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $gridColumns=[
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'owner_name',
        'owner_contact',
        'occupancy_type:ntext',
        'current_condition',
         'income_source:ntext',
         'income_level',
         'construction_type:ntext',
         'current_income_status',
         'damage_type',
         'user_id',
         'no_of_occupants',
         'event_name',
         'timestamp_created_at',
         'timestamp_updated_at',
         'timestamp_occurance',
         'longitude',
         'latitude',
         'geom',
         'wkt:ntext',
         'address',
         'c_code',
         'z_code',
         'd_code',
         'v_code',
         'ward_no',
         'impact_death',
         'impact_injured',
         'impact_missing',
         'impact_displaced',
         'impact_orphaned',
        // 'tags',
    ];
    ?>
    <?php

    // Renders a export dropdown menu
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'emptyText'=>'Empty Result',
        'target'=>ExportMenu::TARGET_SELF,
    ]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'owner_name',
            'owner_contact',
            'occupancy_type:ntext',
            'current_condition',
            // 'income_source:ntext',
            // 'income_level',
            // 'construction_type:ntext',
            // 'current_income_status',
            // 'damage_type',
            // 'user_id',
            // 'no_of_occupants',
            // 'event_name',
            // 'timestamp_created_at',
            // 'timestamp_updated_at',
            // 'timestamp_occurance',
            // 'longitude',
            // 'latitude',
            // 'geom',
            // 'wkt:ntext',
            // 'address',
            // 'c_code',
            // 'z_code',
            // 'd_code',
            // 'v_code',
            // 'ward_no',
            // 'impact_death',
            // 'impact_injured',
            // 'impact_missing',
            // 'impact_displaced',
            // 'impact_orphaned',
            // 'tags',

            ['class' => 'yii\grid\ActionColumn'],
        ]
    ]); ?>

</div>
