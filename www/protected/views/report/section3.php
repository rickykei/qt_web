<?
$options3 = array('0'=>'')  + Option3::getDropDownFromCache();
$options8 = array('0'=>'')  + Option8::getDropDownFromCache();
$options9 = array('0'=>'')  + Option9::getDropDownFromCache();
$options11 = array('0'=>'')  + Option11::getDropDownFromCache();
$yesNo = array(''=>'') + array('Y'=>'Yes', 'N'=>'No');

$publicPowerSupply = $model->req_public_power_supply;
$transCapTrunck = $model->req_trans_capability_trunck;
$transCapMiniVan = $model->req_trans_capability_minivan;
?>

<? echo CHtml::errorSummary($publicPowerSupply, '', '', array('class'=>'errorMsg')); ?>
<? echo CHtml::errorSummary($transCapTrunck, '', '', array('class'=>'errorMsg')); ?>
<? echo CHtml::errorSummary($transCapMiniVan, '', '', array('class'=>'errorMsg')); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'section3Save',
		'enableAjaxValidation'=>false,
	)); ?>

<? echo CHtml::hiddenField('reqHdrId', $reqHdrId); ?>

<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="3" bgcolor="#000099" class="sectionheader">SECTION 3 - POWER SUPPLY &amp; TRANSPORATION CAPABILTY</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#999999">Public Power Supply</td>
  </tr>
  <tr>
    <td width="31%" bgcolor="#CCCCCC">Electric Power Generator</td>
    <td width="32%" bgcolor="#CCCCCC">Connected to public power supply</td>
    <td width="37%" bgcolor="#CCCCCC">Frequent power outage in the area?</td>
  </tr>
  <tr>
    <td rowspan="2">filename: <? echo $form->textField($publicPowerSupply, 'filename'); ?></td>
    <td><? echo $form->dropDownList($publicPowerSupply, 'is_connect', $yesNo); ?></td>
    <td><? echo $form->dropDownList($publicPowerSupply, 'is_freq_power_outage', $yesNo); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Frequency of the power outage in the area</td>
    <td><? echo $form->dropDownList($publicPowerSupply, 'power_outage_freq', $options8); ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="5" bgcolor="#999999">Transportation Capability</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><? echo $form->dropDownList($transCapTrunck, 'type', $options9); ?></td>
    <td colspan="2" bgcolor="#CCCCCC"><? echo $form->dropDownList($transCapMiniVan, 'type', $options9); ?></td>
  </tr>
  <tr>
    <td colspan="3">filename: <? echo $form->textField($transCapTrunck, 'filename'); ?></td>
    <td colspan="2">filename: <? echo $form->textField($transCapMiniVan, 'filename'); ?></td>
  </tr>
  <tr>
    <td width="20%" bgcolor="#CCCCCC">Quantity</td>
    <td colspan="2" bgcolor="#CCCCCC">Purpose</td>
    <td width="29%" bgcolor="#CCCCCC">Quantity</td>
    <td width="30%" bgcolor="#CCCCCC">Purpose</td>
  </tr>
  <tr>
    <td><? echo $form->textField($transCapTrunck, 'qty'); ?></td>
    <td colspan="2"><? echo $form->textField($transCapTrunck, 'purpose'); ?></td>
    <td><? echo $form->textField($transCapMiniVan, 'qty'); ?></td>
    <td><? echo $form->textField($transCapMiniVan, 'purpose'); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Delivery/Loading Conditions</td>
    <td colspan="2" bgcolor="#CCCCCC">Nearest Sea Port</td>
    <td colspan="2" bgcolor="#CCCCCC">Nearest International Airport</td>
  </tr>
  <tr>
    <td><? echo $form->textField($transCapTrunck, 'deliv_cond'); ?></td>
    <td colspan="2"><? echo $form->dropDownList($transCapTrunck, 'near_sea_port_id', $options3); ?></td>
    <td colspan="2"><? echo $form->dropDownList($transCapMiniVan, 'near_inter_airport_id', $options3); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="12%" bgcolor="#CCCCCC">Diving Distance</td>
    <td width="9%"><? echo $form->dropDownList($transCapTrunck, 'diving_distance', $options11); ?></td>
    <td bgcolor="#CCCCCC">Diving Distance</td>
    <td><? echo $form->dropDownList($transCapMiniVan, 'diving_distance', $options11); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<? if ($model->sts != RequestHeader::STS_COMPLETE) {?>
<input type="submit" value="Save & Next" />
<? }?>

<? $this->endWidget(); ?>

