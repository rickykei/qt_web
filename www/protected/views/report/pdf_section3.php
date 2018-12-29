<?
$options3 = Option3::getDropDownFromCache();
$options8 = Option8::getDropDownFromCache();
$options9 = Option9::getDropDownFromCache();
$options11 = Option11::getDropDownFromCache();
$yesNo = array('Y'=>'Yes', 'N'=>'No');

$publicPowerSupply = $model->req_public_power_supply;
$transCapTrunck = $model->req_trans_capability_trunck;
$transCapMiniVan = $model->req_trans_capability_minivan;
?>
<style type="text/css">
<!--
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12; }
.style7 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.style11 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style12 {
	font-size: 9px;
	color: #333333;
	font: vendara;
}
.style13 {color: #333333}
.style16 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.style17 {font-size: 11px; color: #333333; font: vendara; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style18 {font-size: 11px; color: #333333; font: vendara; }
.style19 {font-size: 11px}
.style20 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-size: 12;
	font-weight: bold;
}
.style21 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000000; font-weight: bold; }
.style23 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>


<div align="center">
  <table width="700" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="25" colspan="3" bgcolor="#333399" class="sectionheader style7" style="color:#FFFFFF; font: Verdana; font-size: 14px;"><div align="left" class="style20">SECTION 3 - POWER SUPPLY &amp; <span class="sectionheader">TRANSPORATION</span> CAPABILTY</div></td>
    </tr>
    <tr>
      <td height="25" colspan="3" bordercolor="#FFFFFF" bgcolor="#CCCCCC"><div align="left" class="style21">PUBLIC POWER SUPPLY </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style17">Electric Power Generator</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style17">Connected to public power supply</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style17">Frequent power outage in the area?</div></td>
    </tr>
    <tr>
      <td rowspan="2" bordercolor="#FFFFFF"><div align="left" class="style16">      	<span class="style13">
	      	<? if (!empty($publicPowerSupply->filename)) {?>
	        <img src="<?=$imgPath.$publicPowerSupply->filename ?>" />
	        <? }?>
   	  </span></div>      </td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div align="left" class="style17">
        <?=$yesNo[$publicPowerSupply->is_connect] ?>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div align="left" class="style17">
        <?=$yesNo[$publicPowerSupply->is_freq_power_outage] ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" align="left" valign="top" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style17">Frequency of the power outage in the area</div></td>
      <td height="25" align="left" valign="top" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div align="left" class="style17">
        <?=$options8[$publicPowerSupply->power_outage_freq] ?>
      </div></td>
    </tr>
  </table>
</div>
<p align="center">&nbsp;</p>
<div align="center">
  <table width="700" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="23" colspan="5" bordercolor="#FFFFFF" bgcolor="#CCCCCC" class="style5"><div align="left" class="style21">TRANSPORTATION CAPABILITY </div></td>
    </tr>
    <tr>
      <td height="25" colspan="3" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style12"><div align="left" class="style23">
          <?=$options9[$transCapTrunck->type]?>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style12"><div align="left" class="style23">
          <?=$options9[$transCapMiniVan->type]?>
      </div></td>
    </tr>
    <tr>
      <td colspan="3" bordercolor="#FFFFFF" class="style12"><div align="left" class="style16">
          <? if (!empty($transCapTrunck->filename)) {?>
          <img src="<?=$imgPath.$transCapTrunck->filename ?>" />
          <? }?>
      </div></td>
      <td colspan="2" bordercolor="#FFFFFF" class="style12"><div align="left" class="style16">
          <? if (!empty($transCapMiniVan->filename)) {?>
          <img src="<?=$imgPath.$transCapMiniVan->filename ?>" />
          <? }?>
      </div></td>
    </tr>
    <tr>
      <td width="156" height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style12"><div align="left" class="style16">Quantity</div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style12"><div align="left" class="style16">Purpose</div></td>
      <td width="156" height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style12"><div align="left" class="style16">Quantity</div></td>
      <td width="180" height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style12"><div align="left" class="style16">Purpose</div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style12"><div align="left" class="style16">
          <?=$transCapTrunck->qty ?>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style12"><div align="left" class="style18">
          <?=$transCapTrunck->purpose ?>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style12"><div align="left" class="style16">
          <?=$transCapMiniVan->qty ?>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style12"><div align="left" class="style16">
          <?=$transCapMiniVan->purpose ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style12"><div align="left" class="style16">Peak Season </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style12"><div align="left" class="style16">Nearest Sea Port</div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style12"><div align="left" class="style16">Nearest International Airport</div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style12"><div align="left" class="style16">
          <?=$transCapTrunck->deliv_cond ?>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style12"><div align="left" class="style16">
          <?=$options3[$transCapTrunck->near_sea_port_id] ?>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style12"><div align="left" class="style16">
          <?=$options3[$transCapMiniVan->near_inter_airport_id] ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style12"><div align="left"><span class="style11"><span class="style19"></span></span></div></td>
      <td width="89" height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style12"><div align="left" class="style16">Diving Distance</div></td>
      <td width="87" height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style12"><div align="left" class="style16">
          <?=$options11[$transCapTrunck->diving_distance] ?>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style12"><div align="left" class="style16">Diving Distance</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style12"><div align="left" class="style16">
        <?=$options11[$transCapMiniVan->diving_distance] ?>
      </div></td>
    </tr>
  </table>
</div>
