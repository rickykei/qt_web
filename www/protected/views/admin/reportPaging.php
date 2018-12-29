<? 
$this->widget('SimplaPager', array('pages'=>$pages)); 
?>

<div id="contentresult">
	<table id="checklist_table">
		<tr class="checklist_table_header">
			<th width="180">Buyer CD</th>
			<th width="150">Req Report Code</th>
			<th width="150">Supplier</th>
			<th width="100">Risk Lvl</th>
			<th width="100">Auditor</th>
			<th width="120">Audit start date</th>
			<th width="120">Audit end date</th>
			<th width="120">Complete Date</th>
			<th width="30">DOC</th>
		</tr>

		<? foreach($items as $request) {?>
		<tr class="checklist_table_content">
			<td><?=CHtml::encode($request->buyer_info->buyer_cd) ?></td>
			<td><?=CHtml::encode($request->report_cd) ?></td>
			<td><?=CHtml::encode($request->supplier->name) ?></td>
			<td><?=$request->riskCode ?></td>
			<td><?=CHtml::encode($request->auditor->name) ?></td>
			<td><?=$request->sch_start_date == NULL ? '' : Yii::app()->dateFormatter->format('yyyy-MM-dd', $request->sch_start_date) ?></td>
			<td><?=$request->sch_end_date == NULL ? '' : Yii::app()->dateFormatter->format('yyyy-MM-dd', $request->sch_end_date) ?></td>
			<td><?=$request->complete_date ?></td>
			
			<td>
				<a href="../report/genPDF?id=<?=$request->id ?>">
					<img src="<?= Yii::app()->baseUrl.'/images/doc.png'?>" width="20" />
				</a>
			</td>
		</tr>
		<? }?>
	</table>
</div>
