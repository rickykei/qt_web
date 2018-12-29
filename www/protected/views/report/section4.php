<?
$options2 = array(''=>'')  + Option2::getDropDownFromCache();
$yesNo = array(''=>'')  + array('Y'=>'Yes', 'N'=>'No');

$supplyChainModel = $model->req_supply_chain;
$rawMaterials = $supplyChainModel->req_raw_material;
$components = $supplyChainModel->req_component;
$subContracts = $supplyChainModel->req_sub_contract;
?>

<? 
echo CHtml::errorSummary($supplyChainModel, '', '', array('class'=>'errorMsg'));
foreach($rawMaterials as $item) {
	echo CHtml::errorSummary($item, '', '', array('class'=>'errorMsg'));
}
foreach($components as $item) {
	echo CHtml::errorSummary($item, '', '', array('class'=>'errorMsg'));
}
foreach($subContracts as $item) {
	echo CHtml::errorSummary($item, '', '', array('class'=>'errorMsg'));
}
?>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'section4Save',
		'enableAjaxValidation'=>false,
	)); ?>

<? echo CHtml::hiddenField('reqHdrId', $reqHdrId); ?>

<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="4" bgcolor="#000099" class="sectionheader">SECTION 4 - SUPPLY CHAIN MANAGEMENT</td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#999999">Raw Materials</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">Material</td>
    <td colspan="2" bgcolor="#CCCCCC">Country of Origin</td>
  </tr>
  
  <? foreach ($rawMaterials as $idx=>$item) {?>
  <tr>
    <td colspan="2"><? echo $form->textField($item, '['.$idx.']material'); ?></td>
    <td colspan="2"><? echo $form->dropDownList($item, '['.$idx.']country_id', $options2); ?></td>
  </tr>
  <? }?>
  
  <tr>
    <td colspan="2" bgcolor="#999999">Components</td>
    <td colspan="2" bgcolor="#999999">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">Parts</td>
    <td colspan="2" bgcolor="#CCCCCC">Country of Origin</td>
  </tr>
  
  <? foreach ($components as $idx=>$item) {?>
  <tr>
    <td colspan="2"><? echo $form->textField($item, '['.$idx.']part'); ?></td>
    <td colspan="2"><? echo $form->dropDownList($item, '['.$idx.']country_id', $options2); ?></td>
  </tr>
  <? }?>
  
  <tr>
    <td colspan="2" bgcolor="#999999">Sub-Contracting</td>
    <td colspan="2" bgcolor="#999999">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">Production Process</td>
    <td colspan="2" bgcolor="#CCCCCC">Country of Origin</td>
  </tr>
  
  <? foreach ($subContracts as $idx=>$item) {?>
  <tr>
    <td colspan="2"><? echo $form->textField($item, '['.$idx.']prod_process'); ?></td>
    <td colspan="2"><? echo $form->dropDownList($item, '['.$idx.']country_id', $options2); ?></td>
  </tr>
  <? }?>
  
  <tr>
    <td width="28%" bgcolor="#CCCCCC">Perform Supplier Audit</td>
    <td colspan="2" bgcolor="#CCCCCC">Perform IQC</td>
    <td width="40%" bgcolor="#CCCCCC">Has the factory got any back-up supplier for it's main supplier/contractor</td>
  </tr>
  <tr>
    <td><? echo $form->dropDownList($supplyChainModel, 'perform_supp_audit', $yesNo); ?></td>
    <td colspan="2"><? echo $form->dropDownList($supplyChainModel, 'perform_icq', $yesNo); ?></td>
    <td><? echo $form->dropDownList($supplyChainModel, 'backup_supp', $yesNo); ?></td>
  </tr>
</table>

<? if ($model->sts != RequestHeader::STS_COMPLETE) {?>
<input type="submit" value="Save & Next" />
<? }?>

<? $this->endWidget(); ?>