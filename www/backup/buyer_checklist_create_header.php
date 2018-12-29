 <link rel="stylesheet" type="text/css" href="/css/popup.css" />
 <div id="thickbox_header">Checked List Register</div>
 <div class="clear"></div>
 <div id="thickbox_form">
	 <form id="checklist_header_create_form" method="post" action="/?user=<?php echo $user;?>&function=checklist&action=create_detail" >
				 
				<label>Check List Name:</label><input type="text"/><br/>
				<label>Establish Date:</label><input type="text" value="calendar box"/><br/>
				<label>Version:</label><input type="text"/><br/>
				<label>Create By:</label><input type="text" value="gen username" /><br/>
				<br/>
				 
				<div id="buttondiv">
				<input type="submit" id="create" value="&nbsp;&nbsp;Create&nbsp;&nbsp;"/>&nbsp;
				<input type="button" id="cancel" value="&nbsp;&nbsp;Cancel&nbsp;&nbsp;" onclick="self.parent.tb_remove();"/>
				</div>
	 </form>
 </div>
 <div class="clear"></div>
 