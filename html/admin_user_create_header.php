 <link rel="stylesheet" type="text/css" href="/css/popup_admin.css" />
 <div id="thickbox_header">User Register</div>
 <div class="clear"></div>
 <div id="thickbox_form">
	 <form id="checklist_header_create_form" method="post" action="/?user=<?php echo $user;?>&function=checklist&action=create_detail" >
			<label> Username:</label><input type="text" value="username"><br/>
			<label> Password:</label><input type="text" value="password"><br/>
			<label> Password:</label><input type="text" value="password"><br/>
			<label> Address:</label><input type="text" value="password"><br/>
			<label> Contact Person:</label><input type="text" value="password"><br/>
			<label> Tel:</label><input type="text" value="password"><br/>
			<label> Fax:</label><input type="text" value="password"><br/>
			<label> E-mail:</label><input type="text" value="password"><br/>
			<label> Scope of Product:</label><input type="text" value="password"><br/>
			<label> Industry:</label><input type="text" value="password"><br/>
			<label> Area:</label><input type="text" value="password"><br/>
			<label> buyer Code:</label><input type="text" value="password"><br/>
			<label> Role:</label>
			<select name="role">
			<option value="buyer">buyer</option>
			<option value="admin">admin</option>
			<option value="auditor">auditor</option></select><br/>
			<label> Date of submission:</label><input type="text" value="password"><br/>
			<label> How do they get to know us:</label><input type="text" value="password"><br/>
			<label> Sts: </label>
			<select name="sts">
			<option value="active">active</option>
			<option value="suspend">suspend</option></select><br/>
				 
				 
				<br/>
				 
				<div id="buttondiv">
				<input type="submit" id="create" value="&nbsp;&nbsp;Create&nbsp;&nbsp;"/>&nbsp;
				<input type="button" id="cancel" value="&nbsp;&nbsp;Cancel&nbsp;&nbsp;" onclick="self.parent.tb_remove();"/>
				</div>
	 </form>
 </div>
 <div class="clear"></div>
 