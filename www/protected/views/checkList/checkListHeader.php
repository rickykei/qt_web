<?
$versions = CheckListTemplate::getRevsionDropDown();
?>

<? echo CHtml::errorSummary($model, '', '', array('class'=>'errorMsg')); ?>

<div id="thickbox_header">Checked List Register</div>
<div class="clear"></div>
<div id="thickbox_form">

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'checkListHeader',
		'enableAjaxValidation'=>false,
	)); ?>
	
	<? echo $form->hiddenField($model, 'id'); ?>
	<? echo $form->hiddenField($model, 'action'); ?>

	<label>Check List Name:</label><? echo $form->textField($model,'check_list_name'); ?><br/>
	<label>Establish Date:</label><? echo $form->textField($model,'establish_date', array('readonly'=>'readonly')); ?>
	<br/>
	<label>Create By:</label><? echo $form->textField($model,'create_by', array('readonly'=>'readonly')); ?><br/>
	<br/>
	<div id="buttondiv">
		<label>&nbsp;</label>
		<?php echo CHtml::imageButton('/images/enter.gif'); ?>
		 
		<?php //echo CHtml::submitButton('Login'); ?><input type="image" src="/images/close.gif" onclick="self.parent.tb_remove()" value="Close" />
	</div>
<? $this->endWidget(); ?>
</div>
<div class="clear"></div>
