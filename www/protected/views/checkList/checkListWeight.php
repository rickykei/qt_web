<div id="content">

	<div id="leftcol"><div id="leftcol"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist.png"></div></div>

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'checkListWeight',
		'enableAjaxValidation'=>false,
	)); ?>
	
		<div id="rightcol">
			<? $this->widget('ResultMessage', array('msg'=>$msg)); ?>
			<? echo CHtml::errorSummary($model, '', '', array('class'=>'errorMsg')); ?>
		
			
			<ul>
				<li class="row">
					<img class="rowpic" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist_create.png" width="80"/>
					<div class="rowtext">
						Buyer can simply tick the questions which needs to be included in the checklist.
						[<?=CHtml::encode($model->checkListName) ?>]
					</div>
					
					<input type="hidden" name="action" id="action" />
					<input type="button" id="save" value="Save Weight"  />
					
				</li>
			</ul>
			
			
			<div class="clear"></div>
				<?=$form->hiddenField($model, 'checkListId') ?>
				<?=$form->hiddenField($model, 'checkListName') ?>
				<? //=$form->hiddenField($model, 'checkListVersion') ?>

				<div id="checklist_detail_div">
					<br/>
					<hr>
					<br/>
					<div class="clean"></div>
		
					<table id="checklist_detail_tailor_make_table">
						<tr>
							<td colspan="5" class="checklist_detail_tailor_make_table_title">
								Weight(%)
							</td>
						</tr>
		
						<? 
						if (!empty($cats)) {
							foreach ($cats as $cat) { ?>
								<tr>
									<th>Category</th>
									<th>criteia</th>
									<th>Weight(%)</th>
								</tr>
								<? //var_dump($cat); ?>
							<? foreach ($cat->subcat as $key=>$subcat) { ?>
								<tr>
								<td><?= $key == 0 ? $cat->name : "" ?></td>
								<td><?=$subcat->name ?></td>
								<td><input type="text" name="weight_<?=$cat->id ?>_<?=$subcat->id ?>" value="<?=$weight[$cat->id][$subcat->id] ?>"/></td>
							</tr>
							<? } 
							} // End of $cats
						} // End of !empty ?>
					</table>
				</div>
		</div>
	<? $this->endWidget(); ?>
</div>

<script type="text/javascript">
$(function() {
	$('#save').click(function() {
		$('#form1').submit();
	});
});
</script>