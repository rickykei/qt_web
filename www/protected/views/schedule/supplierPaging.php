
<? $this->widget('SimplaPager', array('pages'=>$pages)); ?>
<style type="text/css">
</style>

<div id="contentresult">
	<table id="checklist_table">
		<tr class="checklist_table_header">
			 
			<th width="280"><span class="style3">Supplier Name</span></th>
			<th width="130"><span class="style3">Supplier Code</span></th>
			<th width="100"><span class="style3">Supplier Type</span></th>
			<th width="150"><span class="style3">Industry</span></th>
			<th width="150"><span class="style3">Area</span></th>
			<th width="30"><span class="style3">Edit</span></th>
			<th width="30"><span class="style3">Delete</span></th>
		</tr>
		
		<? foreach($items as $supplier) {?>
		<tr class="checklist_table_content">
			<td><span class="style3">
		    <?=CHtml::encode($supplier->name) ?>
			</span></td>
			<td><span class="style3">
		    <?=CHtml::encode($supplier->code) ?>
			</span></td>
			<td><span class="style3">
		    <?=CHtml::encode($supplier->option12->value) ?>
			</span></td>
			<td><span class="style3">
		    <?=CHtml::encode($supplier->option6->value) ?>
			</span></td>
			<td><span class="style3">
		    <?=CHtml::encode($supplier->option3->value) ?>
			</span></td>
			<td><input type="image" class="thickbox " value="Edit" src="<?= Yii::app()->baseUrl.'/images/pencil_48.png'?>" alt="supplierEdit?id=<?=$supplier->id ?>&KeepThis=true&TB_iframe=true&height=400&width=600&modal=true" width="20" /></td>
			<td><input type="image" class="thickbox " value="Delete" src="<?= Yii::app()->baseUrl.'/images/cross_48.png'?>" alt="supplierDelete?id=<?=$supplier->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" width="20" /></td>
		</tr>
		<? } ?>
	</table>
</div>
