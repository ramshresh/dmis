<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\ItemSymbolIcon */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Item Symbol Icon',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Symbol Icons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-symbol-icon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
