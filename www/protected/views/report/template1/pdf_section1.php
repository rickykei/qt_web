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
<style type="text/css">
<!--
.style3 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style4 {font-family: Geneva, Arial, Helvetica, sans-serif}
.style6 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.style8 {color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; }
.style9 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style11 {font-size: 9px}
.style12 {color: #333333}
.style13 {color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; }
.style18 {color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; }
.style19 {font-size: 10px}
.style22 {color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
.style23 {font-size: 11px}
.style24 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style25 {
	font-size: 12px;
	font-weight: bold;
}
.style27 {color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>


<div align="center">
  <table width="700" height="380" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="25" colspan="4" bordercolor="#333399" bgcolor="#333399" class="style6" style="color:#FFFFFF; font: 14; font-family: Verdana, Arial, Helvetica, sans-serif;"><div align="left" class="style25">SECTION 1 - FACTORY PROFILE</div></td>
    </tr>
    <tr>
      <td height="25" colspan="4" bordercolor="#333399" bgcolor="#CCCCCC"><div align="left"><span class="style27">GENERAL INFORMATION</span></div></td>
    </tr>
    <tr>
      <td width="28%" height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
        <div align="center">Date of Foundation</div>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$genInfoModel->foundation_date ?>
      </div></td>
      <td width="44%" height="25" bordercolor="#FFFFFF" ><div align="left" class="style18">
          <?=$model->supplier->name ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
        <div align="center">Legal Status</div>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$options1[$genInfoModel->legal_sts] ?>
      </div></td>
      <td rowspan="6" bordercolor="#FFFFFF"><div align="left" class="style8">
          <? if (!empty($genInfoModel->filename)) {?>
          <img src="<?=$imgPath.$genInfoModel->filename ?>" />
          <? }?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
        <div align="center">Investment</div>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$options2[$genInfoModel->investment_id] ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
        <div align="center">Area</div>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?= $options3[$genInfoModel->area_id] ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
        <div align="center">Number of office staff</div>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$genInfoModel->office_staff_no?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
        <div align="center">Number of workers</div>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$genInfoModel->worker_no ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
        <div align="center">Factory Manager</div>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$genInfoModel->factory_manager ?>
      </div></td>
    </tr>
    <? if (isset($mainMarkets)) {?>
    <? foreach ($mainMarkets as $idx=>$item) {?>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
          <div align="center">
            <? if ($idx == 0) {?>
            Main Market
            <? }?>
          </div>
      </div></td>
      <td width="12%" height="25" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$options2[$item->country_id]?>
      </div></td>
      <td width="16%" height="25" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$options4[$item->pct_id]?>
      </div></td>
    </tr>
    <? }}?>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
        <div align="center">Internet</div>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style22">
          <? $yesNo[$genInfoModel->internet]?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
        <div align="center">Homepage</div>
      </div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$genInfoModel->homepage ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
        <div align="center">Business License</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF"><div align="left" class="style22">BR Number</div></td>
      <td height="25" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$genInfoModel->br_no ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="center"><span class="style4"><span class="style9"><span class="style11"><span class="style12"><span class="style12"><span class="style19"><span class="style23"></span></span></span></span></span></span></span></div></td>
      <td height="25" bordercolor="#FFFFFF"><div align="left" class="style22">Date Issued</div></td>
      <td height="25" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$genInfoModel->date_issue ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="center"><span class="style4"><span class="style9"><span class="style11"><span class="style12"><span class="style12"><span class="style19"><span class="style23"></span></span></span></span></span></span></span></div></td>
      <td height="25" bordercolor="#FFFFFF"><div align="left" class="style22">Expiration</div></td>
      <td height="25" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$genInfoModel->espiration ?>
      </div></td>
    </tr>
    <? if (isset($annualTurnovers)) {?>
    <? foreach ($annualTurnovers as $idx=>$item) {?>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3"><div align="left" class="style22">
          <div align="center">
            <? if ($idx == 0) {?>
            Annual Turnover
            <? }?>
          </div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$item->year ?>
      </div></td>
      <td height="25" bordercolor="#FFFFFF"><div align="left" class="style22">
          <?=$item->amt ?>
      </div></td>
    </tr>
    <? }}?>
  </table>
</div>
<p align="center">&nbsp;</p>

<div align="center">
  <table width="700" height="166" border="1" cellpadding="2" cellspacing="0" bordercolor="#003399">
    <tr>
      <td height="25" colspan="2" bordercolor="#333399" bgcolor="#CCCCCC" class="style3"><div align="left" class="style27">FACTORY INFORMATION</div></td>
    </tr>
    <tr>
      <td width="20%" height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style24">
        <div align="center">Factory Name</div>
      </div></td>
      <td width="80%" height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style24">
        <div align="center">
          <?=$factoryInfoModel->name ?>
          </div>
      </div></td>
    </tr>
    <tr>
      <td height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style24">
        <div align="center">Address</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style24">
        <div align="center">
          <?=$factoryInfoModel->addr ?>
          </div>
      </div></td>
    </tr>
    <tr>
      <td height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style24">
        <div align="center">Contact Person</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style24">
        <div align="center">
          <?=$factoryInfoModel->contact_person ?>
          </div>
      </div></td>
    </tr>
    <tr>
      <td height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style24">
        <div align="center">Telephone</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style24">
        <div align="center">
          <?=$factoryInfoModel->tel ?>
          </div>
      </div></td>
    </tr>
    <tr>
      <td height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style24">
        <div align="center">Fax</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style24">
        <div align="center">
          <?=$factoryInfoModel->fax ?>
          </div>
      </div></td>
    </tr>
    <tr>
      <td height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style24">
        <div align="center">Email</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style24">
        <div align="center">
          <?=$factoryInfoModel->email ?>
          </div>
      </div></td>
    </tr>
  </table>
</div>
<p align="center">&nbsp;</p>


<div align="center">
  <table width="700" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="25" colspan="2" bgcolor="#CCCCCC"><div align="left"><span class="style27">FACTORY OPERATIONS</span></div></td>
    </tr>
    <tr>
      <td width="26%" height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style23">
        <div align="center">Products Manufactured</div>
      </div></td>
      <td width="74%" height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style23">
        <div align="center">
          <?=$factoryOperationModel->product ?>
          </div>
      </div></td>
    </tr>
    <tr>
      <td height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style23">
        <div align="center">Monthly Production Capacity</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style23">
        <div align="center">
          <?=$factoryOperationModel->prod_capacity ?>
          </div>
      </div></td>
    </tr>
    <tr>
      <td height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style23">
        <div align="center">Area of Manufacturing Floor</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style23">
        <div align="center">
          <?=$factoryOperationModel->manuf_floor_area ?>
          </div>
      </div></td>
    </tr>
    <tr>
      <td height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style23">
        <div align="center">Area of Dormitory Area</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style23">
        <div align="center">
          <?=$factoryOperationModel->dormitory_area ?>
          </div>
      </div></td>
    </tr>
    <tr>
      <td height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style23">
        <div align="center">Area of Kitchen and Canteen</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style23">
        <div align="center">
          <?=$factoryOperationModel->kitchen_canteen_area ?>
          </div>
      </div></td>
    </tr>
    <tr>
      <td height="25" align="right" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style23">
        <div align="center">Production Process Flow</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style23">
        <div align="center">
          <?=$factoryOperationModel->process_flow ?>
          </div>
      </div></td>
    </tr>
  </table>
</div>
<p align="center">&nbsp;</p>


<div align="center">
  <table width="700" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="25" colspan="2" bordercolor="#333399" bgcolor="#CCCCCC"><div align="left"><span class="style27">SURROUNDINGS AREA </span></div></td>
    </tr>
    <tr>
      <td width="50%" height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="center" class="style23">
        <div align="left">Factory Front Gate</div>
      </div></td>
      <td width="50%" height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="center" class="style23">
        <div align="left">Factory Exterior View</div>
      </div></td>
    </tr>
    <tr>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->front_gate)) {?><img src="<?=$imgPath.$surroundAreaModel->front_gate ?>" /><? }?></td>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->exterior)) {?><img src="<?=$imgPath.$surroundAreaModel->exterior ?>" /><? }?></td>
    </tr>
    <tr>
      <td width="50%" height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style23"><div align="center" class="style22">
        <div align="left">
          <p>Production Line View</p>
        </div>
      </div></td>
      <td width="50%" height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style23"><div align="center" class="style22">
        <div align="left">
          <p>Production Line View</p>
        </div>
      </div></td>
    </tr>
    <tr>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->prod_line_1)) {?><img src="<?=$imgPath.$surroundAreaModel->prod_line_1 ?>" /><? }?></td>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->prod_line_2)) {?><img src="<?=$imgPath.$surroundAreaModel->prod_line_1 ?>" /><? }?></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="center" class="style23">
        <div align="left">Production Line View</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="center" class="style23">
        <div align="left">Production Line View</div>
      </div></td>
    </tr>
    <tr>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->prod_line_3)) {?><img src="<?=$imgPath.$surroundAreaModel->prod_line_3 ?>" /><? }?></td>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->prod_line_4)) {?><img src="<?=$imgPath.$surroundAreaModel->prod_line_4 ?>" /><? }?></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="center" class="style23">
        <div align="left">Production Line View</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style22">Quality Department/Testing Area</td>
    </tr>
    <tr>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->prod_line_5)) {?><img src="<?=$imgPath.$surroundAreaModel->prod_line_5 ?>" /><? }?></td>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->quality)) {?><img src="<?=$imgPath.$surroundAreaModel->quality ?>" /><? }?></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="center" class="style23">
        <div align="left">Canteen</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="center" class="style23">
        <div align="left">Office Area</div>
      </div></td>
    </tr>
    <tr>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->canteen)) {?><img src="<?=$imgPath.$surroundAreaModel->canteen ?>" /><? }?></td>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->office)) {?><img src="<?=$imgPath.$surroundAreaModel->office ?>" /><? }?></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="center" class="style23">
        <div align="left">Warehouse</div>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="center" class="style23">
        <div align="left">Dormitory</div>
      </div></td>
    </tr>
    <tr>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->dormitory)) {?><img src="<?=$imgPath.$surroundAreaModel->dormitory ?>" /><? }?></td>
      <td bordercolor="#FFFFFF" class="style13"><? if (!empty($surroundAreaModel->dormitory)) {?><img src="<?=$imgPath.$surroundAreaModel->dormitory ?>" /><? }?></td>
    </tr>
  </table>
</div>
