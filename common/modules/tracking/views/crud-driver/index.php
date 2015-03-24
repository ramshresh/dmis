<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\tracking\models\search\Driver */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Drivers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="driver-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Driver'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Firstname',
            'Lastname',
            'Address',
            'Phonr',
            'IMEI',
            // 'Gender',
            // 'Ambulance_Number',
            // 'id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
