<?
$buyers = BuyerInfo::getDropDown();
$auditors = Auditor::getDropDown(); 
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jscal2.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jscal2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lang/en.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/search.js"></script>

<div id="content">

	<div id="leftcol"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/schedulinglogo.png'); ?></div>

	<div id="rightcol">


		<ul>
			<? if (Yii::app()->user->role == 'BUYER') {?>
			<li class="row">
				<? echo CHtml::image(Yii::app()->request->baseUrl.'/images/calendar.png', 'Calendar', array('width'=>'80', 'class'=>'rowpic')); ?>
				To add a new request from the check list template, click here!
				<form  id="checklist_create" action="create_new_checklist.php" >
					<input type="button" alt="calendarCreate?KeepThis=true&TB_iframe=true&height=450&width=450&modal=true" title="" class="thickbox button" value="create"/>
				</form>

			</li>
			<? } ?>
			<li class="row" style="height:150px">
				<? echo CHtml::image(Yii::app()->request->baseUrl.'/images/supplier_search.png', 'Calendar Search', array('width'=>'80', 'class'=>'rowpic')); ?>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'checklist_search',
					'action'=>'schedule',
					'method'=>'get',
					'enableAjaxValidation'=>false,
				)); ?>
					<label>Buyer CD</label><? echo $form->dropDownList($model, 'buyerId', array('all'=>'All')+$buyers); ?><br/>
					<label>Req id</label><? echo $form->textField($model,'id'); ?><br/>
					<label>Req Report Code</label><? echo $form->textField($model,'reportCd'); ?><br/>
					<label>Audit Name</label><? echo $form->dropDownList($model, 'auditorId', array('all'=>'All')+$auditors); ?><br/>
					<label>Schedule Date</label>
					<? echo $form->textField($model,'schStartDate'); ?>
					<input type="button" class="calendar_button" id="schStartDate" value=" " />
					to
					<? echo $form->textField($model,'schEndDate'); ?>
					<input type="button" class="calendar_button" id="schEndDate" value=" " />
					<br />
					<label>Request Status</label><? echo $form->dropDownList($model, 'sts', RequestHeader::getStsDropDown()); ?><br/>
					<label>&nbsp;</label>
					<input class="searchBtn" type="submit" value="" />
				<? $this->endWidget(); ?>

			</li>
		</ul>
		<div class="clear"></div>

		<div id="pagingDiv">
			<? include('schedulePaging.php');?>
		</div>
		
		<div class="remarks">*Audit report can't be assigned / modified when the status is COMPLETE / VERIFY / VOID.</div>
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'criteriaForm',
			'action'=>NULL
			)); ?>
				<? echo $form->hiddenField($model,'itemCount'); ?><br>
				<? echo $form->hiddenField($model,'buyerId'); ?><br>
				<? echo $form->hiddenField($model,'id'); ?><br/>
				<? echo $form->hiddenField($model,'reportCd'); ?><br/>
				<? echo $form->hiddenField($model,'auditorId'); ?><br/>
				<? echo $form->hiddenField($model,'schStartDate'); ?><br/>
				<? echo $form->hiddenField($model,'schEndDate'); ?><br/>
				<? echo $form->hiddenField($model,'schStartDate'); ?><br/>
				<? echo $form->hiddenField($model,'schEndDate'); ?><br/>
				<? echo $form->hiddenField($model,'sts'); ?><br/>
		<? $this->endWidget(); ?>

	</div>

</div>

<script type="text/javascript">
$(function() {
	Calendar.setup({
	    inputField : "ScheduleSearchForm_schStartDate",
	    trigger    : "schStartDate",
	    onSelect   : function() { this.hide() }
	});

	Calendar.setup({
	    inputField : "ScheduleSearchForm_schEndDate",
	    trigger    : "schEndDate",
	    onSelect   : function() { this.hide() }
	});
});
</script>
