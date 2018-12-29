<?
$options2 = Option2::getDropDownFromCache();
$options6 = Option6::getDropDownFromCache();
$options7 = Option7::getDropDownFromCache();

$factoryOrgModel = $model->req_factory_org;
$managementTeamModel = $model->req_management_team;
$prodProcesses = $model->req_prod_process;
?>

<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#000099" class="sectionheader" style="color:#FFFFFF">SECTION 2 - FACTORY ORGANIZATION AND PRODUCTION PROCESS</td>
  </tr>
  <tr>
    <td width="50%">Factory Organization Chart</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? if (!empty($factoryOrgModel->filename)) {?><img src="<?=$imgPath.$factoryOrgModel->filename ?>" /><? }?></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr bgcolor="#999999">
    <td height="27" colspan="6">Production Process</td>
  </tr>
  
  
<? foreach($prodProcesses as $idx=>$item) { ?>
  <tr>
    <td bgcolor="#CCCCCC">Process</td>
    <td bgcolor="#CCCCCC">Photo</td>
    <td bgcolor="#CCCCCC">Machine</td>
    <td bgcolor="#CCCCCC">Origin</td>
    <td bgcolor="#CCCCCC">Years of use</td>
    <td bgcolor="#CCCCCC">Quantity</td>
  </tr>
  <tr>
    <td rowspan="3"><?=$options6[$item->process_id] ?></td>
    <td rowspan="3"><? if (!empty($item->photo)) {?><img src="<?=$imgPath.$item->photo ?>" /><? }?></td>
    <td><?=$options7[$item->machine_id] ?></td>
    <td><?=$options2[$item->origin_id] ?></td>
    <td><?=$item->use_year ?></td>
    <td><?=$item->qty ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">Total Number of staff</td>
    <td colspan="2" bgcolor="#CCCCCC">Machine Name</td>
  </tr>
  <tr>
    <td colspan="2"><?=$item->staff_no ?></td>
    <td colspan="2"><?=$item->machine_name ?></td>
  </tr>
<? }?>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" bgcolor="#999999">Management Team</td>
  </tr>
  <tr>
    <td width="45%">Factory Manager</td>
    <td width="55%"><?=$managementTeamModel->factory_manager ?></td>
  </tr>
  <tr>
    <td>Admin. Manager</td>
    <td><?=$managementTeamModel->admin_manager ?></td>
  </tr>
  <tr>
    <td>Quality Manager</td>
    <td><?=$managementTeamModel->quality_manager ?></td>
  </tr>
  <tr>
    <td>Engineering Manager</td>
    <td><?=$managementTeamModel->eng_manager ?></td>
  </tr>
  <tr>
    <td>HR Manager</td>
    <td><?=$managementTeamModel->hr_manager ?></td>
  </tr>
  <tr>
    <td>Production Manager</td>
    <td><?=$managementTeamModel->prod_manager ?></td>
  </tr>
</table>
