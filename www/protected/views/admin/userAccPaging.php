
<? $this->widget('SimplaPager', array('pages'=>$pages)); ?>
<div id="contentresult">
	<table id="checklist_table">
		<tr class="checklist_table_header">
			 
			<th width="100">User Name</th>
			<th width="100">Role</th>
			<th width="300">Company Name</th>
			<th width="300">Auditor</th>
			<th width="20">Status</th>
			<th width="30">Edit</th>
			<th width="30">Delete</th>
		</tr>
		
		<? foreach($items as $user) {?>
		<tr class="checklist_table_content">
			<td><?=CHtml::encode($user->username) ?></td>
			<td><?=$user->displayRole ?></td>
			<td><?=CHtml::encode($user->buyer_info->name) ?></td>
			<td><?=CHtml::encode($user->auditor->name) ?></td>
			<td><?=$user->displaySts ?></td>
			<td><input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/pencil_48.png'?>" alt="userAccEdit?id=<?=$user->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" value="Edit" width="20" /></td>
			<td><input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/cross_48.png'?>" value="Delete" width="20" alt="userAccDelete?id=<?=$user->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" /></td>
		</tr>
		<? } ?>
	</table>
</div>