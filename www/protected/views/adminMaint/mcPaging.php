
<? $this->widget('SimplaPager', array('pages'=>$pages)); ?>
<div id="contentresult">
	<table id="checklist_table">
		<tr class="checklist_table_header">
			 
			<th width="350">Question</th>
			<th width="20">Risk</th>
			<th width="20">Photo</th>
			<th width="100">Law</th>
			<th width="30">Category</th>
			<th width="30">Sub Category</th>
			<th width="30">Edit</th>
			<th width="30">Delete</th>
		</tr>
		
		<? foreach($items as $mc) {?>
		<tr class="checklist_table_content">
			<td><?=CHtml::encode($mc->question) ?></td>
			<td><?=$mc->riskCode ?></td>
			<td><?=$mc->photoCode ?></td>
			<td><?=CHtml::encode($mc->law) ?></td>
			<td><?=CHtml::encode($mc->cat->name) ?></td>
			<td><?=CHtml::encode($mc->subcat->name) ?></td>
			<td><input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/pencil_48.png'?>" alt="mcEdit?id=<?=$mc->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" value="Edit" width="20" /></td>
			<td><input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/cross_48.png'?>" value="Delete" width="20" alt="mcDelete?id=<?=$mc->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" /></td>
		</tr>
		<? } ?>
	</table>
</div>