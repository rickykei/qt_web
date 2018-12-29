<?
$options10 = array(''=>'')  + Option10::getDropDownFromCache();
$yesNo = array(''=>'')  + array('Y'=>'Yes', 'N'=>'No');

$certs = $model->req_certification;
?>

<? 
foreach($certs as $item) {
	echo CHtml::errorSummary($item, '', '', array('class'=>'errorMsg'));
} 
?>


<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'section7Save',
		'enableAjaxValidation'=>false,
	)); ?>

<? echo CHtml::hiddenField('reqHdrId', $reqHdrId); ?>


<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="6" bgcolor="#000099" class="sectionheader">SECTION 7 - RELATED CERTIFICATION</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <? for ($i = 0; $i < sizeof($certs); $i+=2) {
  	$j = $i + 1;
  	$cert1 = $certs[$i];
  	$cert2 = $certs[$j];
  	
  ?>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><? echo $form->textField($cert1, '['.$i.']cert_name'); ?><? echo $form->hiddenField($cert1, '['.$i.']id'); ?></td>
    <td colspan="3" bgcolor="#CCCCCC"><? echo $form->textField($cert2, '['.$j.']cert_name'); ?><? echo $form->hiddenField($cert2, '['.$j.']id'); ?></td>
  </tr>
  <tr>
    <td colspan="3">filename: <? echo $form->textField($cert1, '['.$i.']filename'); ?></td>
    <td colspan="3">filename: <? echo $form->textField($cert2, '['.$j.']filename'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Comply</td>
    <td bgcolor="#CCCCCC">Certification By</td>
    <td bgcolor="#CCCCCC">Expiry Date</td>
    <td bgcolor="#CCCCCC">Comply</td>
    <td bgcolor="#CCCCCC">Certification By</td>
    <td bgcolor="#CCCCCC">Expiry Date</td>
  </tr>
  <tr>
    <td><? echo $form->dropDownList($cert1, '['.$i.']is_comply', $yesNo); ?></td>
    <td><? echo $form->dropDownList($cert1, '['.$i.']cert_by', $options10, array('style'=>'width:300px')); ?></td>
    <td><? echo $form->textField($cert1, '['.$i.']expiry_date'); ?></td>
    
    <td><? echo $form->dropDownList($cert2, '['.$j.']is_comply', $yesNo); ?></td>
    <td><? echo $form->dropDownList($cert2, '['.$j.']cert_by', $options10, array('style'=>'width:300px')); ?></td>
    <td><? echo $form->textField($cert2, '['.$j.']expiry_date'); ?></td>
  </tr>
  <tr>
  	<td colspan="6">&nbsp;</td>
  </tr>
  <? }?>
  
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

<? if ($model->sts != RequestHeader::STS_COMPLETE) {?>
<input type="submit" value="Save & Next" />
<? }?>

<? $this->endWidget(); ?>