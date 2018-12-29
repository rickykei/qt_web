<?
$isReadonly = empty($model->id) ? false : true; 

$isShowBuyer = false;
$isShowAuditor = false;
if ($model->role == 'BUYER') {
	$isShowBuyer = true;
}
else if ($model->role == 'AUDITOR') {
	$isShowAuditor = true;
}

?>

<? $this->widget('ResultMessage', array('msg'=>$msg)); ?>
<? echo CHtml::errorSummary($model, '', '', array('class'=>'errorMsg')); ?>

<div id="thickbox_header">User Register</div>
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
		<? echo $form->error($model,'username'); ?><br/>
		
		<div><label>Password:</label><? echo $form->passwordField($model,'password'); ?></div>
		<? echo $form->error($model,'password'); ?><br/>
		
		<div><label>Re-enter Password:</label><? echo $form->passwordField($model,'reEnterPW'); ?></div>
		<? echo $form->error($model,'reEnterPW'); ?><br>
		
		<div><label>Role:</label><? echo $form->dropdownlist($model, 'role', User::getRoleDropDown()); ?></div> 
		<? echo $form->error($model,'role'); ?><br>
		
		<div id="buyerDiv" <? if (!$isShowBuyer) {?>style="display:none" <? }?>><label>Buyer:</label><? echo $form->dropdownlist($model, 'buyer_id', BuyerInfo::getDropDown()); ?><br></div>
		
		<div id="auditorDiv" <? if (!$isShowAuditor) {?>style="display:none" <? }?>><label>Auditor:</label><? echo $form->dropdownlist($model, 'auditor_id', Auditor::getDropDown()); ?><br></div> 
		
		<div><label>Status:</label><? echo $form->dropdownlist($model, 'sts', array('A'=>'Active', 'I'=>'Inactive')); ?></div>
		<? echo $form->error($model,'sts'); ?>

	 
		<br/>
		 
		<div id="buttondiv">
			<? if ($model->id == NULL) {?>
				<?php echo CHtml::imageButton('/images/enter.gif',array('../')); ?>
			<? } else {?>
				<?php echo CHtml::imageButton('/images/enter.gif',array('../')); ?>
			<? }?>
				<?php //echo CHtml::submitButton('Login'); ?><input type="image" src="/images/close.gif" onclick="self.parent.tb_remove()" value="Close" />
		</div>
	
	<? $this->endWidget(); ?>

</div>

<script type="text/javascript">
	$(function() {
		$('#UserAccountMaintForm_role').change(function() {
			role = $(this).val();
			if (role == 'BUYER') {
				$('#buyerDiv').show();
				$('#auditorDiv').hide();
			}
			else if (role == 'AUDITOR') {
				$('#buyerDiv').hide();
				$('#auditorDiv').show();
			}
			else {
				$('#buyerDiv').hide();
				$('#auditorDiv').hide();
			}
		});
	});
</script>
