<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\heritage_assessment\models\Heritage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Heritages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="heritage-view">

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
            'user_id',
        ],
    ]) ?>

</div>
