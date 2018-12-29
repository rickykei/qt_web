<?
$options2 = Option2::getDropDownFromCache();
$yesNo = array('Y'=>'Yes', 'N'=>'No');

$supplyChainModel = $model->req_supply_chain;
$rawMaterials = $supplyChainModel->req_raw_material;
$components = $supplyChainModel->req_component;
$subContracts = $supplyChainModel->req_sub_contract;
?>

<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="4" bgcolor="#000099" class="sectionheader" style="color:#FFFFFF">SECTION 4 - SUPPLY CHAIN MANAGEMENT</td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#999999">Raw Materials</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">Material</td>
    <td colspan="2" bgcolor="#CCCCCC">Country of Origin</td>
  </tr>
  
  <?
  if (!empty($rawMaterials)) { 
  foreach ($rawMaterials as $idx=>$item) {?>
  <tr>
    <td colspan="2"><?=$item->material ?></td>
    <td colspan="2"><?=$options2[$item->country_id] ?></td>
  </tr>
  <? }}?>
  
  <tr>
    <td colspan="2" bgcolor="#999999">Components</td>
    <td colspan="2" bgcolor="#999999">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">Parts</td>
    <td colspan="2" bgcolor="#CCCCCC">Country of Origin</td>
  </tr>
  
  <?
  if (!empty($components)) { 
  foreach ($components as $idx=>$item) {?>
  <tr>
    <td colspan="2"><?=$item->part ?></td>
    <td colspan="2"><?=$options2[$item->country_id] ?></td>
  </tr>
  <? }}?>
  
  <tr>
    <td colspan="2" bgcolor="#999999">Sub-Contracting</td>
    <td colspan="2" bgcolor="#999999">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">Production Process</td>
    <td colspan="2" bgcolor="#CCCCCC">Country of Origin</td>
  </tr>
  
  <?
  if (!empty($subContracts)) { 
  foreach ($subContracts as $idx=>$item) {?>
  <tr>
    <td colspan="2"><?=$item->prod_process ?></td>
    <td colspan="2"><?=$options2[$item->country_id] ?></td>
  </tr>
  <? }}?>
  
  <tr>
    <td bgcolor="#CCCCCC">Perform Supplier Audit</td>
    <td colspan="2" bgcolor="#CCCCCC">Perform IQC</td>
    <td bgcolor="#CCCCCC">Has the factory got any back-up supplier for it's main supplier/contractor</td>
  </tr>
  <tr>
    <td><?=$yesNo[$supplyChainModel->perform_supp_audit] ?></td>
    <td colspan="2"><?=$yesNo[$supplyChainModel->perform_icq] ?></td>
    <td><?=$yesNo[$supplyChainModel->backup_supp] ?></td>
  </tr>
</table>
