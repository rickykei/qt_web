
<div id="content">

	<div id="leftcol"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/checklist.png"></div>
	
	<div id="rightcol">

		<ul>
			<li class="row">
				<form id="form1" action="checkListContinueCreate" method="POST">
				A check list is under creation / modification. Do you continue your previous work?
				<br>
				<input type="submit" name="action" value="Continue">
				<input type="submit" name="action" value="Cancel">
				</form>
			</li>

		</ul>
	</div>

</div>