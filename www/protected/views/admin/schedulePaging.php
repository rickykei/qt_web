<? $this->widget('SimplaPager', array('pages'=>$pages)); ?>

<div id="contentresult">
	<table id="checklist_table">
		<tr class="checklist_table_header" >
			<th width="80">Req id</th>
			<th width="250">Buyer Cd</th>
			<th width="180">Req Report Code</th>
			<th width="200">Assigned Auditor</th>
			<th width="150">Sch Start Date</th>
			<th width="150">Sch End Date</th>
			<th width="30">Sts</th>
			<th width="30">Edit</th>
			<th width="30">Void</th>
			<th width="30">Verify</th>
		</tr>

		<? foreach($items as $request) {?>
		<tr class="checklist_table_content">
			<td><?=$request->id ?></td>
			<td><?=CHtml::encode($request->buyer_info->buyer_cd) ?></td>
			<td><?=CHtml::encode($request->report_cd) ?></td>
			<td><?=CHtml::encode($request->auditor->name) ?></td>
			<td><?=Yii::app()->dateFormatter->format('yyyy-MM-dd', $request->sch_start_date) ?></td>
			<td><?=Yii::app()->dateFormatter->format('yyyy-MM-dd', $request->sch_end_date) ?></td>
			<td><?=CHtml::encode($request->sts) ?></td>
			
			
			<? if ($request->sts != RequestHeader::STS_COMPLETE && 
			$request->sts != RequestHeader::STS_VERIFY &&
				$request->sts != RequestHeader::STS_VOID && 
				$request->sts != RequestHeader::STS_DELETED) {?>
			<td>
				<input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/pencil_48.png'?>" alt="scheduleEdit?id=<?=$request->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" value="Edit" width="20" />
			</td>
			<td>
				<input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/cross_48.png'?>" value="Void" width="20" alt="scheduleVoid?id=<?=$request->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" />
			</td>
			<? } else { ?>
			<td></td>
			<td></td>
			<? }?>
			
			<? if ($request->sts == RequestHeader::STS_COMPLETE) {?>
			<td><input class="thickbox" type="image" src="<?= Yii::app()->baseUrl.'/images/accepted_48.png'?>" value="Void" width="20" alt="scheduleVerify?id=<?=$request->id ?>&KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" /></td>
			<? } else {?>
			<td></td>
			<? }?>
			
		</tr>
		<? }?>
	</table>
</div>
