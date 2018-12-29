<?
$options10 = Option10::getDropDownFromCache();
$yesNo = array('Y'=>'Yes', 'N'=>'No');

$certs = $model->req_certification;
?>

<table width="100%" border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="6" bgcolor="#332211" class="sectionheader" style="color:#FFFFFF">SECTION <?=$lastSection ?> - RELATED CERTIFICATION stephen ricky </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <? for ($i = 0; $i < sizeof($certs); $i+=2) {
  	$j = $i + 1;
  	$cert1 = $certs[$i];
  	$cert2 = $certs[$j];
  	
  ?>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><? echo CHtml::encode($cert1->cert_name); ?></td>
    <td colspan="3" bgcolor="#CCCCCC"><? echo CHtml::encode($cert2->cert_name); ?></td>
  </tr>
  <tr>
    <td colspan="3"><? if (!empty($cert1->filename)) {?><img src="<?=$imgPath.$cert1->filename ?>" /><? }?></td>
    <td colspan="3"><? if (!empty($cert2->filename)) {?><img src="<?=$imgPath.$cert2->filename ?>" /><? }?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Comply</td>
    <td bgcolor="#CCCCCC">Certification By</td>
    <td bgcolor="#CCCCCC">Expiry Date</td>
    <td bgcolor="#CCCCCC">Comply</td>
    <td bgcolor="#CCCCCC">Certification By</td>
    <td bgcolor="#CCCCCC">Expiry Date</td>
  </tr>
  <tr>
    <td><?=$yesNo[$cert1->is_comply] ?></td>
    <td><?=$options10[$cert1->cert_by] ?></td>
    <td><?=$cert1->expiry_date ?></td>
    
    <td><?=$yesNo[$cert2->is_comply] ?></td>
    <td><?=$options10[$cert2->cert_by] ?></td>
    <td><?=$cert2->expiry_date ?></td>
  </tr>
  <? }?>
  
  <tr>
    <td colspan="3">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
