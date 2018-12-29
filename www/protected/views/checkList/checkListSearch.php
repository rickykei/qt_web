<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jscal2.css" />

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jscal2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lang/en.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/search.js"></script>

 <div id="content">
	
	<div id="leftcol"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/checklist.png'); ?></div>
	
	<div id="rightcol">
	
		
		<ul>
		
		<li class="row">
			<? echo CHtml::image(Yii::app()->request->baseUrl.'/images/checklist_search.png', '', array('class'=>'rowpic', '')); ?>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'checklist_search',
				'action'=>'checkListSearchPage',
				'method'=>'get',
				'enableAjaxValidation'=>false,
			)); ?>
				<label>Checklist Name</label><? echo $form->textField($model,'check_list_name'); ?><br/>
				<label>Establish Date</label><? echo $form->textField($model,'establish_date_from'); ?>
				<input type="button" class="calendar_button" id="establishDateFromBtn" value=" " />
				to
				<? echo $form->textField($model,'establish_date_to'); ?>
				<input type="button" class="calendar_button" id="establishDateToBtn" value=" " />
				<br/>
				<label>Create By</label><? echo $form->textField($model,'create_by'); ?><br/>
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
				<? echo $form->hiddenField($model,'check_list_name'); ?><br>
				<? echo $form->hiddenField($model,'establish_date_from'); ?><br/>
				<? echo $form->hiddenField($model,'establish_date_to'); ?><br/>
				<? echo $form->hiddenField($model,'create_by'); ?><br/>
				<? echo $form->hiddenField($model,'sts'); ?> 
		<? $this->endWidget(); ?>
	 
	</div>

</div>

<script type="text/javascript">
$(function() {
	Calendar.setup({
	    inputField : "CheckListSearchForm_establish_date_from",
	    trigger    : "establishDateFromBtn",
	    onSelect   : function() { this.hide() }
	});

	Calendar.setup({
	    inputField : "CheckListSearchForm_establish_date_to",
	    trigger    : "establishDateToBtn",
	    onSelect   : function() { this.hide() }
	});
});
</script>
