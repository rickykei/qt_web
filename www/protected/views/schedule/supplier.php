<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/search.js"></script>

 
 <div id="content">
	
	<div id="leftcol"><? echo CHtml::image(Yii::app()->baseUrl.'/images/schedulinglogo.png'); ?></div>
	
	<div id="rightcol">
		<? if (isset($success_msg)) {?>
			<div class="successMsg"><?=CHtml::encode($success_msg)?></div>
		<? }?>
		<? if (isset($error_msg)) {?>
			<div class="errorMsg"><?=CHtml::encode($error_msg); ?></div>
		<? }?>
		
		<ul>
		
		<? if (Yii::app()->user->role == 'BUYER') {?>
		<li class="row">
			<? echo CHtml::image(Yii::app()->baseUrl.'/images/supplier_main.png', 'Supplier Maintenance', array('width'=>'80', 'class'=>'rowpic')); ?>
			<form>To add a new supplier onto the list, click here!
			<input type="button" alt="supplierCreate?KeepThis=true&TB_iframe=true&height=450&width=530&modal=true" title="" class="createBtn thickbox button" value=""/>
			</form> 
		</li>
		<? }?>
		
		<li class="row" style="height:120px">
			<? echo CHtml::image(Yii::app()->request->baseUrl.'/images/supplier_search.png', 'Supplier Search', array('width'=>'80', 'class'=>'rowpic')); ?>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'checklist_search',
				'action'=>'supplier',
				'method'=>'get',
				'enableAjaxValidation'=>false,
			)); ?>
				<label>Area</label><? echo $form->textField($model,'area'); ?><br>
				<label>Name</label><? echo $form->textField($model,'name'); ?><br/>
				<label>Industry</label><? echo $form->textField($model,'industry'); ?><br/>
				<label>Type</label><? echo $form->textField($model,'type'); ?><br/>
				<label>Supplier Code</label><? echo $form->textField($model,'code'); ?><br/>
				<label>&nbsp;</label><input class="searchBtn" type="submit" value="" />
			<? $this->endWidget(); ?>
			 
		</li>
		</ul>
		<div class="clear"></div>
		
		<div id="pagingDiv">
			<? include('supplierPaging.php');?>
		</div>
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'criteriaForm',
			'action'=>NULL
			)); ?>
				<? echo $form->hiddenField($model,'itemCount'); ?><br>
				<? echo $form->hiddenField($model,'area'); ?><br>
				<? echo $form->hiddenField($model,'name'); ?><br/>
				<? echo $form->hiddenField($model,'industry'); ?><br/>
				<? echo $form->hiddenField($model,'type'); ?><br/>
				<? echo $form->hiddenField($model,'code'); ?> 
		<? $this->endWidget(); ?>
	</div>

</div>
