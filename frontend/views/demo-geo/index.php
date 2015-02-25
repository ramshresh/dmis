<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/5/15
 * Time: 2:11 AM
 */

?>
<blockquote>Demo Geo Widgets</blockquote>
<ul>
<?php foreach($links as $link):?>
	<li><a href="<?= $link['url'] ?>"><?= $link['title'] ?></a></li>	
<?php endforeach;?>
</ul>
