<?php 
include_once("header.php");?>


	<div class="clear"></div>
	
	<?php
	if ($user!="" && $function!="")
		if ($action=="")
		include_once($user."_".$function."_content.php");
		else
		include_once($user."_".$function."_".$action."_content.php");
	else{	
	?><div id="container"></div><?php } ?>
	

	<div class="clear"></div>
	
<?php
include_once("footer.php");
?>