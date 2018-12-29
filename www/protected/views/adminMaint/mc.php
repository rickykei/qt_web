<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/search.js"></script>
 
 <div id="content">
	
	<div id="leftcol"><? echo CHtml::image(Yii::app()->baseUrl.'/images/schedulinglogo.png'); ?></div>
	
	<div id="rightcol">
		
		<ul>

		<li class="row">
			<? echo CHtml::image(Yii::app()->request->baseUrl.'/images/supplier_search.png', 'User Account Search', array('width'=>'80', 'class'=>'rowpic')); ?>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'checklist_search',
				'action'=>'userAcc',
				'method'=>'get',
				'enableAjaxValidation'=>false,
			)); ?>
				<label>Category</label><br>
				<label>Sub Category</label><br/> 
				<label>Question</label>
				<input class="button" type="submit" id="searchBtn" value="search"/>
			<? $this->endWidget(); ?>
			 
		</li>
		</ul>
		<div class="clear"></div>
		
		<div id="pagingDiv">
			<? include('mcPaging.php');?>
		</div>
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'criteriaForm',
			'action'=>NULL
			)); ?>
				<? echo $form->hiddenField($model,'itemCount'); ?><br>
				<? echo $form->hiddenField($model,'catId'); ?><br>
				<? echo $form->hiddenField($model,'subCatId'); ?><br/>
				<? echo $form->hiddenField($model,'question'); ?><br/>
				<? echo $form->hiddenField($model,'risk'); ?><br/>
				<? echo $form->hiddenField($model,'photo'); ?><br/>
				<? echo $form->hiddenField($model,'law'); ?><br/>
		<? $this->endWidget(); ?>
	</div>

</div>
