<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\rapid_assessment\models\ItemClass */

$this->title = Yii::t('app', 'Create Item Class');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-class-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
