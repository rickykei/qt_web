
<? $this->widget('SimplaPager', array('pages'=>$pages, 'header'=>'')); ?>
<div id="contentresult">
	<table id="checklist_table">
		<tr class="checklist_table_header">
			<th width="80">id</th>
			<th width="150">Buyer Code</th>
			<th width="280">Check List Name</th>
			<th width="100">Establish Date</th>
			<th width="40">Version</th>
			<th width="100">Create By</th>
			<th width="30">View</th>
			<th width="30">Delete</th>
			<th width="50">Copy to</th> 
		</tr>
		
		<? foreach($items as $checkList) {?>
		<tr class="checklist_table_content">
			<td><?=$checkList->id?></td>
			<td><?=CHtml::encode($checkList->buyer_cd) ?></td>
			<td><?=CHtml::encode($checkList->check_list_name) ?></td>
			<td><?=Yii::app()->dateFormatter->format('yyyy-MM-dd', $checkList->establish_date) ?></td>
			<td><?=CHtml::encode($checkList->version) ?></td>
			<td><?=CHtml::encode($checkList->create_by) ?></td>
 			<td><input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/pencil_48.png'?>" alt="../checkList/checkListHeader?id=<?=$checkList->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" value="Edit" width="20" /></td>
			<td>
				<? if ($checkList->sts == CheckListTemplate::STS_ACTIVE) {?>
				<input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/cross_48.png'?>" value="Delete" width="20" alt="../checkList/checkListDelete?id=<?=$checkList->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" />
				<? }?>
			</td>
			<td><input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/copy.png'?>" value="Copy" width="20" alt="../checkList/checkListCopy?id=<?=$checkList->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" /></td>
		</tr>
		<? }?>
	</table>	
</div>
