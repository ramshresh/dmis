<?php

use common\modules\user\models\Profile;
use kartik\export\ExportMenu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\heritage_assessment\models\search\HeritageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Heritages');
$this->params['breadcrumbs'][] = $this->title;

$userProfile = new Profile();
?>
<div class="heritage-index">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Heritage'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $gridColumns=[
        ['class' => 'yii\grid\SerialColumn'],
        'kitta_no:ntext',
        'damage_type:ntext',
        'present_physical_conditions:ntext',
        'historical_socio_cultural_significance:ntext',
        'important_features:ntext',
        'items_to_be_preserved_before:ntext',
        'items_to_be_preserved_after:ntext',
        'description:ntext',
        'recorded_by:ntext',
        'surveyor_opinion_before:ntext',
        'surveyor_opinion_after:ntext',
        'old_date',
        'new_date',
        'timestamp_created_at',
        'timestamp_updated_at',
        'latitude',
        'longitude',
        'geom',
        'wkt:ntext',
        'd_code',
        'v_code',
        'ward_no',
        //'user_id',
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
            'kitta_no:ntext',
            'damage_type:ntext',
            //'present_physical_conditions:ntext',
            //'historical_socio_cultural_significance:ntext',
            // 'important_features:ntext',
            // 'items_to_be_preserved_before:ntext',
            'items_to_be_preserved_after:ntext',
            // 'description:ntext',
            // 'recorded_by:ntext',
            // 'surveyor_opinion_before:ntext',
            'surveyor_opinion_after:ntext',
            // 'old_date',
            // 'new_date',
            // 'timestamp_created_at',
            // 'timestamp_updated_at',
            // 'latitude',
            // 'longitude',
            // 'geom',
            // 'wkt:ntext',
            // 'd_code',
            // 'v_code',
            // 'ward_no',
            //'user_id',
            //[
            //    'attribute' => 'userEmail',
            //    'value' => 'user.email'
            //],
            [
                'attribute' => 'userProfileFullName',
                'value' => 'userProfile.full_name',
                //'filter' => Profile::dropdown('full_name','full_name'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
