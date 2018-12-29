<?
$buyers = BuyerInfo::getDropDown();
$auditors = Auditor::getDropDown();
$risks = RequestHeader::getRiskDropDown();
?>

<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jscal2.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jscal2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lang/en.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/search.js"></script>

<div id="content">

	<div id="leftcol"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/report_logo.png'); ?></div>

	<div id="rightcol">


		<ul>
			<li class="row" style="height:130px">
				<? echo CHtml::image(Yii::app()->request->baseUrl.'/images/supplier_search.png', 'Calendar Search', array('width'=>'80', 'class'=>'rowpic')); ?>
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'checklist_search',
					'action'=>'report',
					'method'=>'get',
					'enableAjaxValidation'=>false,
				)); ?>
					<label>Req Report Code</label><? echo $form->textField($model,'reportCd'); ?><br/>
					<label>Buyer CD</label><? echo $form->dropDownList($model, 'buyerId', array('all'=>'All')+$buyers); ?><br/>
					<label>Audit</label><? echo $form->dropDownList($model, 'auditorId', array('all'=>'All')+$auditors); ?><br/>
					<label>Risk Level</label><? echo $form->dropDownList($model, 'riskLvl', $risks); ?><br/>
					<label>Schedule Date</label>
					<? echo $form->textField($model,'schStartDate'); ?>
					<input type="button" class="calendar_button" id="schStartDate" value=" " />
					to
					<? echo $form->textField($model,'schEndDate'); ?>
					<input type="button" class="calendar_button" id="schEndDate" value=" " />
					<br />
					<label>&nbsp;</label>
					<input class="searchBtn" type="submit" value="" />
				<? $this->endWidget(); ?>

			</li>
		</ul>
		<div class="clear"></div>

		<div id="pagingDiv">
			<? include('reportPaging.php');?>
		</div>
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'criteriaForm',
			'action'=>NULL
			)); ?>
				<? echo $form->hiddenField($model,'itemCount'); ?><br>
				<? echo $form->hiddenField($model,'reportCd'); ?><br>
				<? echo $form->hiddenField($model,'buyerId'); ?><br/>
				<? echo $form->hiddenField($model,'auditorId'); ?><br/>
				<? echo $form->hiddenField($model,'riskLvl'); ?><br/>
				<? echo $form->hiddenField($model,'schStartDate'); ?><br/>
				<? echo $form->hiddenField($model,'schEndDate'); ?><br/>
		<? $this->endWidget(); ?>

	</div>

</div>

<script type="text/javascript">
$(function() {
	Calendar.setup({
	    inputField : "ReportSearchForm_schStartDate",
	    trigger    : "schStartDate",
	    onSelect   : function() { this.hide() }
	});

	Calendar.setup({
	    inputField : "ReportSearchForm_schEndDate",
	    trigger    : "schEndDate",
	    onSelect   : function() { this.hide() }
	});
});
</script>
