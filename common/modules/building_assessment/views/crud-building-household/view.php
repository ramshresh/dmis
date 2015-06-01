<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\building_assessment\models\BuildingHousehold */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Building Households'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-household-view">

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
            'tags',
        ],
    ]) ?>

</div>
