<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\file_management\models\search\TempUploadedFileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Temp Uploaded Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temp-uploaded-file-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Temp Uploaded File'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'base_name:ntext',
            'error',
            'extension:ntext',
            'has_error:boolean',
            // 'name:ntext',
            // 'size',
            // 'temp_name:ntext',
            // 'type:ntext',
            // 'data',
            // 'file:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
