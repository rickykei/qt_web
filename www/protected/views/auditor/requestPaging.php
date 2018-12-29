<? $this->widget('SimplaPager', array('pages'=>$pages)); ?>

<div id="contentresult">
	<table id="checklist_table">
		<tr class="checklist_table_header">
			<th width="50">Req id</th>
			<th width="100">Buyer Cd</th>
			<th width="150">Supplier Name</th>
			<th width="130">Supplier Area</th>
			<th width="150">Check List Name</th>
			<th width="100">Sch Start Date</th>
			<th width="80">Sch End Date</th>
			<th width="30">Sts</th>
			<th width="30">Filling</th>
			<th width="30">DOC</th>
		</tr>

		<? foreach($items as $request) {?>
		<tr class="checklist_table_content">
			<td><?=$request->id ?></td>
			<td><?=CHtml::encode($request->buyer_info->buyer_cd) ?></td>
			<td><?=CHtml::encode($request->supplier->name) ?></td>
			<td><?=CHtml::encode($request->supplier->option3->value) ?></td>
			<td><?=CHtml::encode($request->check_list_template->check_list_name) ?></td>
			<td><?=$request->sch_start_date == NULL ? '' : Yii::app()->dateFormatter->format('yyyy-MM-dd', $request->sch_start_date) ?></td>
			<td><?=$request->sch_end_date == NULL ? '' : Yii::app()->dateFormatter->format('yyyy-MM-dd', $request->sch_end_date) ?></td>
			<td><?=CHtml::encode($request->sts) ?></td>
			
			<td>
				<? if ($request->sts == RequestHeader::STS_ASSIGNED || $request->sts == RequestHeader::STS_PROGRESSING || $request->sts == RequestHeader::STS_COMPLETE || $request->sts == RequestHeader::STS_VERIFY) {?>
				<a href="javascript:openReport(<?=$request->id ?>)">
					<img src="<?= Yii::app()->baseUrl.'/images/pencil_48.png'?>" width="20" />
				</a>
				<? }?>
			</td>
			<td>
				<a href="../report/genPDF?id=<?=$request->id ?>">
					<img src="<?= Yii::app()->baseUrl.'/images/doc.png'?>" width="20" />
				</a>
			</td>
		</tr>
		<? }?>
	</table>
</div>
