<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/buyer/check_list_detail.js"></script>

<div id="content">

	<div id="leftcol"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist.png"></div>

	<div id="rightcol">

		<div>
			<? $this->widget('ResultMessage', array('msg'=>$msg)); ?>

			<? 
			echo CHtml::errorSummary($model,'', '', array('class'=>'errorMsg'));
			?>
			
		</div>
		<ul>
			<li class="row">
				<img class="rowpic" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist_create.png"/>
				Buyer can simply tick the questions which needs to be included in the checklist.
				<br>
				[<?=CHtml::encode($checkListName) ?>] [<?=CHtml::encode($version) ?>]
				<br>
				<form id="form2" method="post" action="checkListCancel">
					<input type="hidden" name="action" id="action" />
					<input type="button" id="save" value="Save Check List"  />
					<input type="button" id="cancel" value="Cancel"/>
				</form>
			</li>

		</ul>
		<div class="clear"></div>

<!-- Content -->
		<div id="checklist_detail_div">
			<table id="checklist_detail_table">
				<tr>
					<td colspan="5" class="checklist_detail_table_cat"  >
						<select name="cat" id="cat">
							<? foreach ($categorys as $category) {?>
								<option value="<?=$category->id ?>"><?=CHtml::encode($category->name) ?></option>
							<? }?>
						</select>
					</td>

				</tr>
				<tr class="checklist_detail_table_subcat">
					<td colspan="5">
						<select name="subcat" id="subcat">
						<? foreach ($subcats as $subcat) {?>
							<option value="<?=$subcat->id ?>"><?=CHtml::encode($subcat->name) ?></option>
						<? }?>
						</select>
					</td>

				</tr>
			</table>
			
			<div id="detail_content">
			<? include("checkListMC.php");?>
			</div>

		</div>
	</div>

</div>
