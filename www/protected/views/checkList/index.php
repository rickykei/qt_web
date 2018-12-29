<div id="content">
	
	<div id="leftcol"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/checklist.png'); ?></div>
	
	<div id="rightcol">
		<? 
		if (isset($msg)) {
			$this->widget('ResultMessage', array('msg'=>$msg)); 
		}
		?>

		<ul>
			<? if (Yii::app()->user->role == 'BUYER') {?>
			<li class="row">
				<div class="rowpic">
					<a href="<?=Yii::app()->request->baseUrl.'/checkList/checkListCreate' ?>"><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/checklist_create.png', "Create Check List", array("width"=>"80")); ?></a>
				</div>
				<div class="rowtext">
				Click here to create a new audit checklist or to amend existing audit checklist.

				</div>
			</li>
			<? }?>


			<li class="row">
				<a class="rowpic" href="<?=Yii::app()->request->baseUrl.'/checkList/checkListSearchPage' ?>" ><? echo CHtml::image(Yii::app()->request->baseUrl.'/images/checklist_search.png', "Search Check List", array("width"=>"80")); ?></a>
				<a class="rowtext">Click here to search for an existing audit check list.
				</a>
			</li>
		</ul>

	</div>
	
</div>
	