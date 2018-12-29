<? 
$industries = Option6::getDropDownFromCache();
$types = Option12::getDropDownFromCache();
$areas = Option3::getDropDownFromCache();
?>
 


<? $this->widget('ResultMessage', array('msg'=>$msg)); ?>

<div id="thickbox_header">Vendor Register</div>
<div class="clear"></div>
	<div id="thickbox_form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>$action,
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('class'=>'input_form',)
	)); ?>

		<? echo $form->hiddenField($model,'id'); ?>
 
		<label>Vendor Name:</label><? echo $form->textField($model,'name',array('class'=>'input')); ?><? echo $form->error($model,'name'); ?><br/>
		
		<label>Address:</label><? echo $form->textField($model,'address',array('class'=>'input')); ?><? echo $form->error($model,'address'); ?><br/>
		
		<label>Contact Person:</label><? echo $form->textField($model,'contact_person',array('class'=>'input')); ?><? echo $form->error($model,'contact_person'); ?><br/>

		<label>Tel:</label><? echo $form->textField($model,'tel',array('class'=>'input')); ?><? echo $form->error($model,'tel'); ?><br/>
		
		<label>Fax</label><? echo $form->textField($model,'fax',array('class'=>'input')); ?><? echo $form->error($model,'fax'); ?><br/>
		
		<label>E-mail</label><? echo $form->textField($model,'email',array('class'=>'input')); ?><? echo $form->error($model,'email'); ?><br/>

		<label>Vendor Code:</label><? echo $form->textField($model,'code',array('class'=>'input')); ?><? echo $form->error($model,'code'); ?><br/>

		<label>Scope of Product/Service:</label><? echo $form->textField($model,'scope',array('class'=>'input')); ?><? echo $form->error($model,'scope'); ?><br/>

		<label>Vendor Industry:</label><? echo $form->dropDownList($model, 'industry', $industries);?><? echo $form->error($model,'industry'); ?><br/>

		<label>Vendor Type:</label><? echo $form->dropDownList($model, 'type', $types);?><? echo $form->error($model,'type'); ?> <br/>
		<label>Vendor Area:</label><? echo $form->dropDownList($model, 'area', $areas);?><? echo $form->error($model,'area'); ?> <br/>
 
		  
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


 