<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/22/2015
 * Time: 10:08 AM
 *
 * @var $actions Array
 */
use yii\helpers\Url;

?>
<?php foreach($actions as $name=>$link):?>
    <li><a href="<?=Url::to([$link])?>"><?=$name?></a></li>
<?php endforeach; ?>
