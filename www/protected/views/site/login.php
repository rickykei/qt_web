
<? echo CHtml::error($model,'password', array('class'=>'errorMsg')); ?>

<div id="thickbox_header">Login</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="clear"></div>
<div id="thickbox_form">
	<?php //echo $form->error($model,'password'); ?>
	<div id="left_row">
		<img src="/images/key.gif"/>
	</div>
	<div id="right_row">
		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php// echo $form->error($model,'username'); ?>
		</div>
		 
		<div class="row">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
		</div>
		<br>
		<div class="row">
			<label>&nbsp;</label>
			<?php echo CHtml::imageButton('/images/enter.gif',array('../')); ?>
			<?php //echo CHtml::submitButton('Login'); ?><input type="image" src="/images/close.gif" onclick="self.parent.tb_remove()" value="Close" />
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<script type="text/javascript">
$(function() {
	$('#LoginForm_username').focus();
});
</script>
