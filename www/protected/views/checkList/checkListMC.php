<?
$riskDropDown = McMaster::getRiskDropDown();
$photoDropDown = McMaster::getPhotoDropDown(); 
?>


<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'checkListSave',
		'enableAjaxValidation'=>false,
	)); ?>
		<? echo $form->hiddenField($model, 'newCatId'); ?>
		<? echo $form->hiddenField($model, 'newSubCatId'); ?>
	
		<? echo $form->hiddenField($model, 'catId'); ?>
		<? echo $form->hiddenField($model, 'subCatId'); ?>
	
			<table id="checklist_detail_table_header">
				<tr>
					<th><input type="checkbox" id="checkallmc" onclick="selectAll()" /></th>
					<th>Requirement</th>
					<th>Risk Code</th>
					<? //<th>Photo</th> ?>
					<th>Law</th>
				</tr>
				
				<?
				$row = 2; 
				foreach($mcs as $mc) {
					if ($row == 1) {
						$row = 2;
					}
					else {
						$row = 1;
					}
				?>
					<tr class="checklist_detail_table_content<?=$row?>">
						<td><?=CHtml::checkBox("mc[]", $mc->checked, array('value'=>$mc->id)) ?></td>
						<td><?=CHtml::encode($mc->question) ?></td>
						<td><?=$mc->riskCode ?></td>
					<?/*	<td><?=$mc->photoCode ?></td>  */?>
						<td><?=$mc->law ?></td>
					</tr>
				<? }?>
			</table>

			<br/>
			<hr>	<br/>
			<div class="clean"></div>

			<table id="checklist_detail_tailor_make_table">
				<tr>
					<td colspan="5" class="checklist_detail_tailor_make_table_title">
						Tailor Make MC
					</td>
				</tr>

				<tr>
					<th>ID</th>
					<th>Requirement</th>
					<th>Risk Code</th>
				 	<th>Photo</th>  
					<th>Law</th>
				</tr>
				
				<?
				$rowCnt = 0;
				$handMakeMCs[] = new CheckListHandMakeMCForm; // add 1 more row
				foreach($handMakeMCs as $mc) {
				?>
				<tr>
					<td><?=++$rowCnt ?></td>
					<td><? echo $form->textField($mc, 'question', array('name'=>'handMakeMC[question][]')); ?></td>
					<td>
						<? echo $form->dropDownList($mc, 'risk', $riskDropDown, array('name'=>'handMakeMC[risk][]')); ?>
					</td>
					<td>
						<? echo $form->dropDownList($mc, 'photo', $photoDropDown, array('name'=>'handMakeMC[photo][]')); ?>
					</td>
					<td><? echo $form->textField($mc, 'law', array('name'=>'handMakeMC[law][]')); ?></td>
				</tr>
				<? }?>
			</table>
<? $this->endWidget(); ?>