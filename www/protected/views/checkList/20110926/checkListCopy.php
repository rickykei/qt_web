<?
$versions = CheckListTemplate::getRevsionDropDown();
?>

<? echo CHtml::errorSummary($model, '', '', array('class'=>'errorMsg')); ?>

<div id="thickbox_header">Copy Check List</div>
<div class="clear"></div>
<div id="thickbox_form">

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'checkListCopy',
		'enableAjaxValidation'=>false,
	)); ?>
	
	<? echo $form->hiddenField($model,'copyFromId'); ?>

	<label>Check List Name:</label><? echo $form->textField($model,'check_list_name'); ?><br/>
	<label>Establish Date:</label><? echo $form->textField($model,'establish_date', array('readonly'=>'readonly')); ?><br/>
	<label>Version:</label><? echo $form->dropDownList($model, 'version', $versions); ?><br/>
	<label>Create By:</label><? echo $form->textField($model,'create_by', array('readonly'=>'readonly')); ?><br/>
	<br/>
	<br/>
	<div id="buttondiv">
		<input type="submit" id="create" value="&nbsp;&nbsp;Create&nbsp;&nbsp;"/>&nbsp;
		<input type="button" id="cancel" value="&nbsp;&nbsp;Cancel&nbsp;&nbsp;" onclick="self.parent.tb_remove();"/>
	</div>
<? $this->endWidget(); ?>
</div>
<div class="clear"></div>
