<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\ItemSubType */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Item Sub Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Sub Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-sub-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
