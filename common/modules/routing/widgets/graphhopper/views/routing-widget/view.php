<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/3/2015
 * Time: 1:29 PM
 */
use yii\helpers\Json;

/**
 * @var $this yii\web\View
 * @var $containerId String
 * @var $clientOptions Array
 */
$options = Json::encode($clientOptions);
?>
<div id="<?= $containerId ?>" style="position:relative;">
    <div class="response" style="display: none"></div>
    <div class="instructions" style="display: none"></div>
    <script>
        <?php $posReady = $this->beginBlock('POS_READY'); ?>

        <?php $this->endBlock();?>
    </script>
    <?php $this->registerJs($this->blocks['POS_READY'], $this::POS_READY) ?>
</div>
<?php $this->registerJs("$('#{$containerId}').routing({$options});", \yii\web\View::POS_READY); ?>
