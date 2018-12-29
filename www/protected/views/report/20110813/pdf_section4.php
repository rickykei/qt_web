<?
$options2 = Option2::getDropDownFromCache();
$yesNo = array('Y'=>'Yes', 'N'=>'No');

$supplyChainModel = $model->req_supply_chain;
$rawMaterials = $supplyChainModel->req_raw_material;
$components = $supplyChainModel->req_component;
$subContracts = $supplyChainModel->req_sub_contract;
?>
<style type="text/css">
<!--
.style6 {font-size: 12}
.style7 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.style12 {font-size: 9px; color: #333333; }
.style21 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFFFFF;
	font-weight: bold;
}
.style26 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.style29 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000000; font-weight: bold; }
.style30 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000000; }
-->
</style>


<div align="center">
  <table width="700" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="25" colspan="4" bordercolor="#FFFFFF" bgcolor="#333399" class="sectionheader style7" style="color:#FFFFFF"><div align="left" class="style21">SECTION 4 - SUPPLY CHAIN MANAGEMENT</div></td>
    </tr>
    <tr>
      <td height="25" colspan="4" bordercolor="#FFFFFF" bgcolor="#CCCCCC"><div align="left"><span class="style29">RAW MATERIAL </span></div></td>
    </tr>
    <tr bgcolor="#E3E3E3">
      <td height="25" colspan="2" bordercolor="#FFFFFF" class="style26"><div align="left" class="style26">Material</div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" class="style26"><div align="left" class="style26">Country of Origin</div></td>
    </tr>
    <?
  if (!empty($rawMaterials)) { 
  foreach ($rawMaterials as $idx=>$item) {?>
    <tr bgcolor="#FFFFFF">
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style26">
        <?=$item->material ?>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style26"><span class="style26">
          <?=$options2[$item->country_id] ?>
      </span></div></td>
    </tr>
    <? }}?>
    <tr bgcolor="#CCCCCC">
      <td height="25" colspan="4" bordercolor="#FFFFFF"><div align="left" class="style29">COMPONENT</div>
      <div align="left"><span class="style6"></span></div></td>
    </tr>
    <tr bgcolor="#E3E3E3">
      <td height="25" colspan="2" bordercolor="#FFFFFF" class="style12"><div align="left" class="style26">Parts</div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" class="style12"><div align="left" class="style26">Country of Origin</div></td>
    </tr>
    <?
  if (!empty($components)) { 
  foreach ($components as $idx=>$item) {?>
    <tr bgcolor="#FFFFFF">
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style26">
        <?=$item->part ?>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style26">
          <?=$options2[$item->country_id] ?>
      </div></td>
    </tr>
    <? }}?>
    <tr bgcolor="#CCCCCC">
      <td height="25" colspan="4" bordercolor="#FFFFFF"><div align="left"><span class="style29">SUB-CONTRACTING</span></div>
      <div align="left"><span class="style6"></span></div></td>
    </tr>
    <tr bgcolor="#E3E3E3">
      <td height="25" colspan="2" bordercolor="#FFFFFF" class="style26"><div align="left" class="style26"><span class="style26">Production Process</span></div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" class="style26"><div align="left" class="style26">Country of Origin</div></td>
    </tr>
    <?
  if (!empty($subContracts)) { 
  foreach ($subContracts as $idx=>$item) {?>
    <tr bgcolor="#FFFFFF">
      <td height="25" colspan="2" bordercolor="#FFFFFF" class="style26"><div align="left" class="style26">
          <?=$item->prod_process ?>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" class="style26"><div align="left" class="style26">
          <?=$options2[$item->country_id] ?>
      </div></td>
    </tr>
    <? }}?>
    <tr bgcolor="#E3E3E3">
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style26"><div align="left" class="style30">Perform Supplier Audit</div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style26"><div align="left" class="style30">Perform IQC</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style26"><div align="left" class="style30">Has the factory got any back-up supplier for it's main supplier/contractor</div></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td height="25" bordercolor="#FFFFFF" class="style26"><div align="left" class="style26">
          <?=$yesNo[$supplyChainModel->perform_supp_audit] ?>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" class="style26"><div align="left" class="style26">
          <?=$yesNo[$supplyChainModel->perform_icq] ?>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" class="style26"><div align="left" class="style26">
          <?=$yesNo[$supplyChainModel->backup_supp] ?>
      </div></td>
    </tr>
  </table>
</div>
