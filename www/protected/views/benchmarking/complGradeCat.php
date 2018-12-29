<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jscal2.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jscal2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lang/en.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/search.js"></script>
 
 <div id="content">
	
	<div id="leftcol"><? echo CHtml::image(Yii::app()->baseUrl.'/images/benchmarking_logo.png'); ?></div>
	
	<div id="rightcol">
		<ul>
 
		<li class="row" style="height:110px">
			<? echo CHtml::image(Yii::app()->request->baseUrl.'/images/supplier_search.png', 'Supplier Search', array('width'=>'80', 'class'=>'rowpic')); ?>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'checklist_search',
				'action'=>'complGradeCat',
				'method'=>'get',
				'enableAjaxValidation'=>false,
			)); ?>
				<label>Type of Enterprise</label><? echo $form->textField($model,'type'); ?><br/>
				<label>Industry</label><? echo $form->textField($model,'industry'); ?><br/>
				<label>Area</label><? echo $form->textField($model,'area'); ?><br>
					
				<label>&nbsp;</label><input class="searchBtn" type="submit" value="" />
			<? $this->endWidget(); ?>			 
		</li>
		</ul>
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'evalForm',
			'action'=>'complGradeCatEval'
			)); ?>
	 
		
		<? if (isset($chartData) && !empty($chartData)) { 
				include('complGradeCatColumnChart.php');
			}
			else if ($action == 'eval') {
				echo "No data for the selected supplier.";
			}
		?>
		
		<div class="clear"></div>
		
		<div id="pagingDiv">
			<? include('supplierPaging.php');?>
		</div><br />
		<label>Time Frame</label>
				<? echo $form->textField($evalCriteriaModel,'startDate'); ?>
				<input type="button" class="calendar_button" id="startDate" value=" " />
				to
				<? echo $form->textField($evalCriteriaModel,'endDate'); ?>
				<input type="button" class="calendar_button" id="endDate" value=" " />
				<?php echo CHtml::imageButton('/images/evaluate.png',array('onclick','goEval()')); ?>
				<br />
		<? $this->endWidget(); ?>
		
		
	</div>

</div>

<script type="text/javascript">
function goEval() {
	$('#evalForm').submit();
}

$(function() {
	Calendar.setup({
	    inputField : "BenchmarkingEvalForm_startDate",
	    trigger    : "startDate",
	    onSelect   : function() { this.hide() }
	});

	Calendar.setup({
	    inputField : "BenchmarkingEvalForm_endDate",
	    trigger    : "endDate",
	    onSelect   : function() { this.hide() }
	});
});
</script>
