<? 

function numberFormat($val) {
	return number_format(round($val, 1), 1);
}
?>

<style type="text/css">
.title1 {
	color: #333399;
	font-family: Verdana;
	font-size:26pt;
	text-align:center;
	font-weight: bold;
}

.pass {
	background:#99CCFF;
}

.fail {
	background:red;
	color:white;
}

.risk {
color:red;
}

.highlight {
color:#3366FF;
}
.style1 {font-family: Verdana}
.style2 {
	font-size: 9px;
	font-weight: bold;
}
.style15 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; font-size: 11px; }
.style17 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; }
.style19 {font-size: 10px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style20 {
	color: #333399;
	font-weight: bold;
}
.style44 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #000000; font-size: 11px; font-weight: bold; }
.style46 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #333333; font-size: 11px; font-weight: bold; }
.style48 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10.5px; color: #000000; }
.style50 {font-size: 12px; font-weight: bold; }
.style54 {font-size: 11px; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style55 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style56 {color: #000000; font-size: 11px;}
</style>

<div align="center">
  <table width="650" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="64" valign="top"><h1 class="style19">Vendor: </h1></td>
      <td width="236" valign="top"><p class="style19">
        <?=$model->supplier->name ?>
      </p></td>
      <td width="60" valign="top"><h1 class="style19">Auditor:</h1></td>
      <td width="146" valign="top"><p class="style19">
        <?=$model->auditor->name ?>
      </p></td>
      <td width="78" valign="top"><h1 class="style19">Audit Date: </h1></td>
      <td width="116" valign="top"><p class="style19">
        <?=$model->complete_date != NULL ? strftime("%d-%m-%Y", strtotime($model->complete_date)) : ''?>
      </p></td>
    </tr>
  </table>
  <table width="650" height="3%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <th height="17" scope="col"><span class="style20">______________________________________________________________________________________</span></th>
    </tr>
  </table>
  <p>&nbsp;</p>
</div>
<p align="center" class="title1">&nbsp;</p>
<p class="title1">Compliance Audit Report</p>
<p class="title1">&nbsp;</p>
<p class="title1">&nbsp;</p>
<div align="center">
  <table width="703" border="1" cellpadding="0" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="25" colspan="5" bordercolor="#333399" bgcolor="#333399" class="sectionheader style1 style2" style="color:#FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif;"><p class="style50">AUDIT CONCLUSION </p></td>
    </tr>
    
    <tr bgcolor="#CCCCCC" align="center" style="font-weight: bold;">
      <td width="168" height="25" bordercolor="#333399" class="style15"><span class="style48">COMPLIANCE FIELD</span></td>
        <td width="68" height="25" bordercolor="#333399" class="style15"><span class="style48">RESULT</span></td>
        <td width="157" height="25" bordercolor="#333399" class="style15"><span class="style48">WEIGHTED SCORE</span></td>
        <td width="190" height="25" bordercolor="#333399" class="style15"><span class="style48">CRITICAL RISK FOUND</span></td>
        <td width="108" height="25" bordercolor="#333399" class="style15"><span class="style48">RISK LEVEL</span></td>
    </tr>
    
  <?
$totalScore = 0; 
$totalCriticalRisk = 0;
$allResult = true;
$allRisk = true;
if (!empty($overview)) {
foreach ($overview as $idx=>$item) {
	$weightScore = $item['weight_score'];
	$criticalRisk = $item['critical_risk'];

	$totalScore += numberFormat($weightScore);
	$totalCriticalRisk += $criticalRisk;
	$subCat = reset($subView[$idx]);
	
	if ($criticalRisk > 0) {
		$allResult = false;
		$result = 'Fail';
		$resultStyle = 'fail';
	}
	else {
		$result = 'Pass';
		$resultStyle = 'pass';
	}
	
	if ($criticalRisk > 0) {
		$allRisk = false;
		$riskLvl = 'High';
		$riskStyle = 'fail';
	}
	else {
		$riskLvl = 'Low';
		$riskStyle = 'pass';
	}
?>
    <tr align="center">
      <td height="25" align="left" bordercolor="#333399"><div align="left"><span class="style17">
        <?=$subCat['cat_name'] ?>
      </span></div></td>
        <td height="25" bordercolor="#333399" class="<?=$resultStyle ?>"><span class="style54">
          <?=$result ?>
        </span></td>
        <td height="25" bordercolor="#333399"><span class="style17">
        <?=numberFormat($weightScore) ?>
        </span></td>
        <td height="25" bordercolor="#333399"><span class="style46">
        <?=$criticalRisk?>
        </span></td>
        <td height="25" bordercolor="#333399" class="<?=$riskStyle ?>"><span class="style54">
          <?=$riskLvl ?>
        </span></td>
    </tr>
 <? }} // End of if (!empty($overview))?>
    <tr align="center">
      <td height="25" align="left" bordercolor="#333399" bgcolor="#CCCCCC"><p align="left" class="style55"><span class="style56">AVERAGE TOTAL </span></p></td>
        <td height="25" bordercolor="#333399" bgcolor="#CCCCCC" class="<?=$allResult?'pass':'fail' ?>"><span class="style54">
          <?=$allResult? 'Pass':'Fail' ?>
        </span></td>
        <td height="25" bordercolor="#333399" bgcolor="#CCCCCC"><span class="style15">
        <?=count($overview) != 0 ? numberFormat($totalScore / count($overview)) : 0 ?>
        </span></td>
        <td height="25" bordercolor="#333399" bgcolor="#CCCCCC"><span class="style44">
        <?=$totalCriticalRisk ?>
        </span></td>
        <td height="25" bordercolor="#333399" bgcolor="#CCCCCC" class="<?=$allRisk?'pass':'fail' ?>"><span class="style54">
          <?=$allRisk? 'Low':'High'?>
        </span></td>
    </tr>
  </table>
</div>
<p align="center">&nbsp;</p>

<div align="center">
  <table width="700" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="25" colspan="5" bordercolor="#333399" bgcolor="#333399" class="style50" style="color:#FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif;"><p>OVERVIEW OF AUDIT FINDINGS </p></td>
    </tr>
    <? 
if (!empty($subView)) {
foreach ($subView as $idx=>$cat) { ?>
    <tr bgcolor="#CCCCCC" align="center" style="font-weight: bold;">
      <td height="25" bordercolor="#3333CC"><span class="style15">Field</span></td>
      <td height="25" bordercolor="#3333CC"><span class="style15">Criteria</span></td>
      <td height="25" bordercolor="#3333CC"><span class="style15">Actual Score</span></td>
      <td height="25" bordercolor="#3333CC"><span class="style15">Weight (%)</span></td>
      <td height="25" bordercolor="#3333CC"><span class="style15">Weighted Score</span></td>
    </tr>
    <?
    $isFirst = true; 
    foreach ($cat as $subcat) {?>
    <tr align="center">
      <? if ($isFirst) {
    		$isFirst = false;
    	?>
      <td height="22" rowspan="<?=sizeof($cat) ?>" align="left" valign="top" bordercolor="#CCCCCC"><span class="style17">
        <?=$subcat['cat_name']?>
      </span></td>
      <? }?>
      <td height="22" align="left" bordercolor="#CCCCCC"><span class="style17">
        <?=$subcat['subcat_name']?>
      </span></td>
      <td height="22" bordercolor="#CCCCCC"><span class="style17">
        <?=$subcat['score'].'/'.$subcat['total'] ?>
      </span></td>
      <td height="22" bordercolor="#CCCCCC" ><span class="style17">
        <?=numberFormat($subcat['weight'])?>
        %</span></td>
      <td height="22" bordercolor="#CCCCCC" ><span class="style17">
        <?=numberFormat($subcat['weight_score']) ?>
      </span></td>
    </tr>
    <? }?>
    <tr align="center">
      <td height="25" colspan="2" align="right" bordercolor="#333399" bgcolor="#CCCCCC"><span class="style44">Max. Total</span></td>
      <td height="25" bordercolor="#333399" bgcolor="#E6E6E6" ><span class="style46">
        <?=$overview[$idx]['total']?>
      </span></td>
      <td height="25" bordercolor="#333399" bgcolor="#E6E6E6" ><span class="style46">100%</span></td>
      <td height="25" bordercolor="#333399" bgcolor="#E6E6E6" ><span class="style46">100</span></td>
    </tr>
    <tr align="center">
      <td height="25" colspan="2" align="right" bordercolor="#333399" bgcolor="#CCCCCC"><span class="style44">Final Score</span></td>
      <td height="25" bordercolor="#333399" bgcolor="#E6E6E6"><span class="style46">
        <?=$overview[$idx]['score']?>
      </span></td>
      <td height="25" align="center" bordercolor="#333399" bgcolor="#E6E6E6"><span class="style46">
        <?=numberFormat($overview[$idx]['weight_score'])?>
        %</span></td>
      <td height="25" align="center" bordercolor="#333399" bgcolor="#E6E6E6"><span class="style46">
        <?=numberFormat($overview[$idx]['weight_score'])?>
      </span></td>
    </tr>
    <? }} ?>
  </table>
</div>
