<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style2.css" />

<? $this->widget('ResultMessage', array('msg'=>$msg)); ?>

<? if ($msg == NULL) {?>
	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'form1',
			'action'=>'sectionCompleteSave',
			'enableAjaxValidation'=>false,
		)); ?>
	<? echo CHtml::hiddenField('reqHdrId', $reqHdrId); ?>
	
	<? if ($model->sts != RequestHeader::STS_COMPLETE && $model->sts != RequestHeader::STS_VERIFY) {?>
	Are you sure to complete the audit report?
	<? } else { ?>
	Are you sure to reopen the audit report?
	<? } ?>
	<br><br>
	<input type="submit" name="response" value="Confirm" />
	<input type="submit" name="response" value="Cancel" />
	
	<? $this->endWidget(); ?>
<? } ?>