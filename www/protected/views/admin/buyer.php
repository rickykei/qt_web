<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/search.js"></script>

 
 <div id="content">
	
	<div id="leftcol"><? echo CHtml::image(Yii::app()->baseUrl.'/images/buyermain.png'); ?></div>
	
	<div id="rightcol">
		<? if (isset($success_msg)) {?>
			<div class="successMsg"><?=CHtml::encode($success_msg)?></div>
		<? }?>
		<? if (isset($error_msg)) {?>
			<div class="errorMsg"><?=CHtml::encode($error_msg); ?></div>
		<? }?>
		
		<ul>
		
		<li class="row">
			<? echo CHtml::image(Yii::app()->baseUrl.'/images/supplier_main.png', 'Buyer Maintenance', array('width'=>'80', 'class'=>'rowpic')); ?>
			<form>To add a new buyer, click here!
			<input type="button" alt="buyerCreate?KeepThis=true&TB_iframe=true&height=550&width=550&modal=true" title="" class="createBtn thickbox button" value=""/>
			</form> 
		</li>
		
		<li class="row" style="height:125px">
			<? echo CHtml::image(Yii::app()->request->baseUrl.'/images/supplier_search.png', 'Buyer Search', array('width'=>'80', 'class'=>'rowpic')); ?>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'checklist_search',
				'action'=>'buyer',
				'method'=>'get',
				'enableAjaxValidation'=>false,
			)); ?>
				<label>Area</label><? echo $form->textField($model,'area'); ?><br>
				<label>Name</label><? echo $form->textField($model,'name'); ?><br/>
				<label>Industry</label><? echo $form->textField($model,'industry'); ?><br/>
				<label>Type</label><? echo $form->textField($model,'type'); ?><br/>
				<label>Buyer Code</label><? echo $form->textField($model,'code'); ?> <br/>
				<label>&nbsp;</label><input class="searchBtn" type="submit" value="" />
			<? $this->endWidget(); ?>
			 
		</li>
		</ul>
		<div class="clear"></div>
		
		<div id="pagingDiv">
			<? include('buyerPaging.php');?>
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
