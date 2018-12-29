<?
$yesNo = array('Y'=>'Yes', 'N'=>'No');
$catIdx = 0;
?>

<? foreach ($cats as $cat) {?>
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
  	if (isset($msAnses[$cat->id][$subcat->id])) {
  		foreach ($msAnses[$cat->id][$subcat->id] as $idx=>$mcAns) {
  			$mc = $mcAns->mc_master;
  ?>
    <tr bgcolor="#E3E3E3" class="style5">
      <td width="67" height="45" bordercolor="#333399" bgcolor="#FFFFFF"><div align="left" class="style13">
        <div align="center">Chapter</div>
      </div></td>
      <td height="125" colspan="5" bordercolor="#333399" bgcolor="#FFFFFF"><div align="left" class="style13">
        <div align="center">
          <?=$subcat->name ?>
        </div>
      </div>        <div align="left" class="style13"></div>
      <div align="left" class="style13"></div>        <div align="left" class="style13"></div></td>
    </tr>
    <tr bgcolor="#E3E3E3" class="style5">
      <td height="13" bordercolor="#CCCCCC"><strong>Number</strong></td>
      <td height="13" colspan="2" bordercolor="#CCCCCC"><strong>Requirements</strong></td>
      <td width="166" height="13" bordercolor="#CCCCCC" bgcolor="#E3E3E3"><strong>Risk Level </strong></td>
      <td height="13" colspan="2" bordercolor="#CCCCCC"><strong>Comply</strong></td>
    </tr>
    <tr>
      <td rowspan="3" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><div align="left"></div></td>
      <td colspan="2" rowspan="3" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><div align="left"><span class="style5">
        <?=$mc->question ?>
      </span></div></td>
      <td height="0" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><div align="left"><span class="style5">
        <?=$mc->riskCode ?>
      </span></div></td>
      <td colspan="2" bordercolor="#CCCCCC"><div align="left"><span class="style5">
      <?=$yesNo[$mcAns->is_comply] ?>
      </span></div>        <div align="left"></div></td>
    </tr>
    <tr>
      <td height="0" colspan="3" bordercolor="#CCCCCC" bgcolor="#E3E3E3" class="style11">Law</td>
    </tr>
    <tr>
      <td height="0" colspan="3" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><span class="style5">
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
    <tr>
      <td colspan="3" rowspan="3" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><span class="style5">
        <? if (!empty($mcAns->photo)) {?>
        <img src="<?=$imgPath.$mcAns->photo ?>" />
        <? }?>
      </span>        <div align="left"></div></td>
      <td height="25" colspan="3" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><span class="style5">
        <?$mcAns->violation_sts ?>
      </span>        <div align="left"></div>      <div align="left"></div></td>
    </tr>
    <tr>
      <td height="25" colspan="3" bordercolor="#CCCCCC" bgcolor="#E3E3E3"><span class="style11">Corrective Action</span>        <div align="left"></div></td>
    </tr>
    <tr>
      <td height="0" colspan="3" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><span class="style5">
      <?=$mcAns->action ?>
      </span></td>
    </tr>
    <tr>
      <td bordercolor="#CCCCCC" bgcolor="#E3E3E3" class="style5"><span class="style11">Completion Date</span></td>
      <td height="25" colspan="2" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><span class="style5">
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
    <? }} // End of MC?>
    
    <?
  if (isset($handMakeMcAnses[$cat->id][$subcat->id])) { 
  	foreach ($handMakeMcAnses[$cat->id][$subcat->id] as $idx=>$mcAns) {
  ?>
    <tr bgcolor="#E3E3E3">
      <td height="25" bordercolor="#CCCCCC"><div align="left"><span class="style5">Chapter</span></div></td>
      <td height="25" colspan="2" bordercolor="#CCCCCC"><div align="left"><span class="style5">Requirements</span></div></td>
      <td height="25" bordercolor="#CCCCCC"><div align="left"><span class="style5">Comply</span></div></td>
      <td width="54" height="25" bordercolor="#CCCCCC"><div align="left"><span class="style5">Photos </span></div></td>
      <td width="128" height="25" bordercolor="#CCCCCC"><div align="left"><span class="style5">Factor Violation Status</span></div></td>
    </tr>
    <tr>
      <td height="25" rowspan="5" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><div align="left"><span class="style5">
        <?=$subcat->name ?>
      </span></div></td>
      <td height="25" colspan="2" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><div align="left"><span class="style5">
        <?=$mcAns->question ?>
      </span></div></td>
      <td height="25" rowspan="5" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><div align="left"><span class="style5">
        <?=$yesNo[$mcAns->is_comply] ?>
      </span></div></td>
      <td bordercolor="#CCCCCC"><div align="left"><span class="style5">
        <? if (!empty($mcAns->photo)) {?>
        <img src="<?=$imgPath.$mcAns->photo ?>" />
        <? }?>
      </span></div></td>
      <td height="25" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><div align="left"><span class="style5">
        <?=$mcAns->violation_sts ?>
      </span></div></td>
    </tr>
    <tr>
      <td width="147" height="25" rowspan="2" bordercolor="#CCCCCC" bgcolor="#E3E3E3"><div align="left"><span class="style5">Risk Level</span></div></td>
      <td width="100" height="25" rowspan="2" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><div align="left"><span class="style5">
        <?=$mcAns->riskCode ?>
      </span></div></td>
      <td height="25" bordercolor="#CCCCCC" bgcolor="#E3E3E3"><div align="left"><span class="style5">Corrective Action</span></div></td>
      <td height="25" bordercolor="#CCCCCC" bgcolor="#E3E3E3"><div align="left"><span class="style5">Organization Representative</span></div></td>
    </tr>
    <tr>
      <td height="25" rowspan="3" bordercolor="#CCCCCC"><div align="left"><span class="style5">
        <?=$mcAns->action ?>
      </span></div></td>
      <td height="25" bordercolor="#CCCCCC"><div align="left"><span class="style5">
        <?=$mcAns->org_represent ?>
      </span></div></td>
    </tr>
    <tr>
      <td height="25" rowspan="2" bordercolor="#CCCCCC" bgcolor="#E3E3E3"><div align="left"><span class="style5">LAW</span></div></td>
      <td height="25" rowspan="2" bordercolor="#CCCCCC" bgcolor="#FFFFFF"><div align="left"><span class="style5">
        <?=CHtml::encode($mcAns->law) ?>
      </span></div></td>
      <td height="25" bordercolor="#CCCCCC" bgcolor="#E3E3E3"><div align="left"><span class="style5">Completion Date</span></div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#CCCCCC"><div align="left"><span class="style5">
        <?=$mcAns->complete_date ?>
      </span></div></td>
    </tr>
    <? }} // End of Hand Make MC?>
    
    <? } // End of subcat ?>
  </table>
</div>
<p align="center"><br>
  <?
	$catIdx++; 
} // End of cat ?>
</p>
<p align="center">&nbsp;</p>
