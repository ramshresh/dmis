<?php
/* @var $id int */
/* @var $model Impact */
/* @var $this ApplicationController */
/* @var $form yii\widgets\ActiveForm */
?>
<tr>

    <?= $form->field($model,"id",['template' => "{input}\n{error}"])->hiddenInput() ?>
<td>
    <?php
        echo $form->field($model,"quantity",['template' => "{input}\n{error}"])->textInput();
    ?>
    </td>
    <td>
        <?php echo $form->field($model,"units_shortname",['template' => "{input}\n{error}"])->textInput();?>
    </td>

    <td>
        <a onclick="javascript:$(this).deleteDamage($(this));return false;">Delete</a>
    </td>
</tr>


