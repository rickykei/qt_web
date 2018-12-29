
<div id="contentresult">
	<table id="checklist_table">
		<tr class="checklist_table_header">
			<th width="10"><input type="checkbox" id="selectALl" onclick="trigger()"/></th>
			<th width="350">Supplier Name</th>
			<th width="200">Type of Enterprise</th>
			<th width="200">Industry</th>
			<th width="150">Area</th>
			 
		</tr>
		
		<? foreach($items as $supplier) {?>
		<tr class="checklist_table_content">
			<td><input type="checkbox" name="suppId[]" value="<?=$supplier->id ?>"></td>
			<td><?=CHtml::encode($supplier->name) ?></td>
			<td><?=CHtml::encode($supplier->option12->value) ?></td>
			<td><?=CHtml::encode($supplier->option6->value) ?></td>
			<td><?=CHtml::encode($supplier->option3->value) ?></td>
		</tr>
		<? } ?>
	</table>
</div>

<script type="text/javascript">

$(function() {
	$('input:checkbox[name="suppId[]"]').click(function() {
		if ($('input:checkbox[name="suppId[]"]:not(:checked)').length > 0) {
			$('#selectALl').attr('checked', false);
		}
		else {
			$('#selectALl').attr('checked', true);
		}
	});
});

function trigger() {
	if ($('#selectALl').attr('checked')) {
		$('input:checkbox[name="suppId[]"]').attr('checked', true);
	}
	else {
		$('input:checkbox[name="suppId[]"]').attr('checked', false);
	}
}

</script>