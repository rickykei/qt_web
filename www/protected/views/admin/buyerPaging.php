
<? $this->widget('SimplaPager', array('pages'=>$pages)); ?>
<div id="contentresult">
	<table id="checklist_table">
		<tr class="checklist_table_header">
			 
			<th width="250">Buyer Name</th>
			<th width="100">Buyer Code</th>
			<th width="150">Buyer Type</th>
			<th width="200">Industry</th>
			<th width="200">Area</th>
			<th width="30">Edit</th>
			<th width="30">Delete</th>
			 
		</tr>
		
		<? foreach($items as $buyer) {?>
		<tr class="checklist_table_content">
			<td><?=CHtml::encode($buyer->name) ?></td>
			<td><?=CHtml::encode($buyer->buyer_cd) ?></td>
			<td><?=CHtml::encode($buyer->option12->value) ?></td>
			<td><?=CHtml::encode($buyer->option6->value) ?></td>
			<td><?=CHtml::encode($buyer->option3->value) ?></td>
			<td><input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/pencil_48.png'?>" alt="buyerEdit?id=<?=$buyer->id ?>&KeepThis=true&TB_iframe=true&height=400&width=550&modal=true" value="Edit" width="20" /></td>
			<td><input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/cross_48.png'?>" value="Delete" width="20" alt="buyerDelete?id=<?=$buyer->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" /></td>
		</tr>
		<? } ?>
	</table>
</div>
