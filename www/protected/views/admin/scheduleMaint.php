<?
// Dropdown
$auditors = Auditor::getDropDown(); 
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jscal2.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jscal2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lang/en.js"></script>

<? echo CHtml::errorSummary($model, '', '', array('class'=>'errorMsg')); ?>

<div id="thickbox_header">Assign Auditor</div>
<div class="clear"></div>
<div id="thickbox_form">
	
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'scheduleSave',
		'enableAjaxValidation'=>false,
	)); ?>
	
	<? echo $form->hiddenField($model,'id'); ?>
				 
	<label>Buyer Code:</label><label class="left"><?=CHtml::encode($model->buyer_info->buyer_cd) ?></label><br>
	<label>Report Code:</label><label class="left"><?=CHtml::encode($model->report_cd) ?></label><br>
	<label>Schedule start date:</label><? echo $form->textField($model,'sch_start_date', array('readonly'=>'readonly')); ?>
	<input type="button" class="calendar_button" id="startDateBtn" value=" " />
	<br/>
	<label>Schedule end date:</label><? echo $form->textField($model,'sch_end_date', array('readonly'=>'readonly')); ?>
	<input type="button" class="calendar_button" id="endDateBtn" value=" " />
	<br/>
	<label>Auditor:</label><? echo $form->dropDownList($model, 'auditor_id', array(''=>'') + $auditors); ?>
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
<div class="clear"></div>

<script type="text/javascript">
$(function() {
	Calendar.setup({
	    inputField : "ScheduleMaintForm_sch_start_date",
	    trigger    : "startDateBtn",
	    onSelect   : function() { this.hide() }
	});

	Calendar.setup({
	    inputField : "ScheduleMaintForm_sch_end_date",
	    trigger    : "endDateBtn",
	    onSelect   : function() { this.hide() }
	});
});

</script>
 