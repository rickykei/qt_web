
<? $this->widget('ResultMessage', array('msg'=>$msg)); ?>

<? 
if (isset($model)) {
	echo CHtml::errorSummary($model,'', '', array('class'=>'errorMsg'));
} ?>

<div class="clear"></div>

<div id="thickbox_form">
	<input type="button" value="Close" onclick="self.parent.tb_remove();self.parent.location.reload();"/>
</div>
