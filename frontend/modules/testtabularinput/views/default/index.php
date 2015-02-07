<?php
use yii\helpers\Url;
?>

<div class="test-tabular-input-default-index">
    <h5><?= $this->context->action->uniqueId ?></h5>
    <ul>
        <li><a href="<?= Url::to(['/test-tabular-input/admin-all/widgets-pjax'])?>">GridView and Active record with Pjax</a></li>
        <li><a href="<?= Url::to(['/test-tabular-input/admin-all/test-save-related'])?>">Tutorial on Saving related models</a></li>
    </ul>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
