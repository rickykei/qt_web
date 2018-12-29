<?
$options1 = array('0'=>'')  + Option1::getDropDownFromCache();
$options2 = array('0'=>'')  + Option2::getDropDownFromCache();
$options3 = array('0'=>'')  + Option3::getDropDownFromCache();
$options4 = array('0'=>'')  + Option4::getDropDownFromCache();
$yesNo = array(''=>'')  + array('Y'=>'Yes', 'N'=>'No');

$genInfoModel = $model->req_general_info;
$mainMarkets = $model->req_general_info->req_main_market;
$annualTurnovers = $model->req_general_info->req_annual_turnover;
$factoryInfoModel = $model->req_factory_info;
$factoryOperationModel = $model->req_factory_operation;
$surroundAreaModel = $model->req_surround_area;
?>

<? 
echo CHtml::errorSummary($genInfoModel, '', '', array('class'=>'errorMsg'));

foreach($mainMarkets as $item) {
	echo CHtml::errorSummary($item, '', '', array('class'=>'errorMsg'));
}

foreach($annualTurnovers as $item) {
	echo CHtml::errorSummary($item, '', '', array('class'=>'errorMsg'));
}

echo CHtml::errorSummary($factoryInfoModel, '', '', array('class'=>'errorMsg'));
echo CHtml::errorSummary($factoryOperationModel, '', '', array('class'=>'errorMsg'));
echo CHtml::errorSummary($surroundAreaModel, '', '', array('class'=>'errorMsg')); 
?>


<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'section1Save',
		'enableAjaxValidation'=>false,
	)); ?>

<? echo CHtml::hiddenField('reqHdrId', $reqHdrId); ?>

<table width="100%" height="278" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="4" bgcolor="#000099" class="sectionheader">SECTION 1 - FACTORY PROFILE</td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#999999">GENERAL INFORMATION</td>
  </tr>
  <tr>
    <td width="148" bgcolor="#CCCCCC">Date of Foundation</td>
    <td colspan="2"><? echo $form->textField($genInfoModel, 'foundation_date'); ?></td>
    <td width="413"><?=$model->supplier->name ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Legal Status</td>
    <td colspan="2"><? echo $form->dropDownList($genInfoModel, 'legal_sts', $options1); ?></td>
    <td width="413" rowspan="6">filename: <? echo $form->textField($genInfoModel, 'filename'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Investment</td>
    <td colspan="2"><? echo $form->dropDownList($genInfoModel, 'investment_id', $options2); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Area</td>
    <td colspan="2"><? echo $form->dropDownList($genInfoModel, 'area_id', $options3); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Number of office staff</td>
    <td colspan="2"><? echo $form->textField($genInfoModel, 'office_staff_no'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Number of workers</td>
    <td colspan="2"><? echo $form->textField($genInfoModel, 'worker_no'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Factory Manager</td>
    <td colspan="2"><? echo $form->textField($genInfoModel, 'factory_manager'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Main Market</td>
    <td width="194"><? echo $form->dropDownList($mainMarkets[0], '[0]country_id', $options2); ?></td>
    <td width="140"><? echo $form->dropDownList($mainMarkets[0], '[0]pct_id', $options4); ?></td>
    <td rowspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td><? echo $form->dropDownList($mainMarkets[1], '[1]country_id', $options2); ?></td>
    <td><? echo $form->dropDownList($mainMarkets[1], '[1]pct_id', $options4); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Internet</td>
    <td colspan="2"><? echo $form->dropDownList($genInfoModel, 'internet', $yesNo); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Homepage</td>
    <td colspan="2"><? echo $form->textField($genInfoModel, 'homepage'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Business License</td>
    <td>BR Number</td>
    <td><? echo $form->textField($genInfoModel, 'br_no'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>Date Issued</td>
    <td><? echo $form->textField($genInfoModel, 'date_issue'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>Espiration</td>
    <td><? echo $form->textField($genInfoModel, 'espiration'); ?></td>
  </tr>
  
  <? foreach ($annualTurnovers as $idx=>$item) {?>
  <tr>
    <td bgcolor="#CCCCCC"><? if ($idx == 0) {?>Annual Turnover<? }?></td>
    <td><? echo $form->textField($item, '['.$idx.']year'); ?></td>
    <td><? echo $form->textField($item, '['.$idx.']amt'); ?></td>
  </tr>
  <? }?>
</table>


<p>&nbsp;</p>


<table width="100%" height="35" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#999999">FACTORY INFORMATION</td>
  </tr>
  <tr>
    <td width="22%" align="right" bgcolor="#CCCCCC">Factory Name</td>
    <td width="78%"><? echo $form->textField($factoryInfoModel, 'name'); ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Address</td>
    <td><? echo $form->textField($factoryInfoModel, 'addr'); ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Contact Person</td>
    <td><? echo $form->textField($factoryInfoModel, 'contact_person'); ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Telephone</td>
    <td><? echo $form->textField($factoryInfoModel, 'tel'); ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Fax</td>
    <td><? echo $form->textField($factoryInfoModel, 'fax'); ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Email</td>
    <td><? echo $form->textField($factoryInfoModel, 'email'); ?></td>
  </tr>
</table>


<p>&nbsp;</p>


<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#999999">FACTORY OPERATIONS</td>
  </tr>
  <tr>
    <td width="22%" align="right" bgcolor="#CCCCCC">Products Manufactured</td>
    <td width="78%"><? echo $form->textField($factoryOperationModel, 'product'); ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Monthly Production Capacity</td>
    <td><? echo $form->textField($factoryOperationModel, 'prod_capacity'); ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Area of Manufacturing Floor</td>
    <td><? echo $form->textField($factoryOperationModel, 'manuf_floor_area'); ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Area of Dormitory Area</td>
    <td><? echo $form->textField($factoryOperationModel, 'dormitory_area'); ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Area of Kitchen and Canteen</td>
    <td><? echo $form->textField($factoryOperationModel, 'kitchen_canteen_area'); ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Production Process Flow</td>
    <td><? echo $form->textField($factoryOperationModel, 'process_flow'); ?></td>
  </tr>
</table>


<p>&nbsp;</p>


<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#999999">Surrounding Area</td>
  </tr>
  <tr>
    <td width="50%">Factory Front Gate</td>
    <td width="50%">Factory Exterior View</td>
  </tr>
  <tr>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'front_gate'); ?></td>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'exterior'); ?></td>
  </tr>
  <tr>
    <td>Production Line View</td>
    <td>Production Line View</td>
  </tr>
  <tr>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'prod_line_1'); ?></td>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'prod_line_2'); ?></td>
  </tr>
  <tr>
    <td>Production Line View</td>
    <td>Production Line View</td>
  </tr>
  <tr>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'prod_line_3'); ?></td>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'prod_line_4'); ?></td>
  </tr>
  <tr>
    <td>Production Line View</td>
    <td><p>Quality Department/Testing Area</p></td>
  </tr>
  <tr>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'prod_line_5'); ?></td>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'quality'); ?></td>
  </tr>
  <tr>
    <td>Canteen</td>
    <td>Office Area</td>
  </tr>
  <tr>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'canteen'); ?></td>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'office'); ?></td>
  </tr>
  <tr>
    <td>Warehouse</td>
    <td>Dormitory</td>
  </tr>
  <tr>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'warehouse'); ?></td>
    <td>filename: <? echo $form->textField($surroundAreaModel, 'dormitory'); ?></td>
  </tr>
</table>

<? if ($model->sts != RequestHeader::STS_COMPLETE) {?>
<input type="submit" value="Save & Next" />
<? } ?>

<? $this->endWidget(); ?>
