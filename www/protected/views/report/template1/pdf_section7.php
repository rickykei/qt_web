<?
$options10 = Option10::getDropDownFromCache();
$yesNo = array('Y'=>'Yes', 'N'=>'No');

$certs = $model->req_certification;
?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.style5 {font-size: 9px}
.style6 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style7 {color: #333333}
.style8 {font-size: 9px; color: #333333; }
.style10 {font-size: 11px; color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style14 {font-size: 11px; color: #333333; }
.style15 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}
-->
</style>


<div align="center">
  <table width="700" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="23" colspan="6" bgcolor="#333399" class="sectionheader style1" style="color:#FFFFFF"><div align="left" class="style15">SECTION 
          <?=$lastSection ?>        
      - RELATED CERTIFICATION  </div></td>
    </tr>
    <tr>
      <td colspan="6" bordercolor="#FFFFFF"><div align="left"><span class="style5"><span class="style7"></span></span></div>        <div align="left"><span class="style5"><span class="style7"></span></span></div>        <div align="left"><span class="style5"><span class="style7"></span></span></div>        <div align="left"><span class="style5"><span class="style7"></span></span></div>        <div align="left"><span class="style5"><span class="style7"></span></span></div>        <div align="left"><span class="style5"><span class="style7"></span></span></div></td>
    </tr>
    
    <? for ($i = 0; $i < sizeof($certs); $i+=2) {
  	$j = $i + 1;
  	$cert1 = $certs[$i];
  	$cert2 = $certs[$j];
  	
  	if (empty($cert1->cert_name) && empty($cert2->cert_name)) {
  		continue;
  	}
  ?>
    <tr>
      <td height="25" colspan="3" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style10"><? echo CHtml::encode($cert1->cert_name); ?></div></td>
      <td height="25" colspan="3" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style10"><? echo CHtml::encode($cert2->cert_name); ?></div></td>
    </tr>
    <tr>
      <td colspan="3" bordercolor="#FFFFFF"><div align="left" class="style8"><span class="style6">
        <? if (!empty($cert1->filename)) {?>
        <img src="<?=$imgPath.$cert1->filename ?>" />
        <? }?>
      </span></div></td>
      <td colspan="3" bordercolor="#FFFFFF"><div align="left" class="style8"><span class="style6">
        <? if (!empty($cert2->filename)) {?>
        <img src="<?=$imgPath.$cert2->filename ?>" />
        <? }?>
      </span></div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style10"><div align="left" class="style14"><span class="style10">Comply</span></div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style10"><div align="left" class="style14"><span class="style10">Certification By</span></div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style10"><div align="left" class="style14"><span class="style10">Expiry Date</span></div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style10"><div align="left" class="style14"><span class="style10">Comply</span></div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style10"><div align="left" class="style14"><span class="style10">Certification By</span></div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style10"><div align="left" class="style14"><span class="style10">Expiry Date</span></div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style10"><div align="left" class="style14"><span class="style10">
        <?=$yesNo[$cert1->is_comply] ?>
      </span></div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style10"><div align="left" class="style14"><span class="style10">
        <?=$options10[$cert1->cert_by] ?>
      </span></div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style10"><div align="left" class="style14"><span class="style10">
        <?=$cert1->expiry_date ?>
      </span></div></td>
      
    <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style10"><div align="left" class="style14"><span class="style10">
      <?=$yesNo[$cert2->is_comply] ?>
    </span></div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style10"><div align="left" class="style14"><span class="style10">
        <?=$options10[$cert2->cert_by] ?>
      </span></div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style10"><div align="left" class="style14"><span class="style10">
        <?=$cert2->expiry_date ?>
      </span></div></td>
    </tr>
    <? }?>
    
    <tr>
      <td colspan="3" bordercolor="#FFFFFF"><div align="left"><span class="style5"><span class="style7"></span></span></div></td>
      <td colspan="3" bordercolor="#FFFFFF"><div align="left"><span class="style5"><span class="style7"></span></span></div></td>
    </tr>
  </table>
</div>
