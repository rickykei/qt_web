<? 
$industries = Option6::getDropDownFromCache();
$types = Option12::getDropDownFromCache();
$areas = Option3::getDropDownFromCache();
?>

<style type="text/css">
.input input {
	width: 300px;
}
</style>

<? $this->widget('ResultMessage', array('msg'=>$msg)); ?>
<? echo CHtml::errorSummary($model, '', '', array('class'=>'errorMsg')); ?>

<div id="thickbox_header">Buyer Register</div>
<div class="clear"></div>
	<div id="thickbox_form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'buyerSave',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'input_form',)
	)); ?>

		<? echo $form->hiddenField($model,'id'); ?>
<div class="input">
		<div><label>Buyer Code:</label>
			<? if ($model->id) {
				echo $model->buyer_cd;	
			} else { ?>
				<? echo $form->textField($model,'buyer_cd'); ?>
			<? } ?>
			<br>
		</div>

		<div><label>Name:</label><? echo $form->textField($model,'name'); ?><br></div>
		
		<div><label>Address:</label><? echo $form->textField($model,'address'); ?><br></div>
		
		<div><label>Contact Person:</label><? echo $form->textField($model,'contact_person'); ?><br></div>

		<div><label>Tel:</label><? echo $form->textField($model,'tel'); ?><br></div>
		
		<div><label>Fax:</label><? echo $form->textField($model,'fax'); ?><br></div>
		
		<div><label>E-mail:</label><? echo $form->textField($model,'email'); ?><br></div>

		<div><label>Scope of Product/Service:</label><? echo $form->textField($model,'scope'); ?><br></div>

		<div><label>Industry:</label><? echo $form->dropDownList($model, 'industry', array(''=>'') + $industries);?><br></div>

		<div><label>Type:</label><? echo $form->dropDownList($model, 'type', array(''=>'') + $types);?><br></div>

		<div><label>Area:</label><? echo $form->dropDownList($model, 'area_cd', array(''=>'') + $areas);?><br></div>
		
		<div><label>Template Path:</label><? echo $form->textField($model,'template_path'); ?><br></div>
</div>		
		 
		 
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


 