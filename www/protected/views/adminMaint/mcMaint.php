<?
$isReadonly = empty($model->id) ? false : true; 
?>

<? $this->widget('ResultMessage', array('msg'=>$msg)); ?>

<div id="thickbox_header">Vendor Register</div>
<div class="clear"></div>
	<div id="thickbox_form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'userAccSave',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'input_form',)
	)); ?>

		<? echo $form->hiddenField($model,'id'); ?>

		<div><label>User Name:</label><? echo $form->textField($model,'username', array('readonly'=>$isReadonly)); ?></div>
		<? echo $form->error($model,'username'); ?>
		
		<div><label>Password:</label><? echo $form->passwordField($model,'password'); ?></div>
		<? echo $form->error($model,'password'); ?>
		
		<div><label>Re-enter Password:</label><? echo $form->passwordField($model,'reEnterPW'); ?></div>
		<? echo $form->error($model,'reEnterPW'); ?><br>
		
		<div><label>Role:</label><? echo $form->dropdownlist($model, 'role', User::getRoleDropDown()); ?></div>
		<? echo $form->error($model,'role'); ?><br>
		
		<div><label>Status:</label><? echo $form->dropdownlist($model, 'sts', array('A'=>'Active', 'I'=>'Inactive')); ?></div>
		<? echo $form->error($model,'sts'); ?>

		<br/>
		<br/>
		 
		<div id="buttondiv">
			<? if ($model->id == NULL) {?>
				<input type="submit" id="create" value="&nbsp;&nbsp;Create&nbsp;&nbsp;"/>&nbsp;
			<? } else {?>
				<input type="submit" id="update" value="&nbsp;&nbsp;Update&nbsp;&nbsp;"/>&nbsp;
			<? }?>
			<input type="button" id="cancel" value="&nbsp;&nbsp;Cancel&nbsp;&nbsp;" onclick="self.parent.tb_remove();"/>
		</div>
	
	<? $this->endWidget(); ?>

</div>
