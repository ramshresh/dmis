<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\tbi\models\Building */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buildings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-view">

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
            'user_id',
            'surveyor:ntext',
            'surveyed_by:ntext',
            'survey_date',
            'owner_name:ntext',
            'owner_contact:ntext',
            'owner_comment:ntext',
            'building_name:ntext',
            'year_of_construction',
            'no_of_storey',
            'current_use:ntext',
            'special_features:ntext',
            'type:ntext',
            'type_other:ntext',
            'style:ntext',
            'style_other:ntext',
            'physical_condition:ntext',
            'physical_condition_comment:ntext',
            'street:ntext',
            'settlement:ntext',
            'ward_no',
            'v_code',
            'd_code',
            'z_code',
            'latitude',
            'longitude',
            'surveyed_at',
            'timestamp_created_at',
            'timestamp_updated_at',
            'geom',
            'wkt:ntext',
        ],
    ]) ?>

</div>
