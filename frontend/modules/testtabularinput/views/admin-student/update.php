<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\testtabularinput\models\Student */

$this->title = 'Update Student: ' . ' ' . $model->registration_no;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->registration_no, 'url' => ['view', 'id' => $model->registration_no]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
