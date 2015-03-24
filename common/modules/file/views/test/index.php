<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/16/15
 * Time: 4:13 AM
 */


/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Index');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'test'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<blockquote>Demo File Uploads</blockquote>
<ul>
    <?php foreach($links as $link):?>
        <li><a href="<?= $link['url'] ?>"><?= $link['title'] ?></a></li>
    <?php endforeach;?>
</ul>