<div class="box">
 <div class="table-responsive">
<table class="table table-striped multipleimpacts">
	<thead>
		<tr>

			<td>Quantity</td>
            <td>Units</td>
			<td><a onclick="javascript:$(this).addDamage($(this))">Add</a>
			</td>
		</tr>
	</thead>
	<tbody>
	<?php
	if(isset($model)){
		foreach ($model->damages as $id => $damage) {
			$this->render('_damageRow', array('id' => $id, 'model' => $damage, 'form' => $form, 'this' => $this));
		}
	}
	?>
	</tbody>
</table>
</div>
</div>