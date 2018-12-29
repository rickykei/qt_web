<?
$options3 = Option3::getDropDownFromCache();
$options9 = Option9::getDropDownFromCache();
$options11 = Option11::getDropDownFromCache();
$yesNo = array('Y'=>'Yes', 'N'=>'No');

$publicPowerSupply = $model->req_public_power_supply;
$transCapTrunck = $model->req_trans_capability_trunck;
$transCapMiniVan = $model->req_trans_capability_minivan;
?>

<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="3" bgcolor="#000099" class="sectionheader" style="color:#FFFFFF">SECTION 3 - POWER SUPPLY &amp; TRANSPORATION CAPABILTY</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#999999">Public Power Supply</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Electric Power Generator</td>
    <td bgcolor="#CCCCCC">Connected to public power supply</td>
    <td bgcolor="#CCCCCC">Frequent power outage in the area?</td>
  </tr>
  <tr>
    <td rowspan="2">&nbsp;</td>
    <td><?=$yesNo[$publicPowerSupply->is_connect] ?></td>
    <td><?=$yesNo[$publicPowerSupply->is_freq_power_outage] ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Frequency of the power outage in the area</td>
    <td><?=$publicPowerSupply->power_outage_freq ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="5" bgcolor="#999999">Transportation Capability</td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><?=$options9[$transCapTrunck->type]?></td>
    <td colspan="2" bgcolor="#CCCCCC"><?=$options9[$transCapMiniVan->type]?></td>
  </tr>
  <tr>
    <td colspan="3"><? if (!empty($transCapTrunck->filename)) {?><img src="<?=$imgPath.$transCapTrunck->filename ?>" /><? }?></td>
    <td colspan="2"><? if (!empty($transCapMiniVan->filename)) {?><img src="<?=$imgPath.$transCapMiniVan->filename ?>" /><? }?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Quantity</td>
    <td colspan="2" bgcolor="#CCCCCC">Purpose</td>
    <td bgcolor="#CCCCCC">Quantity</td>
    <td bgcolor="#CCCCCC">Purpose</td>
  </tr>
  <tr>
    <td><?=$transCapTrunck->qty ?></td>
    <td colspan="2"><?=$transCapTrunck->purpose ?></td>
    <td><?=$transCapMiniVan->qty ?></td>
    <td><?=$transCapMiniVan->purpose ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Delivery/Loading Conditions</td>
    <td colspan="2" bgcolor="#CCCCCC">Nearest Sea Port</td>
    <td colspan="2" bgcolor="#CCCCCC">Nearest International Airport</td>
  </tr>
  <tr>
    <td><?=$transCapTrunck->deliv_cond ?></td>
    <td colspan="2"><?=$options3[$transCapTrunck->near_sea_port_id] ?></td>
    <td colspan="2"><?=$options3[$transCapMiniVan->near_inter_airport_id] ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#CCCCCC">Diving Distance</td>
    <td><?=$options11[$transCapTrunck->diving_distance] ?></td>
    <td bgcolor="#CCCCCC">Diving Distance</td>
    <td><?=$options11[$transCapMiniVan->diving_distance] ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

