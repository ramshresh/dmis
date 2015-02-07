<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/20/15
 * Time: 6:24 AM
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\testtabularinput\models\CourseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Course');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <!-- Render create form -->
    <?= $this->render('_pjax_form', [
        'model' => $model,
    ]) ?>

    <?php Pjax::begin(['id' => 'course']) ?>

    <?php if ($flash = Yii::$app->session->getFlash("course-save-error")): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                &times;
            </button>
            <p><?= $flash['message'] ?></p>
            <hr>
            <code><?= $flash['detail'] ?></code>
        </div>
    <?php elseif($flash = Yii::$app->session->getFlash("course-save-success")): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert"
                    aria-hidden="true">
                &times;
            </button>
            <p><?= $flash['message'] ?></p>
        </div>
    <?php endif;?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'code_title',
            'code_no',
            [
                'class' => 'yii\grid\ActionColumn',
                'controller'=>'admin-course',
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>

