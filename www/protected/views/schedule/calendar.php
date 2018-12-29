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
				<form>To add a new request from the check list template, click here!
				<input type="button" alt="calendarCreate?KeepThis=true&TB_iframe=true&height=400&width=520&modal=true" title="" class="createBtn thickbox button" value=""/></form>
			</li>
			<? } ?>
			<li class="row">
				<? echo CHtml::image(Yii::app()->request->baseUrl.'/images/supplier_search.png', 'Calendar Search', array('width'=>'80', 'class'=>'rowpic')); ?>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'checklist_search',
					'action'=>'calendar',
					'method'=>'get',
					'enableAjaxValidation'=>false,
				)); ?>
					<label>Req id</label><? echo $form->textField($model,'id'); ?><br/>
					<label>Template Name</label><? echo $form->textField($model,'template_name'); ?><br/>
					<label>Supplier Name</label><? echo $form->textField($model,'supp_name'); ?><br/>
					<label>Schedule Date</label>
					<? echo $form->textField($model,'sch_start_date'); ?>
					<input type="button" class="calendar_button" id="schStartDate" value=" " />
					to
					<? echo $form->textField($model,'sch_end_date'); ?>
					<input type="button" class="calendar_button" id="schEndDate" value=" " />
					<br />
					<label>&nbsp;</label>
					<input class="searchBtn" type="submit" value="" />
				<? $this->endWidget(); ?>

			</li>
		</ul>
		<div class="clear"></div>

		<div id="pagingDiv">
			<? include('calendarPaging.php');?>
		</div>
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'criteriaForm',
			'action'=>NULL
			)); ?>
				<? echo $form->hiddenField($model,'itemCount'); ?><br>
				<? echo $form->hiddenField($model,'id'); ?><br>
				<? echo $form->hiddenField($model,'template_name'); ?><br/>
				<? echo $form->hiddenField($model,'supp_cd'); ?><br/>
				<? echo $form->hiddenField($model,'sch_start_date'); ?><br/>
				<? echo $form->hiddenField($model,'sch_end_date'); ?> 
		<? $this->endWidget(); ?>

	</div>

</div>

<script type="text/javascript">
$(function() {
	Calendar.setup({
	    inputField : "CalendarSearchForm_sch_start_date",
	    trigger    : "schStartDate",
	    onSelect   : function() { this.hide() }
	});

	Calendar.setup({
	    inputField : "CalendarSearchForm_sch_end_date",
	    trigger    : "schEndDate",
	    onSelect   : function() { this.hide() }
	});
});
</script>
