<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css" type="text/css" />

<? Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>

<div id="content">

	<div id="leftcol"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist.png"></div>

	<? $this->widget('ResultMessage', array('msg'=>$msg)); ?>
	
	<div id="rightcol">

		<ul>
			<li class="row">
				<img class="rowpic" src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist_create.png" width="80"/>
				Buyer can simply tick the questions which needs to be included in the checklist.
			</li>

		</ul>
		<div class="clear"></div>

<!-- Content -->

		<div id="checklist_detail_div">
		<? foreach ($cats as $cat) {?>
			<table id="checklist_detail_table">
				<tr>
					<td colspan="5" class="checklist_detail_table_cat"  >
						<?=CHtml::encode($cat->name) ?>
						<span style="float: right;"><input id="total_<?=$cat->id ?>" type="text" value="0" reaonly="readonly"/></span>
					</td>
				</tr>
				
				<? foreach ($cat->subcat as $subcat) {
					$name = 'weight_'.$subcat->cat_id.'_'.$subcat->id;
				?>
				<tr class="checklist_detail_table_subcat">
					<td colspan="5">
						<div class="grid_200"><?=CHtml::encode($subcat->name) ?></div>
						<div>
							<input type="text" name="<?=$name ?>" id="<?=$name ?>" value="<?=$weight[$subcat->cat_id][$subcat->id] ?>" size="3"/>
						</div>
						<div id="slider_<?=$name ?>"></div> 
					</td>
				</tr>
				<? }?>
				
			</table>
		<? }?>

		</div>
	</div>

</div>


<script type="text/javascript">
$(function() {
	<? foreach ($cats as $cat) {?>
		<? foreach ($cat->subcat as $subcat) {
			$id = 'weight_'.$subcat->cat_id.'_'.$subcat->id;
		?>
			$( "#slider_<?=$id ?>" ).slider({
				value:0,
				slide: function( event, ui ) {
					$( "#<?=$id ?>" ).val(ui.value);
				},
				stop: function( event, ui) {
					total = 0;
					$('input[name^="weight_<?=$cat->id ?>"]').each(function (index) {
						total = total + $(this).val()*1;
					});
					$('#total_<?=$cat->id ?>').val(total);
				}
			});
	<? }}?>
});
</script>