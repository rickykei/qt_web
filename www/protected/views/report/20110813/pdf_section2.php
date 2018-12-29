<?
$options2 = Option2::getDropDownFromCache();
$options6 = Option6::getDropDownFromCache();
$options7 = Option7::getDropDownFromCache();

$factoryOrgModel = $model->req_factory_org;
$managementTeamModel = $model->req_management_team;
$prodProcesses = $model->req_prod_process;
?>
<style type="text/css">
<!--
.style1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.style2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style11 {
	font-size: 11px;
	color: #000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style13 {font-size: 10px; color: #000000; font: verdana; }
.style19 {font-size: 11px; color: #333333; }
.style20 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
	color: #FFFFFF;
}
.style21 {font-size: 11px; color: #000000; font-weight: bold; }
-->
</style>


<div align="center">
  <table width="700" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="23" colspan="2" bordercolor="#FFFFFF" bgcolor="#333399" class="sectionheader style1" style="color:#FFFFFF; font-size: 14px;"><div align="left" class="style20">SECTION 2 - FACTORY ORGANIZATION AND PRODUCTION PROCESS</div></td>
    </tr>
    <tr>
      <td height="23" bordercolor="#FFFFFF" bgcolor="#CCCCCC"><div align="left" class="style11">FACTORY ORGANIZATION CHART </div></td>
    </tr>
    <tr>
      <td colspan="2" bordercolor="#FFFFFF"><div align="left">
        <? if (!empty($factoryOrgModel->filename)) {?>
        <img src="<?=$imgPath.$factoryOrgModel->filename ?>" />
          <? }?>
      </div></td>
    </tr>
  </table>
</div>
<p>&nbsp;</p>
<div align="center">
  <table width="700" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr bgcolor="#999999">
      <td height="25" colspan="6" bordercolor="#333399" bgcolor="#CCCCCC" class="style2"><div align="left" class="style21">PRODUCTION PROCESS </div></td>
    </tr>
    <? foreach($prodProcesses as $idx=>$item) { ?>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style19"><div align="left" class="style19">Process</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style19"><div align="left" class="style19">Photo</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style19"><div align="left" class="style19">Machine</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style19"><div align="left" class="style19">Origin</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style19"><div align="left" class="style19">Years of use</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style19"><div align="left" class="style19">Quantity</div></td>
    </tr>
    <tr>
      <td height="25" rowspan="3" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style19"><div align="left" class="style19">
        <?=$options6[$item->process_id] ?>
      </div></td>
      <td rowspan="3" bordercolor="#FFFFFF" class="style19"><div align="left" class="style19">
        <? if (!empty($item->photo)) {?>
        <img src="<?=$imgPath.$item->photo ?>" />
        <? }?>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style19"><div align="left" class="style19">
        <?=$options7[$item->machine_id] ?>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style19"><div align="left" class="style19">
        <?=$options2[$item->origin_id] ?>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style19"><div align="left" class="style19">
        <?=$item->use_year ?>
      </div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style19"><div align="left" class="style19">
      <?=$item->qty ?></div></td>
    </tr>
    <tr>
      <td height="25" colspan="2" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style19"><div align="left" class="style19">Total Number of staff</div></td>
      <td height="25" colspan="2" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style19"><div align="left" class="style19">Machine Name</div></td>
    </tr>
    <tr>
      <td colspan="2" valign="top" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style19"><div align="left" class="style19">
        
          <div align="left">
            <?=$item->staff_no ?>
          </div>
      </div></td>
      <td colspan="2" valign="top" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style19"><div align="left" class="style19">
        
          <div align="left">
            <?=$item->machine_name ?>
          </div>
      </div></td>
    </tr>
    <? }?>
  </table>
</div>
<p>&nbsp;</p>
<div align="center">
  <table width="700" border="1" cellpadding="2" cellspacing="0" bordercolor="#333399">
    <tr>
      <td height="25" colspan="2" bordercolor="#333399" bgcolor="#CCCCCC" class="style1"><div align="left" class="style21">MANAGEMENT TEAM </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style19">Factory Manager</div></td>
      <td width="71%" height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style19">
        <?=$managementTeamModel->factory_manager ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style19">Admin. Manager</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style19">
        <?=$managementTeamModel->admin_manager ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style19">Quality Manager</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style19">
        <?=$managementTeamModel->quality_manager ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style19">Engineering Manager</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style19">
        <?=$managementTeamModel->eng_manager ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style19">Sales Manager</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style19">
        <?=$managementTeamModel->hr_manager ?>
      </div></td>
    </tr>
    <tr>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#E3E3E3" class="style13"><div align="left" class="style19">Production Manager</div></td>
      <td height="25" bordercolor="#FFFFFF" bgcolor="#FFFFFF" class="style13"><div align="left" class="style19">
        <?=$managementTeamModel->prod_manager ?>
      </div></td>
    </tr>
  </table>
</div>
<div align="center"></div>
