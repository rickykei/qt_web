<?
$yesNo = array('Y'=>'Yes', 'N'=>'No');
$catIdx = 0;

$isFirstSession = true;
$isFirstChapter = true;
?>

<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; }
.style6 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 12;
}
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; font-weight: bold; }
.style13 {color: #333399; font-weight: bold; font-size: 12px; }
-->
</style>

<? foreach ($cats as $cat) {

	$isFirstChapter = true;
	
	// New page for each section
	if (!$isFirstSession) { ?>
		<br clear=all style='page-break-before:always;mso-break-type:section-break' />
	<? } else {
		$isFirstSession = false;
	 } ?>

<div align="center">
  <table width="700" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="25" colspan="6" bordercolor="#FFFFFF" bgcolor="#333399" class="sectionheader style1" style="color:#FFFFFF"><div align="left" class="style6">SECTION 
          <?=$catIdx + 5 ?> 
          - 
          <?=CHtml::encode($cat->name) ?>
      </div></td>
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
  	
  	// New page for each chapter
  	if (!$isFirstChapter) { ?>
  		
  		</table>
		<br clear=all style='page-break-before:always;mso-break-type:section-break' />
		<table width="700" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
	<? } else {
		$isFirstChapter = false;
	 } ?>
  	
  	<tr bgcolor="#E3E3E3" class="style5">
      <td width="10%" height="45" bordercolor="#333399" bgcolor="#FFFFFF"><div align="left" class="style13">
        <div align="center">Chapter</div>
      </div></td>
      <td height="125" colspan="5" bordercolor="#333399" bgcolor="#FFFFFF"><div align="left" class="style13">
        <div align="center">
          <?=$subcat->name ?>
        </div>
      </div>        <div align="left" class="style13"></div>
      <div align="left" class="style13"></div>        <div align="left" class="style13"></div></td>
    </tr>

<? 	

	$number = 1;
	foreach ($mergeMCAnses as $idx=>$mcAns) {
		if (get_class($mcAns) == 'RequestMcAns') {
			$mc = $mcAns->mc_master;
		}
		else {
  			$mc = $mcAns;
		}
		
		$cssClass = '';
		$isComply = $mcAns->is_comply;
		if ($isComply == 'Y') {
			$cssClass = "pass";
		}
		else if ($isComply == 'N') {
			$cssClass = "fail";
		}
  ?>
    
    <tr bgcolor="#E3E3E3" class="style5">
      <td height="13" bordercolor="#CCCCCC"><strong>Number</strong></td>
      <td width="60%" height="13" colspan="2" bordercolor="#CCCCCC"><strong>Requirements</strong></td>
      <td height="13" bordercolor="#CCCCCC" bgcolor="#E3E3E3"><strong>Risk Level </strong></td>
      <td height="13" colspan="2" bordercolor="#CCCCCC"><strong>Comply</strong></td>
    </tr>
    <tr class="<?=$cssClass ?>">
      <td rowspan="3" bordercolor="#CCCCCC" ><div align="left" class="style5"><?=$number++ ?></div></td>
      <td colspan="2" rowspan="3" bordercolor="#CCCCCC"><div align="left"><span class="style5">
        <?=$mc->question ?>
      </span></div></td>
      <td height="0" bordercolor="#CCCCCC"><div align="left"><span class="style5">
        <?=$mc->riskCode ?>
      </span></div></td>
      <td colspan="2" bordercolor="#CCCCCC"><div align="left"><span class="style5">
      <?=$yesNo[$mcAns->is_comply] ?>
      </span></div>        <div align="left"></div></td>
    </tr>
    <tr>
      <td height="0" colspan="3" bordercolor="#CCCCCC" bgcolor="#E3E3E3" class="style11">Law</td>
    </tr>
    <tr class="<?=$cssClass ?>">
      <td height="0" colspan="3" bordercolor="#CCCCCC"><span class="style5">
        <?=CHtml::encode($mc->law) ?>
      </span></td>
    </tr>
    <tr bgcolor="#E3E3E3" class="style5">
      <td height="25" colspan="3" bordercolor="#CCCCCC"><strong>Photo Evidence 
      </strong>        <div align="left"></div></td>
      <td height="25" colspan="3" bordercolor="#CCCCCC"><strong>Factor Violation Status 
      </strong>
      <div align="left"></div>      <div align="left"></div></td>
    </tr>
    <tr class="<?=$cssClass ?>">
      <td colspan="3" rowspan="3" bordercolor="#CCCCCC"><span class="style5">
        <? if (!empty($mcAns->photo)) {?>
        <img src="<?=$imgPath.$mcAns->photo ?>" />
        <? }?>
      </span>        <div align="left"></div></td>
      <td height="25" colspan="3" bordercolor="#CCCCCC"><span class="style5">
        <?$mcAns->violation_sts ?>
      </span>        <div align="left"></div>      <div align="left"></div></td>
    </tr>
    <tr>
      <td height="25" colspan="3" bordercolor="#CCCCCC" bgcolor="#E3E3E3"><span class="style11">Corrective Action</span>        <div align="left"></div></td>
    </tr>
    <tr class="<?=$cssClass ?>">
      <td height="0" colspan="3" bordercolor="#CCCCCC"><span class="style5">
      <?=$mcAns->action ?>
      </span></td>
    </tr>
    <tr class="<?=$cssClass ?>">
      <td bordercolor="#CCCCCC" bgcolor="#E3E3E3" class="style5"><span class="style11">Completion Date</span></td>
      <td height="25" colspan="2" bordercolor="#CCCCCC"><span class="style5">
      <?=$mcAns->complete_date ?>
      </span></td>
      <td height="25" bordercolor="#CCCCCC" bgcolor="#E3E3E3" class="style5"><span class="style11">Organization Representative</span></td>
      <td height="25" colspan="2" bordercolor="#CCCCCC"><span class="style5">
        <?=$mcAns->org_represent ?>
      </span>        <div align="left"></div></td>
    </tr>
    <tr>
      <td colspan="6" bordercolor="#333399" bgcolor="#333399"><div align="left"></div>        
      <div align="left"></div>        </td>
    </tr>
    <? } // End of MC?>

    <? } // End of subcat ?>
  </table>
</div>
<p align="center"><br>
  <?
	$catIdx++; 
} // End of cat ?>
</p>
<p align="center">&nbsp;</p>
