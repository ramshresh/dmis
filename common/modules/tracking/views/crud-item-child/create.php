<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\reporting\models\ItemChild */

$this->title = Yii::t('app', 'Create Item Child');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Item Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-child-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
