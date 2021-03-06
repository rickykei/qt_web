<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/search.js"></script>
 
 <div id="content">
	
	<div id="leftcol"><? echo CHtml::image(Yii::app()->baseUrl.'/images/user-icon.png'); ?></div>
	
	<div id="rightcol">
		
		<ul>
		<li class="row">
			<? echo CHtml::image(Yii::app()->baseUrl.'/images/supplier_main.png', 'User Account Maintenance', array('width'=>'80', 'class'=>'rowpic')); ?>
			<form>To add a new user account, click here!
			<input type="button" alt="userAccCreate?KeepThis=true&TB_iframe=true&height=450&width=530&modal=true" title="" class="createBtn thickbox button" value=""/>
			</form> 
		</li>
		<li class="row">
			<? echo CHtml::image(Yii::app()->request->baseUrl.'/images/supplier_search.png', 'User Account Search', array('width'=>'80', 'class'=>'rowpic')); ?>
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'checklist_search',
				'action'=>'userAcc',
				'method'=>'get',
				'enableAjaxValidation'=>false,
			)); ?>
				<label>User Name</label><? echo $form->textField($model,'name'); ?><br>
				<label>Role</label><? echo $form->dropdownlist($model, 'role', array_merge(array('all'=>'All'), User::getRoleDropDown())); ?><br/> 
				<label>Status</label><? echo $form->dropdownlist($model, 'sts', array('all'=>'All', 'A'=>'Active', 'I'=>'Inactive')); ?><br/>
				<label>&nbsp;</label><input class="searchBtn" type="submit" value="" />
			<? $this->endWidget(); ?>
			 
		</li>
		</ul>
		<div class="clear"></div>
		
		<div id="pagingDiv">
			<? include('userAccPaging.php');?>
		</div>
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'criteriaForm',
			'action'=>NULL
			)); ?>
				<? echo $form->hiddenField($model,'itemCount'); ?><br>
				<? echo $form->hiddenField($model,'name'); ?><br>
				<? echo $form->hiddenField($model,'role'); ?><br/>
				<? echo $form->hiddenField($model,'sts'); ?><br/>
		<? $this->endWidget(); ?>
	</div>

</div>
