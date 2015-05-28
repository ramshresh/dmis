<?php

use kartik\builder\TabularForm;
use kartik\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\rapid_assessment\models\search\ReportItemIncidentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Report Item Incidents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-item-incident-index">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Report Item Incident'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type',
            'item_name',
            'class_basis',
            'class_name',
            // 'title',
            // 'description:ntext',
            // 'is_verified:boolean',
            // 'status',
            // 'timestamp_occurance',
            // 'timestamp_created_at',
            // 'timestamp_updated_at',
            // 'tags',
            // 'meta_hstore',
            // 'meta_json',
            // 'declared_by',
            // 'timestamp_declared_at',
            // 'magnitude',
            // 'units',
            // 'wkt:ntext',
            // 'geom',
            // 'latitude',
            // 'longitude',
            // 'address',
            // 'user_id',
            // 'owner_name',
            // 'owner_contact',
            // 'supplied_per_person',
            // 'event',
            // 'event_name',

            // 'income_source',
            // 'income_level',
            // 'no_of_occupants',
            // 'current_condition:ntext',
            // 'construction_type:ntext',
            // 'occupancy_type:ntext',
            // 'current_income_status:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php $form = ActiveForm::begin()?>
    <?php
    echo TabularForm::widget([
        'form' => $form,
        'dataProvider' => $dataProvider,//new ActiveDataProvider(['query' => $model]),
        'attributes' => [
            'item_name' => ['type' => TabularForm::INPUT_TEXT],
            'magnitude' => [
                'label'=>'Count',
                'type' => TabularForm::INPUT_TEXT
            ],

        ],
        'gridSettings' => [
            'floatHeader' => true,
            'panel' => [
                //'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-ok-circle"></i> Reports</h3>',
                'type' => \kartik\grid\GridView::TYPE_PRIMARY,
                'after'=>'<div class="pull-right">'.
                    Html::a(
                        '<i class="glyphicon glyphicon-plus"></i>',
                        Url::to(['/rapid_assessment/crud-report-item-incident/create']),
                        ['class'=>'btn btn-success']
                    ) . '&nbsp;' .
                    Html::a(
                        '<i class="glyphicon glyphicon-remove"></i>',
                        '$deleteUrl',
                        ['class'=>'btn btn-danger']
                    ).'</div>'
            ]
        ]
    ]);
    ?>
    <?php $form->end();?>

</div>
