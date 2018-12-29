<? $this->widget('SimplaPager', array('pages'=>$pages)); ?>

<div id="contentresult">
	<table id="checklist_table">
		
		<tr class="checklist_table_header">
			<th width="80">Req id</th>
			<th width="180">Supplier Name</th>
			<th width="100">Req Report Code</th>
			<th width="150">Check List Name</th>
			<th width="100">Area</th>
			<th width="150">Risk LV</th>
			<th width="150">Auditor </th>
			<th width="150">Complete Date</th>
			<th width="30">DOC</th>
		</tr>
		
		<? foreach($items as $request) {?>
		<tr class="checklist_table_content">
			<td><?=CHtml::encode($request->id)?></td>
			<td><?=CHtml::encode($request->supplier->name) ?></td>
			<td><?=CHtml::encode($request->report_cd) ?></td>
			<td><?=CHtml::encode($request->check_list_template->check_list_name) ?></td>
			<td><?=$request->supplier->option3->value ?></td>
			<td><?=CHtml::encode($request->riskCode) ?></td>
			<td><?=CHtml::encode($request->auditor->name) ?></td>
			<td><?=CHtml::encode($request->complete_date) ?></td>
			<td>
				<? if ($request->sts == RequestHeader::STS_VERIFY) {?>
				<a href="../report/genPDF?id=<?=$request->id ?>">
					<img src="<?= Yii::app()->baseUrl.'/images/doc.png'?>" width="20" />
				</a>
				<? }?>
			</td>
		</tr>
		<? }?>
	</table>
</div>
