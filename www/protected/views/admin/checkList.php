<?
$buyers = BuyerInfo::getDropDown(); 
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jscal2.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jscal2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lang/en.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/search.js"></script>

 <div id="content">
	
	<div id="leftcol"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/checklist.png'); ?></div>
	
	<div id="rightcol">
	
		
		<ul>
		
		<li class="row" style="height:145px">
			<? echo CHtml::image(Yii::app()->request->baseUrl.'/images/checklist_search.png', '', array('class'=>'rowpic', 'width'=>'80')); ?>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'checklist_search',
				'action'=>'checkList',
				'method'=>'get',
				'enableAjaxValidation'=>false,
			)); ?>
				<label>Buyer Code</label><? echo $form->dropDownList($model, 'buyerId', array('all'=>'All')+$buyers); ?><br/>
				<label>Checklist Name</label><? echo $form->textField($model,'checkListName'); ?><br/>
				<label>Establish Date</label><? echo $form->textField($model,'establishDateFrom'); ?>
				<input type="button" class="calendar_button" id="establishDateFromBtn" value=" " />
				to
				<? echo $form->textField($model,'establishDateTo'); ?>
				<input type="button" class="calendar_button" id="establishDateToBtn" value=" " />
				<br/>
				<label>Version</label><? echo $form->textField($model,'version'); ?><br/>
				<label>Create By</label><? echo $form->textField($model,'createBy'); ?><br/>
				<label>Status</label><? echo $form->dropdownlist($model, 'sts', array('all'=>'All', 'A'=>'Active', 'I'=>'Inactive')); ?><br/>
				<label>&nbsp;</label><input class="searchBtn" type="submit" value="" />
			<? $this->endWidget(); ?>
			 
		</li>
		</ul>
		<div class="clear"></div>
	
		<div id="pagingDiv">
			<? include('checkListPaging.php');?>
		</div>
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'criteriaForm',
			'action'=>NULL
			)); ?>
				<? echo $form->hiddenField($model,'itemCount'); ?><br>
				<? echo $form->hiddenField($model,'buyerId'); ?><br>
				<? echo $form->hiddenField($model,'checkListName'); ?><br/>
				<? echo $form->hiddenField($model,'establishDateFrom'); ?><br/>
				<? echo $form->hiddenField($model,'establishDateTo'); ?><br/>
				<? echo $form->hiddenField($model,'version'); ?><br/>
				<? echo $form->hiddenField($model,'createBy'); ?><br/>
				<? echo $form->hiddenField($model,'sts'); ?> 
		<? $this->endWidget(); ?>
	 
	</div>

</div>

<script type="text/javascript">
$(function() {
	Calendar.setup({
	    inputField : "CheckListSearchForm_establishDateFrom",
	    trigger    : "establishDateFromBtn",
	    onSelect   : function() { this.hide() }
	});

	Calendar.setup({
	    inputField : "CheckListSearchForm_establishDateTo",
	    trigger    : "establishDateToBtn",
	    onSelect   : function() { this.hide() }
	});
});
</script>
