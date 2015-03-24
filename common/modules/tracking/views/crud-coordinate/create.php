<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\tracking\models\Coordinate */

$this->title = Yii::t('app', 'Create Coordinate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Coordinates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coordinate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
