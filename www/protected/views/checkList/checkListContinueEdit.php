
<div id="thickbox_header"><?=$title ?></div>
<div class="clear"></div>

<div id="thickbox_form">
	<form id="deleteForm" action="checkListContinueEdit" method="POST">
	A check list is under creation / modification. Do you continue your previous work?<br><br>

	<input type="hidden" name="id" value="<?=$id ?>" />
	<input type="submit" name="action" value="Continue" />
	<input type="submit" name="action" value="Cancel"/>
	</form>
</div>
