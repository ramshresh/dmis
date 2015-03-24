<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/10/2015
 * Time: 1:37 PM
 */


?>
<blockquote>Links to actions</blockquote>
<ul>
    <?php foreach($links as $link):?>
        <li><a href="<?= $link['url'] ?>"><?= $link['name'] ?></a></li>
    <?php endforeach;?>
</ul>