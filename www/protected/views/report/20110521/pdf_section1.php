<?
$options1 = Option1::getDropDownFromCache();
$options2 = Option2::getDropDownFromCache();
$options3 = Option3::getDropDownFromCache();
$options4 = Option4::getDropDownFromCache();
$yesNo = array('Y'=>'Yes', 'N'=>'No');

$genInfoModel = $model->req_general_info;
$mainMarkets = $model->req_general_info->req_main_market;
$annualTurnovers = $model->req_general_info->req_annual_turnover;
$factoryInfoModel = $model->req_factory_info;
$factoryOperationModel = $model->req_factory_operation;
$surroundAreaModel = $model->req_surround_area;
?>

<table width="100%" height="278" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="4" bgcolor="#000099" class="sectionheader" style="color:#FFFFFF">SECTION 1 - FACTORY PROFILE</td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#999999">GENERAL INFORMATION</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Date of Foundation</td>
    <td colspan="2"><?=$genInfoModel->foundation_date ?></td>
    <td ><?=$model->supplier->name ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Legal Status</td>
    <td colspan="2"><?=$options1[$genInfoModel->legal_sts] ?></td>
    <td rowspan="6"><? if (!empty($genInfoModel->filename)) {?><img src="<?=$imgPath.$genInfoModel->filename ?>" /><? }?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Investment</td>
    <td colspan="2"><?=$options2[$genInfoModel->investment_id] ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Area</td>
    <td colspan="2"><?= $options3[$genInfoModel->area_id] ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Number of office staff</td>
    <td colspan="2"><?=$genInfoModel->office_staff_no?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Number of workers</td>
    <td colspan="2"><?=$genInfoModel->worker_no ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Factory Manager</td>
    <td colspan="2"><?=$genInfoModel->factory_manager ?></td>
  </tr>
  
  <? if (isset($mainMarkets)) {?>
  <? foreach ($mainMarkets as $idx=>$item) {?>
  <tr>
    <td bgcolor="#CCCCCC"><? if ($idx == 0) {?>Main Market<? }?></td>
    <td><?=$options2[$item->country_id]?></td>
    <td><?=$options4[$item->pct_id]?></td>
  </tr>
  <? }}?>
  <tr>
    <td bgcolor="#CCCCCC">Internet</td>
    <td colspan="2"><? $yesNo[$genInfoModel->internet]?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Homepage</td>
    <td colspan="2"><?=$genInfoModel->homepage ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Business License</td>
    <td>BR Number</td>
    <td><?=$genInfoModel->br_no ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>Date Issued</td>
    <td><?=$genInfoModel->date_issue ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td>Espiration</td>
    <td><?=$genInfoModel->espiration ?></td>
  </tr>
  
  <? if (isset($annualTurnovers)) {?>
  <? foreach ($annualTurnovers as $idx=>$item) {?>
  <tr>
    <td bgcolor="#CCCCCC"><? if ($idx == 0) {?>Annual Turnover<? }?></td>
    <td><?=$item->year ?></td>
    <td><?=$item->amt ?></td>
  </tr>
  <? }}?>
</table>


<p>&nbsp;</p>

<table width="100%" height="35" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#999999">FACTORY INFORMATION</td>
  </tr>
  <tr>
    <td width="22%" align="right" bgcolor="#CCCCCC">Factory Name</td>
    <td width="78%"><?=$factoryInfoModel->name ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Address</td>
    <td><?=$factoryInfoModel->addr ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Contact Person</td>
    <td><?=$factoryInfoModel->contact_person ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Telephone</td>
    <td><?=$factoryInfoModel->tel ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Fax</td>
    <td><?=$factoryInfoModel->fax ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Email</td>
    <td><?=$factoryInfoModel->email ?></td>
  </tr>
</table>


<p>&nbsp;</p>


<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#999999">FACTORY OPERATIONS</td>
  </tr>
  <tr>
    <td width="22%" align="right" bgcolor="#CCCCCC">Products Manufactured</td>
    <td width="78%"><?=$factoryOperationModel->product ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Monthly Production Capacity</td>
    <td><?=$factoryOperationModel->prod_capacity ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Area of Manufacturing Floor</td>
    <td><?=$factoryOperationModel->manuf_floor_area ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Area of Dormitory Area</td>
    <td><?=$factoryOperationModel->dormitory_area ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Area of Kitchen and Canteen</td>
    <td><?=$factoryOperationModel->kitchen_canteen_area ?></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#CCCCCC">Production Process Flow</td>
    <td><?=$factoryOperationModel->process_flow ?></td>
  </tr>
</table>


<p>&nbsp;</p>


<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#999999">Surrounding Area</td>
  </tr>
  <tr>
    <td width="50%">Factory Front Gate</td>
    <td width="50%">Factory Exterior View</td>
  </tr>
  <tr>
    <td><? if (!empty($surroundAreaModel->front_gate)) {?><img src="<?=$imgPath.$surroundAreaModel->front_gate ?>" /><? }?></td>
    <td><? if (!empty($surroundAreaModel->exterior)) {?><img src="<?=$imgPath.$surroundAreaModel->exterior ?>" /><? }?></td>
  </tr>
  <tr>
    <td>Production Line View</td>
    <td>Production Line View</td>
  </tr>
  <tr>
    <td><? if (!empty($surroundAreaModel->prod_line_1)) {?><img src="<?=$imgPath.$surroundAreaModel->prod_line_1 ?>" /><? }?></td>
    <td><? if (!empty($surroundAreaModel->prod_line_2)) {?><img src="<?=$imgPath.$surroundAreaModel->prod_line_1 ?>" /><? }?></td>
  </tr>
  <tr>
    <td>Production Line View</td>
    <td>Production Line View</td>
  </tr>
  <tr>
    <td><? if (!empty($surroundAreaModel->prod_line_3)) {?><img src="<?=$imgPath.$surroundAreaModel->prod_line_3 ?>" /><? }?></td>
    <td><? if (!empty($surroundAreaModel->prod_line_4)) {?><img src="<?=$imgPath.$surroundAreaModel->prod_line_4 ?>" /><? }?></td>
  </tr>
  <tr>
    <td>Production Line View</td>
    <td><p>Quality Department/Testing Area</p></td>
  </tr>
  <tr>
    <td><? if (!empty($surroundAreaModel->prod_line_5)) {?><img src="<?=$imgPath.$surroundAreaModel->prod_line_5 ?>" /><? }?></td>
    <td><? if (!empty($surroundAreaModel->quality)) {?><img src="<?=$imgPath.$surroundAreaModel->quality ?>" /><? }?></td>
  </tr>
  <tr>
    <td>Canteen</td>
    <td>Office Area</td>
  </tr>
  <tr>
    <td><? if (!empty($surroundAreaModel->canteen)) {?><img src="<?=$imgPath.$surroundAreaModel->canteen ?>" /><? }?></td>
    <td><? if (!empty($surroundAreaModel->office)) {?><img src="<?=$imgPath.$surroundAreaModel->office ?>" /><? }?></td>
  </tr>
  <tr>
    <td>Warehouse</td>
    <td>Dormitory</td>
  </tr>
  <tr>
    <td><? if (!empty($surroundAreaModel->dormitory)) {?><img src="<?=$imgPath.$surroundAreaModel->dormitory ?>" /><? }?></td>
    <td><? if (!empty($surroundAreaModel->dormitory)) {?><img src="<?=$imgPath.$surroundAreaModel->dormitory ?>" /><? }?></td>
  </tr>
</table>