
<div id="thickbox_header">Void Audit Request</div>
<div class="clear"></div>

<div id="thickbox_form">
	<form id="deleteForm" action="<?=$action ?>" method="POST">
	Are you sure to void this audit request [<?=$id ?>]?<br><br>
	<input type="hidden" name="action" value="void" />
	<input type="hidden" name="id" value="<?=$id ?>" />
	<input type="submit" name="confirm" value="Yes" />
	<input type="button" value="Cancel" onclick="self.parent.tb_remove();"/>
	</form>
</div>

