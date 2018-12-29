<?
$options2 = array('0'=>'')  + Option2::getDropDownFromCache();
$options6 = array('0'=>'')  + Option6::getDropDownFromCache();
$options7 = array('0'=>'')  + Option7::getDropDownFromCache();

$factoryOrgModel = $model->req_factory_org;
$managementTeamModel = $model->req_management_team;
$prodProcesses = $model->req_prod_process;
?>

<? echo CHtml::errorSummary($factoryOrgModel, '', '', array('class'=>'errorMsg')); ?>
<? echo CHtml::errorSummary($managementTeamModel, '', '', array('class'=>'errorMsg')); ?>
<? foreach($prodProcesses as $item) {
	echo CHtml::errorSummary($item, '', '', array('class'=>'errorMsg'));
} 
?>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'section2Save',
		'enableAjaxValidation'=>false,
	)); ?>

<? echo CHtml::hiddenField('reqHdrId', $reqHdrId); ?>

<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#000099" class="sectionheader">SECTION 2 - FACTORY ORGANIZATION AND PRODUCTION PROCESS</td>
  </tr>
  <tr>
    <td width="50%">Factory Organization Chart</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">filename: <? echo $form->textField($factoryOrgModel, 'filename'); ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr bgcolor="#999999">
    <td height="27" colspan="6">Production Process</td>
  </tr>
  
  
<? foreach($prodProcesses as $idx=>$item) { ?>
  <tr>
    <td bgcolor="#CCCCCC">Process</td>
    <td bgcolor="#CCCCCC">Photo</td>
    <td bgcolor="#CCCCCC">Machine</td>
    <td bgcolor="#CCCCCC">Origin</td>
    <td bgcolor="#CCCCCC">Years of use</td>
    <td bgcolor="#CCCCCC">Quantity</td>
  </tr>
  <tr>
    <td rowspan="3"><? echo $form->dropDownList($item, '['.$idx.']process_id', $options6); ?></td>
    <td rowspan="3">filename:<? echo $form->textField($item, '['.$idx.']photo'); ?></td>
    <td><? echo $form->dropDownList($item, '['.$idx.']machine_id', $options7); ?></td>
    <td><? echo $form->dropDownList($item, '['.$idx.']origin_id', $options2); ?></td>
    <td><? echo $form->textField($item, '['.$idx.']use_year'); ?></td>
    <td><? echo $form->textField($item, '['.$idx.']qty'); ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">Total Number of staff</td>
    <td colspan="2" bgcolor="#CCCCCC">Machine Name</td>
  </tr>
  <tr>
    <td colspan="2"><? echo $form->textField($item, '['.$idx.']staff_no'); ?></td>
    <td colspan="2"><? echo $form->textField($item, '['.$idx.']machine_name'); ?></td>
  </tr>
<? }?>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#999999">Management Team</td>
  </tr>
  <tr>
    <td width="45%">Factory Manager</td>
    <td width="55%"><? echo $form->textField($managementTeamModel, 'factory_manager'); ?></td>
  </tr>
  <tr>
    <td>Admin. Manager</td>
    <td><? echo $form->textField($managementTeamModel, 'admin_manager'); ?></td>
  </tr>
  <tr>
    <td>Quality Manager</td>
    <td><? echo $form->textField($managementTeamModel, 'quality_manager'); ?></td>
  </tr>
  <tr>
    <td>Engineering Manager</td>
    <td><? echo $form->textField($managementTeamModel, 'eng_manager'); ?></td>
  </tr>
  <tr>
    <td>HR Manager</td>
    <td><? echo $form->textField($managementTeamModel, 'hr_manager'); ?></td>
  </tr>
  <tr>
    <td>Production Manager</td>
    <td><? echo $form->textField($managementTeamModel, 'prod_manager'); ?></td>
  </tr>
</table>

<? if ($model->sts != RequestHeader::STS_COMPLETE) {?>
<input type="submit" value="Save & Next" />
<? }?>

<? $this->endWidget(); ?>