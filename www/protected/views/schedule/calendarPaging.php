<? $this->widget('SimplaPager', array('pages'=>$pages)); ?>

<div id="contentresult">
	<table id="checklist_table">
		<tr class="checklist_table_header">
			<th width="80">Req id</th>
			<th width="280">Template Name</th>
			<th width="200">Supplier Name</th>
			<th width="150">Sch Start Date</th>
			<th width="150">Sch End Date</th>
			<th width="30">Edit</th>
			<th width="30">Delete</th>
		</tr>

		<? foreach($items as $request) {?>
		<tr class="checklist_table_content">
			<td><?=$request->id ?></td>
			<td><?=CHtml::encode($request->check_list_template->check_list_name) ?></td>
			<td><?=CHtml::encode($request->supplier->name) ?></td>
			<td><?=Yii::app()->dateFormatter->format('yyyy-MM-dd', $request->sch_start_date) ?></td>
			<td><?=Yii::app()->dateFormatter->format('yyyy-MM-dd', $request->sch_end_date) ?></td>
			
			<td><input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/pencil_48.png'?>" alt="calendarEdit?id=<?=$request->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" value="Edit" width="20" /></td>
			<td><input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/cross_48.png'?>" value="Delete" width="20" alt="calendarDelete?id=<?=$request->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" /></td>
		</tr>
		<? }?>
	</table>
</div>
