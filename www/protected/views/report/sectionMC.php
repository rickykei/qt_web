<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jscal2.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jscal2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lang/en.js"></script>

<?
$yesNo = array(''=> '', 'Y'=>'Yes', 'N'=>'No');
?>

<? 
foreach($mcAnses as $item) {
	foreach ($item as $subItem) {
		foreach ($subItem as $mcAns) {
			echo CHtml::errorSummary($mcAns, '', '', array('class'=>'errorMsg'));
		}
	}
}

foreach($handMakeMcAnses as $item) {
	foreach ($item as $subItem) {
		foreach ($subItem as $mcAns) {
			echo CHtml::errorSummary($mcAns, '', '', array('class'=>'errorMsg'));
		}
	}
}
?>

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'form1',
		'action'=>'sectionMCSave',
		'enableAjaxValidation'=>false,
	)); ?>

<? echo CHtml::hiddenField('reqHdrId', $reqHdrId); ?>

<? 
$mcIdx = 0;
$catIdx = 0;

$mcIdxAry = array();
$handMcIdxAry = array();

foreach ($cats as $cat) {?>
<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="6" bgcolor="#000099" class="sectionheader">SECTION <?=$catIdx + 5 ?> - <?=CHtml::encode($cat->name) ?></td>
  </tr>


  <? foreach ($subcats[$cat->id] as $subcat) {
  	
  	// Merge MCs
  	$mergeMCAnses = array();
  	if (isset($mcAnses[$cat->id][$subcat->id])) {
  		foreach ($mcAnses[$cat->id][$subcat->id] as $mc) { 
  			$mergeMCAnses[] = $mc;
  		}
  	}
  	if (isset($handMakeMcAnses[$cat->id][$subcat->id])) {
  		foreach ($handMakeMcAnses[$cat->id][$subcat->id] as $mc) {
  			$mergeMCAnses[] = $mc;
  		}
  	}
  	

  		foreach ($mergeMCAnses as $mcAns) {
  			
  			if (get_class($mcAns) == 'RequestMcAns') {
  				$mc = $mcAns->mc_master;
  				$mcIdxAry[] = $mcIdx;
  			}
  			else {
  				$mc = $mcAns;
  				$handMcIdxAry[] = $mcIdx;
  			}
  			
  			$isComply = $mcAns->is_comply;

  ?>
  <tr>
    <td bgcolor="#CCCCCC">Chapter</td>
    <td colspan="2" bgcolor="#CCCCCC">Requirements</td>
    <td bgcolor="#CCCCCC">Comply</td>
    <td bgcolor="#CCCCCC">Photos </td>
    <td bgcolor="#CCCCCC">Factor Violation Status</td>
  </tr>
  <tr>
    <td rowspan="5"><?=CHtml::encode($subcat->name) ?></td>
    <td colspan="2"><?=CHtml::encode($mc->question) ?></td>
    <td rowspan="5"><? echo $form->dropDownList($mcAns, '['.$mcIdx.']is_comply', $yesNo); ?></td>
    <td>
    	<div <? if ($isComply != 'N') echo 'style="display:none"' ?>>
    		filename: <? echo $form->textField($mcAns, '['.$mcIdx.']photo'); ?>
    	</div>
    </td>
    <td><? echo $form->textArea($mcAns, '['.$mcIdx.']violation_sts', array('cols'=>30, 'rows'=>5)); ?></td>
  </tr>
  <tr>
    <td rowspan="2" bgcolor="#CCCCCC">Risk Level</td>
    <td rowspan="2"><?=$mc->riskCode ?></td>
    <td bgcolor="#CCCCCC">Corrective Action</td>
    <td bgcolor="#CCCCCC">Organization Representative</td>
  </tr>
  <tr>
    <td rowspan="3"><? echo $form->textArea($mcAns, '['.$mcIdx.']action', array('cols'=>50, 'rows'=>8)); ?></td>
    <td><? echo $form->textField($mcAns, '['.$mcIdx.']org_represent'); ?></td>
  </tr>
  <tr>
    <td rowspan="2" bgcolor="#CCCCCC">LAW</td>
    <td rowspan="2"><?=CHtml::encode($mc->law) ?></td>
    <td bgcolor="#CCCCCC">Completion Date</td>
  </tr>
  <tr>
    <td>
    	<? echo $form->textField($mcAns, '['.$mcIdx.']complete_date', array('readonly'=>'readonly')); ?>
		<input type="button" class="calendar_button" id="completeDateBtn_<?=$mcIdx ?>" value=" " />

    	<? if (get_class($mcAns) == 'RequestMcAns') {
    		echo $form->hiddenField($mcAns, '['.$mcIdx.']mc_master_id'); 
  		} else {
  			echo $form->hiddenField($mcAns, '['.$mcIdx.']hand_make_tmpl_id');
  		}?>
    	<? echo $form->hiddenField($mcAns, '['.$mcIdx.']id'); ?>
    </td>
  </tr>
  <? $mcIdx++; } // End of MC?>
  
  <? } // End of subcat ?>
</table>
<br><br>
<?
	$catIdx++; 
} // End of cat ?>


<? if ($model->sts != RequestHeader::STS_COMPLETE) {?>
<input type="button" value="Save" onclick="goClick()"/>
<? }?>

<? $this->endWidget(); ?>

<script type="text/javascript">

$(function() {
	$('select[name$="[is_comply]"]').change(function() {
		var photoElem = $(this).parent().next().children(':first-child');
		if ($(this).val() != 'N') {
			// Hide photo field
			photoElem.hide();
		}
		else {
			photoElem.show();
		}
	});

	// Calendar (Complete Date)
<?	foreach ($mcIdxAry as $i) { 
		?>
			Calendar.setup({
			    inputField : "RequestMcAns_<?=$i ?>_complete_date",
			    trigger    : "completeDateBtn_<?=$i ?>",
			    onSelect   : function() { this.hide() }
			});
<?	}
		
	foreach ($handMcIdxAry as $i) {
		?>
			Calendar.setup({
			    inputField : "RequestMcHandMakeForm_<?=$i ?>_complete_date",
			    trigger    : "completeDateBtn_<?=$i ?>",
			    onSelect   : function() { this.hide() }
			});
	<? } ?>

});

function goClick() {
	var isPhotoValid = true;
	$('select[name$="[is_comply]"]').each(function (key, value) {
		var photoElem = $(this).parent().next().children(':first-child').children('input[name$="[photo]"]');
		if ($(this).val() == 'N') {
			if (photoElem.val() == '') {
				photoElem.addClass('error');
				isPhotoValid = false;
			}
			else {
				photoElem.removeClass('error');
			}
		} 
		else {
			photoElem.removeClass('error');
		}
	});

	if (!isPhotoValid) {
		alert('The filename of photo should be filled in if the requirement is not complied');
	}
	else {
		document.forms[0].submit();
	}
}
</script>