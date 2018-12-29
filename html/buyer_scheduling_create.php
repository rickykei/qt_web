 <link rel="stylesheet" type="text/css" href="/css/popup_supplier.css" />
 <div id="thickbox_header">Schedule New Request</div>
 <div class="clear"></div>
 <div id="thickbox_form">
	 <form id="checklist_header_create_form" method="post" action="/?user=<?php echo $user;?>&function=checklist&action=create_detail" >
				 
				<label>Template Name:</label><select id=template><option value=temp1>temp1</option><option value=temp2>temp2</option></select><br/>
				<label>Supplier Code:</label><select id=SupplerCD><option value=supplier1>supplier1</option><option value=supplier2>supplier2</option></select><br/>
				<label>Request target start date:</label><input type="text" value="2011-02-22" /><input type="button" value=".."><br/>
				<label>Request target end date:</label><input type="text" value="2011-02-23"/><input type="button" value=".."><br/>
				<label>Request report CD:</label><input type="text" value="APM-020410-001"/><input type="button" value=".."><br/>
				
				<br/>
				 
				<div id="buttondiv">
				<input type="submit" id="create" value="&nbsp;&nbsp;Create&nbsp;&nbsp;"/>&nbsp;
				<input type="button" id="cancel" value="&nbsp;&nbsp;Cancel&nbsp;&nbsp;" onclick="self.parent.tb_remove();"/>
				</div>
	 </form>
 </div>
 <div class="clear"></div>
 