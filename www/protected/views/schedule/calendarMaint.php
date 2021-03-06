<?
// Dropdown
$templateNames = CheckListTemplate::model()->getDropDown();
$suppliers = Supplier::model()->getDropDown();  
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jscal2.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jscal2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lang/en.js"></script>

<? echo CHtml::errorSummary($model, '', '', array('class'=>'errorMsg')); ?>

<div id="thickbox_header">Schedule New Request</div>
<div class="clear"></div>
<div id="thickbox_form">
	
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'calendarSave',
		'enableAjaxValidation'=>false,
	)); ?>
	
	<? echo $form->hiddenField($model,'id'); ?>
				 
	<label>Template Name:</label><? echo $form->dropDownList($model, 'check_list_template_id', $templateNames ,array('class'=>'input')); ?> <br/>
	
	<label>Supplier Code:</label><? echo $form->dropDownList($model, 'supplier_id', $suppliers,array('class'=>'input')); ?> <br/>
	
	<label>Request target start date:</label><? echo $form->textField($model,'sch_start_date', array('readonly'=>'readonly','class'=>'date')); ?> 
	<input type="button" class="calendar_button date" id="startDateBtn" value=" " /><br/>
	 
	<label>Request target end date:</label><? echo $form->textField($model,'sch_end_date', array('readonly'=>'readonly','class'=>'date')); ?> 
	<input type="button" class="calendar_button date" id="endDateBtn" value=" " /><br/>
 
	<label>Request report CD:</label><? echo $form->textField($model,'report_cd'); ?> 
	
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
	Calendar.setup({
	    inputField : "CalendarMaintForm_sch_start_date",
	    trigger    : "startDateBtn",
	    onSelect   : function() { this.hide() }
	});

	Calendar.setup({
	    inputField : "CalendarMaintForm_sch_end_date",
	    trigger    : "endDateBtn",
	    onSelect   : function() { this.hide() }
	});
});
</script>
 